<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Support\Facades\App;
use Mail;
use App\Models\Admin\Task\Decision;
use App\Models\Admin\Task\Express;
use App\Api\Kdniao;
use Predis;

class TestController extends Controller {


    public function index(){
        die;
//        $o = '_'.request()->get('o');
//        if(method_exists($this, $o)){
//            call_user_func([$this, $o]);
//        } else {
//            header("Content-type:text/html;charset=utf-8");
//            echo 'xxxx';
//        }
    }

    private function _mail(){
        Mail::send('Emails.reminder', ['user' => 'xx'], function ($m) {
            $m->to('346669517@qq.com', 'hello xq')->subject('Your Reminder!');
        });
    }

    private function _redis(){
        $redis = Predis::connection();

        $job = (new \App\Jobs\Admin\Task\SearchExpressTrace('xxx'));
        dispatch($job);
    }

    private function _kd(){
        $bn = '70362400976050';
        $kdniao = new Kdniao();

        $res = $kdniao->search('HTKY', $bn);
        echo $res;
    }

    private function _cancel(){
        $coon_wms = DB::connection('wms');
        $coon_wms->setFetchMode(2);
        $sql = "select TRAILING_STS as 状态号, SHIPMENT_ID as 配货单号,AUTHORIZED_EMPL_NAME as 物流单号,SHIP_TO_ADDRESS2 as 物流公司代码,LAUNCH_NUM,SHIP_TO as 是否上传,CUSTOMER_NAME as 是否复核,USER_DEF5 as 店铺名,DATE_TIME_STAMP,FREIGHT_DISCOUNT 订单金额,user_def9 as 交易号, SHIP_TO_ADDRESS1,SHIP_TO_CITY,SHIP_TO_STATE from SHIPMENT_HEADER where SHIPMENT_ID  in ('DPO160812000434');";
        $rt = $coon_wms->select($sql);
        dd($rt);
    }

}
