<?php
namespace App\Models\Admin\Tool;

use DB;
use Curl;
use Log;

class Delivery {
    
    public function cancel($shipment_id){
		//$wms_api_rt = $this->_cancelWmsApi($shipment_id);Log::info($wms_api_rt);
		//return ['status'=>0, 'msg'=>'测试中'];exit;
        $wms_rt = $this->_getStatus($shipment_id, 'wms');
        if(empty($wms_rt)){
            return ['status'=>0, 'msg'=>'未找到记录'];
        } elseif($wms_rt[0]['是否复核'] == '已复核'){
            return ['status'=>0, 'msg'=>'配货单已复核，不能取消'];
        }
        $oms_rt = $this->_getStatus($shipment_id, 'sqlsrv');
        if(!in_array($oms_rt[0]['DispatchStatus'], [3, 7])){
            return ['status'=>0, 'msg'=>'配货单已取消，不能取消'];
        }
        if($oms_rt[0]['DispatchStatus'] == 7){
            $this->_setDispatchStatus($shipment_id);
        }
        $wms_api_rt = $this->_cancelWmsApi($shipment_id);Log::info($wms_api_rt);
		$wms_api_arr=json_decode($wms_api_rt);
        if($wms_api_arr->result->code == '10002'){
            return ['status'=>0, 'msg'=>'wms接口调用显示：订单不允许取消'];
        }
        $oms_api_rt = $this->_cancelOmsApi($shipment_id);
        return ['status'=>1, 'msg'=>'取消成功'];
    }

    private function _getWmsStatusSql($shipment_id){
        return sprintf("select
  TRAILING_STS as 状态号,
  SHIPMENT_ID as 配货单号,
  AUTHORIZED_EMPL_NAME as 物流单号,
  SHIP_TO_ADDRESS2 as 物流公司代码,
  LAUNCH_NUM,
  SHIP_TO as 是否上传,
  CUSTOMER_NAME as 是否复核,
  USER_DEF5 as 店铺名,
  DATE_TIME_STAMP,
  FREIGHT_DISCOUNT 订单金额,
  user_def9 as 交易号,
  SHIP_TO_ADDRESS1,
  SHIP_TO_CITY,
  SHIP_TO_STATE
from
  SHIPMENT_HEADER
where SHIPMENT_ID in ('%s')", $shipment_id);
    }

    private function _getSqlsrvStatusSql($shipment_id){
        return sprintf("select DispatchStatus from dispatchproductorder where code='%s'", $shipment_id);
    }

    private function _getStatus($shipment_id, $dbConfig){
        $db = DB::connection($dbConfig);
        $db->setFetchMode(2);
        $sql = call_user_func([static::class, sprintf('_get%sStatusSql', $dbConfig)], $shipment_id);
        return $db->select($sql);
    }

    private function _setDispatchStatus($shipment_id){
        $db = DB::connection('sqlsrv');
        $db->setFetchMode(2);
        $sql = sprintf("update dispatchproductorder set DispatchStatus = 3 where code='%s'", $shipment_id);
        return $db->update($sql);
    }

    /* private function _cancelWmsApi($shipment_id){
        $url = "http://ec-wms-gy.yfdyf.cn:60002/OMS/OmsOrderCanInfo/Cancel.aspx";
        $postData = [
            'appkey'    => '',
            'appsecret' => '',
            'clientno'  => '',
            'data'      => '{"whcode":"C020","ordeno":"'.$shipment_id.'","reason":"已经退款或取消"}'
        ];
        return Curl::to($url)->withData($postData)->asJson(false)->post();
    } */
	private function _cancelWmsApi($shipment_id){
		$url = 'http://ec-wms-gy.yfdyf.cn:60002/OMS/OmsOrderCanInfo/Cancel.aspx';
		$postData = [
			'appkey'=> '',
			'appsecret'=> '',
			'clientno'=> '',
			'data'=> '{"whcode":"C020","ordeno":"'.$shipment_id.'","reason":"已经退款或取消"}'
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
		return $output;
	}

    private function _cancelOmsApi($shipment_id){
        $url = "http://223.4.51.228:30000/pubservice.svc/deliverycannel";
        $postData = [
            'v'    => '1.0',
            'sign' => '',
            'message'  => '[{"orderno":"'.$shipment_id.'","reason":"手动取消"}]',
        ];
        return Curl::to($url)->withData($postData)->asJson(false)->get();
    }

}