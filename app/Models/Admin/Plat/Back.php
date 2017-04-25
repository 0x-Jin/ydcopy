<?php
namespace App\Models\Admin\Plat;

use App\Models\Admin\ModelWithoutMysql;

class Back extends ModelWithoutMysql {


    protected  function _genSql($params){
        $recordWhere = $createWhere = $platWhere = $deliverWhere = $payWhere = '';

        if(!empty($params['recordEnd']) ){
            $recordWhere = sprintf("and c.recordDate between '%s 00:00:00.000' and '%s 23:59:59.000'", $params['recordStart'], $params['recordEnd']);
        }

        if( !empty($params['createEnd']) ) {
            $createWhere = sprintf("and c.CREATEDATE between '%s 00:00:00.000' and '%s 23:59:59.000'", $params['createStart'], $params['createEnd']);
        }

        if( !empty($params['platEnd']) ) {
            $platWhere = sprintf("and c.PLATDELIVERYDATE between '%s 00:00:00.000' and '%s 23:59:59.000'", $params['platStart'], $params['platEnd']);
        }

        if( !empty($params['deliverEnd']) ) {
            $deliverWhere = sprintf("and c.DELIVERYDATE between '%s 00:00:00.000' and '%s 23:59:59.000'", $params['deliverStart'], $params['deliverEnd']);
        }

        if( !empty($params['payEnd']) ) {
            $payWhere = sprintf("and c.PayDate between '%s 00:00:00.000' and '%s 23:59:59.000'", $params['payStart'], $params['payEnd']);
        }

        $platFormWhere = $params['platForm'] ? "and c.ShopCode = '{$params['platForm']}'" : '';

        $isObSoleteWhere = empty($params['isObSolete']) ? 'and c.isObsolete = 0' : "";

        return "
        select
e.ShopName as 店铺名称,
e.goodsNums as 商品数量,
e.goodsCount as sku品种数,
e.memberNums as 退货人数,
e.roNums as 退货单数,
f.payFee as 退换单支付金额,
g.rfAmount as 退款单退款金额,
h.payAmount as 支付总金额,
h.orderCount as 订单总数,
h.salesProducts as 销售商品总数
 from
(
	--查询退换单退货数据
	select
		SUM(a.Quantity) as goodsNums,--商品数量
		COUNT(distinct a.SkuCode) as goodsCount,--sku品种数
		COUNT(distinct b.MemberCode) as memberNums,--退货人数
		COUNT(distinct b.Returned_Order_Id) as roNums,--退货单数
		b.ShopName ,
		b.shopCode
	from Returned_Order_Product_In a
		left join Returned_Order_Header b on a.Returned_Order_Id=b.Returned_Order_Id
		left join SalesOrder c on c.Order_ID=b.SalesOrder_Id
	where 1 = 1
	{$platFormWhere} {$isObSoleteWhere} {$recordWhere} {$createWhere} {$platWhere} {$deliverWhere} {$payWhere}
	group by b.ShopName,b.shopCode
) e
left join
(
	--查询退换单金额
	select
		SUM(a.PaymentFee) as payFee,--退换单支付金额
		b.ShopName,b.shopCode
	from Returned_Order_Header b
		left join Returned_Order_Payment a on b.Returned_Order_Id=a.Returned_Order_Id
		left join SalesOrder c on c.Order_ID=b.SalesOrder_Id
	where 1 = 1
		{$platFormWhere} {$isObSoleteWhere} {$recordWhere} {$createWhere} {$platWhere} {$deliverWhere} {$payWhere}
	group by b.ShopName,b.shopCode
) f on e.shopCode=f.shopCode
left join
(
	--查询退款单金额
	select
		b.ShopName,b.shopCode,
		SUM(a.COUNTAMOUNT) as rfAmount --退款单退款金额
	from Refund_Order_Header a
		left join Returned_Order_Header b on a.Returned_Order_Id=b.Returned_Order_Id
		left join SalesOrder c on c.Order_ID=b.SalesOrder_Id
	where
		1 = 1
		{$platFormWhere} {$isObSoleteWhere} {$recordWhere} {$createWhere} {$platWhere} {$deliverWhere} {$payWhere}
	group by b.ShopName,b.shopCode
) g on e.shopCode =g.shopCode
left join
(
	select
		SUM(PayAmount) as payAmount,--支付总金额
		COUNT(Order_ID) as orderCount,--订单总数
		SUM(Quantity) as salesProducts,--销售商品总数
		ShopName,shopCode
	from SalesOrder c
	where
		1 = 1
		{$platFormWhere} {$isObSoleteWhere} {$recordWhere} {$createWhere} {$platWhere} {$deliverWhere} {$payWhere}
	group by ShopName,shopCode
) h on e.shopCode=h.shopCode";
    }

    protected function _fmtData($rawData){
        $totalA = $totalB = $totalC =
        $totalD = $totalE = $totalF =
        $totalH = $totalI = $totalJ = 0;

        foreach($rawData as &$row){
            $row['商品数量'] = (float)$row['商品数量'];
            $row['sku品种数'] = (float)$row['sku品种数'];
            $row['退货人数'] = (float)$row['退货人数'];
            $row['退货单数'] = (float)$row['退货单数'];
            $row['退换单支付金额'] = (float)$row['退换单支付金额'];
            $row['退款单退款金额'] = (float)$row['退款单退款金额'];
            $row['支付总金额'] = (float)$row['支付总金额'];
            $row['订单总数'] = (float)$row['订单总数'];
            $row['销售商品总数'] = (float)$row['销售商品总数'];

            $totalA+= $row['商品数量'];
            $totalB+= $row['sku品种数'];
            $totalC+= $row['退货人数'];
            $totalD+= $row['退货单数'];
            $totalE+= $row['退换单支付金额'];
            $totalF+= $row['退款单退款金额'];
            $totalH+= $row['支付总金额'];
            $totalI+= $row['订单总数'];
            $totalJ+= $row['销售商品总数'];
        }
        unset($row);
        $rawData[] = array(
            '店铺名称'      => '合计',
            '商品数量'      => $totalA,
            'sku品种数'    => $totalB,
            '退货人数'  	  => $totalC,
            '退货单数'  	  => $totalD,
            '退换单支付金额' => $totalE,
            '退款单退款金额' => $totalF,
            '支付总金额'    => $totalH,
            '订单总数'      => $totalI,
            '销售商品总数'	  => $totalJ,
        );
        return $rawData;
    }
}