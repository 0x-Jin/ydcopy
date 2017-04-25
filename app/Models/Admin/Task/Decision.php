<?php

namespace App\Models\Admin\Task;

use Illuminate\Database\Eloquent\Model;
use DB;


class Decision extends Model {

    protected $table = 'admin_order_decision';

    protected $dateFormat = 'U';

    protected $fillable = [
        'order_id',
        'order_main',
        'order_detail',
        'status',
        'order_goods_info',
    ];

    protected $casts  = [
//        'order_main'        => 'object',
//        'order_detail'      => 'object',
        'order_goods_info'  => 'object',
    ];

    protected function getOrderMainAttribute($value){
        $rawData = json_decode($value, true);
        $rawData['Quantity'] = (int)$rawData['Quantity'];
        $rawData['PayDate'] = substr($rawData['PayDate'], 0, -4);
        $rawData['DeliveryDate'] = substr($rawData['DeliveryDate'], 0, -4);
        $rawData['PayAmount'] = round($rawData['PayAmount'], 2);
        return $rawData;
    }

    protected function getOrderDetailAttribute($value){
        $rawData = json_decode($value, true);
        $goodsLimit = (new \App\Models\Admin\Goods\Limit())->get(['bn'])->toArray();
        $bns = array_map(function($row){ return $row['bn'];}, $goodsLimit);

        foreach($rawData as &$row){
            $row['Quantity'] = (int)$row['Quantity'];
            $row['DeliveryQuantity'] = (int)$row['DeliveryQuantity'];
            $row['FirstCost'] = round($row['FirstCost'], 2);
            $row['PriceSelling'] = round($row['PriceSelling'], 2);
            $row['Amount'] = round($row['Amount'], 2);
            $row['DiscountAmount'] = round($row['DiscountAmount'], 2);
            $row['AmountActual'] = round($row['AmountActual'], 2);

            $row['isLimit'] = in_array($row['SkuCode'], $bns) ? 1 : 0;
        }
        return $rawData;
    }

    public function getTotalZhixiao(){
        $mssql = DB::connection('sqlsrv');
        $mssql->setFetchMode(2);

        $skuidsWhere = implode(',', array_map(function($val){return "'{$val}'";}, $skuids));

        $date30ago = date('Y-m-d', strtotime("-30 days"));
        $today = date('Y-m-d');
        $dateWhere = "and num.RecordDate between '{$date30ago} 00:00:00.000' and '{$today} 23:59:59.999'";

        $storeQuery = "
            select store.ProductSkuCode as skuid, store.Quantity, ISNULL(SUM(num.Quantity), 0)/30 as 'num' from
            InventoryVirtual store left join SalesOrderLine num on store.ProductSkuCode = num.skucode
            where
                store.ProductSkuCode in ({$skuidsWhere})
                $dateWhere
            group by store.ProductSkuCode, store.Quantity";

        $storeData = $mssql->select($storeQuery);

        $zhixiaoData = [];
        foreach($storeData as $row){
            $store = $row['Quantity'] ?: 0;
            $sell  = $row['num'] ?: 0;
            $zhixiaoData[$row['skuid']] = $sell ? round($store/$sell, 2) : 0;
        }
        return $zhixiaoData;
    }

    public function getZhixiao($skuids=null){
        $mssql = DB::connection('sqlsrv');
        $mssql->setFetchMode(2);

        $skuidsWhere = is_null($skuids) ? '' : sprintf('and store.ProductSkuCode in (%s)', implode(',', array_map(function($val){return "'{$val}'";}, $skuids)));

        $date30ago = date('Y-m-d', strtotime("-30 days"));
        $today = date('Y-m-d');
        $dateWhere = "and num.RecordDate between '{$date30ago} 00:00:00.000' and '{$today} 23:59:59.999'";

        $storeQuery = "
            select store.ProductSkuCode as skuid, store.Quantity, ISNULL(SUM(num.Quantity), 0)/30 as 'num' from
            InventoryVirtual store left join SalesOrderLine num on store.ProductSkuCode = num.skucode
            where
                1 = 1
                {$skuidsWhere}
                $dateWhere
            group by store.ProductSkuCode, store.Quantity";

        $storeData = $mssql->select($storeQuery);

        $zhixiaoData = [];

        if(is_null($skuids)){
            $store = $sell = 0;
            foreach($storeData as $row){
                $store += $row['Quantity'];
                $sell  += $row['num'];
            }
            $zhixiaoData = $sell ? round($store/$sell, 2) : 0;
        } else {
            foreach($storeData as $row){
                $store = $row['Quantity'] ?: 0;
                $sell  = $row['num'] ?: 0;
                $zhixiaoData[$row['skuid']] = $sell ? round($store/$sell, 2) : 0;
            }
        }
        return $zhixiaoData;
    }

    public function change($params){
        $mssql = DB::connection('sqlsrv');
        $mssql->setFetchMode(2);

        $text = $params['status'] == 2 ? '审核通过' : '审核拒绝';

        $sql = "update SalesOrderAddtional set SellerMemo = ISNULL(SellerMemo, '') +'|{$text}' where SalesOrderId = '{$params['order_id']}'";

        $bool = $mssql->update($sql);

        if($bool){
            $this->where('order_id', $params['order_id'])->update(['status'=>$params['status']]);
            $rt = [ 'status' => 1, 'msg' => '操作成功' ];
        } else {
            $rt = [ 'status' => 0, 'msg' => '操作失败' ];
        }
        return $rt;
    }

}
