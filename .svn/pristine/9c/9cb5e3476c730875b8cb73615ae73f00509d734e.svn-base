<?php
namespace App\Models\Admin\Tool;

use Log;
use DB;

class OrderGoods {


    public function getData($params, $file='db'){
        $sql = $this->_genSql($params);
        $dbConfig = 'wms';
        try{
            DB::connection($dbConfig)->setFetchMode(2);
            $rt =  DB::connection($dbConfig)->select($sql);
        } catch(\Exception $e){
            $rt = [];
            Log::error($e->getMessage());
        }
        return ['total'=>count($rt), 'rows'=>$rt];
    }

    protected  function _genSql($params){
        $AndWhere = empty($params['item'])
                    ? ''
                    : "AND ITEM='{$params['item']}'";

        return "
        --查询条件：配货单号（必填），商品规格码 （规格码非必填）
        SELECT
            item, item_desc, allocated_qty, lot, allocation_zone, item_list_price, launch_num as 波次号,
            requested_qty,from_loc,to_loc,from_work_zone,to_work_zone,user_def2
        FROM SHIPMENT_ALLOC_REQUEST
        WHERE 1 = 1
        {$AndWhere}
        AND INTERNAL_SHIPMENT_NUM = (select INTERNAL_SHIPMENT_NUM from SHIPMENT_HEADER where SHIPMENT_ID='{$params['shipment_id']}')
        ";
    }

    public function getShipMentId($tradeId){
        $sql = "select Code from DispatchProductOrder where TradeId like '%{$tradeId}%'";
        $dbConfig = 'sqlsrv';
        try{
            DB::connection($dbConfig)->setFetchMode(2);
            $rt =  DB::connection($dbConfig)->select($sql);
        } catch(\Exception $e){
            $rt = [];
            Log::error($e->getMessage());
        }
        return $rt ? $rt[0]['Code'] : null;
    }
}