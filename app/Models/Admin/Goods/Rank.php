<?php
namespace App\Models\Admin\Goods;

use App\Models\Admin\ModelWithoutMysql;

class Rank extends ModelWithoutMysql {

    protected  function _genSql($params){
        $deliveryWhere      = empty($params['deliveryStart']) ? '' : "and a.DELIVERYDATE between '{$params['deliveryStart']} 00:00:00.000' and '{$params['deliveryEnd']} 23:59:59.999'";
        $recordWhere        = empty($params['recordStart']) ? '' : "and a.recordDATE between '{$params['recordStart']} 00:00:00.000' and '{$params['recordEnd']} 23:59:59.999'";

        $platFormWhere      = empty($params['platForm'])   ? '' : "And a.ShopCode = '{$params['platForm']}'";
        $skuCodeWhere       = empty($params['skuCode'])    ? '' : "And b.skuCode = '{$params['skuCode']}'";
        $isObSoleteWhere    = empty($params['isObSolete']) ? 'And a.isObSolete = 0' : "";
        $isDeletedWhere     = empty($params['isDeleted'])  ? 'And b.isDeleted = 0' : "";

        return "
        select
            c.ShopName 店铺名称, c.skucode 商品编码, c.ProductName 商品名称,  c.SKU_SL 商品数量, c.总销售金额, c.firstCost as 销售成本价,
            c.实际销售金额, d.CostPrice 初期成本, 销售排名 = row_number() over(order by SKU_SL desc)
        from
        (
          select
            a.ShopName,b.skucode, b.ProductName, b.ProductSkuId, b.firstCost, SUM(b.Quantity) as SKU_SL,SUM(b.Amount) as 总销售金额, SUM(b.AmountActual) as 实际销售金额
          from
            SalesOrder a with(nolock)
          left join SalesOrderLine b with(nolock) on a.Order_ID=b.SalesOrderHeaderId
          where 1 = 1
            {$deliveryWhere} {$recordWhere} {$platFormWhere} {$skuCodeWhere} {$isObSoleteWhere} {$isDeletedWhere}
            GROUP BY a.PlatformType,a.ShopName,B.SkuCode,B.ProductName,b.ProductSkuId, b.firstCost
		) c left join Product_Sku d on d.Sku_Id=c.ProductSkuId
		order by 销售排名";
    }

    protected function _fmtData($rawData){
        $mdlPrincipals = new Principal();
        $rawPincipalData = $mdlPrincipals->select('bn', 'principal')->get();
        $fmtPincipalData = [];
        foreach($rawPincipalData as $row){
            $fmtPincipalData[$row['bn']] = $row['principal'];
        }

        foreach($rawData as &$row){
            $row['负责人'] = isset($fmtPincipalData[$row['商品编码']]) ? $fmtPincipalData[$row['商品编码']] : '未分配';
            $row['商品数量'] = (float)$row['商品数量'];
            $row['总销售金额'] = (float)$row['总销售金额'];
            $row['销售成本价'] = (float)$row['销售成本价'];
            $row['实际销售金额'] = (float)$row['实际销售金额'];
            $row['初期成本'] = (float)$row['初期成本'];
        }
        unset($row);
        return $rawData;
    }
}