<?php

namespace App\Http\Controllers\Admin\Plat;

use Illuminate\Http\Request as Req;
use App\Http\Controllers\Controller;
use App\Models\Admin\Plat\Sale as Mdl;

class SaleController extends Controller {


    protected function getRules(){
        return [
            'platForm'      => 'required',
            'orderType'     => 'required',
            'recordStart'   => 'required_without_all:recordStart,createStart,platStart,payStart,deliveryStart|required_with:recordEnd',
            'recordEnd'     => 'required_with:recordStart|min_date:recordStart',
            'createStart'   => 'required_without_all:recordStart,platStart,payStart,deliveryStart|required_with:createEnd',
            'createEnd'     => 'required_with:createStart|min_date:createStart',
            'platStart'     => 'required_without_all:recordStart,createStart,payStart,deliveryStart|required_with:platEnd',
            'platEnd'       => 'required_with:platStart|min_date:platStart',
            'payStart'      => 'required_without_all:recordStart,createStart,platStart,deliveryStart|required_with:payEnd',
            'payEnd'        => 'required_with:payStart|min_date:payStart',
            'deliveryStart' => 'required_without_all:recordStart,createStart,platStart,payStart|required_with:deliveryEnd',
            'deliveryEnd'   => 'required_with:deliveryStart|min_date:deliveryStart',
        ];
    }

    protected function getMessages(){
        return [
            'required_without_all'              => '记录时间,制单时间,平台发货时间，支付时间，发货时间必须选择一个时间',
            'recordEnd.required_with'           => '请输入记录截止时间',
            'createEnd.required_with'           => '请输入制单截止时间',
            'platEnd.required_with'             => '请输入平台发货截止时间',
            'payEnd.required_with'              => '请输入支付截止时间',
            'deliveryEnd.required_with'         => '请输入发货截止时间',
            'recordStart.required_with'         => '请输入记录起始时间',
            'createStart.required_with'         => '请输入制单起始时间',
            'platStart.required_with'           => '请输入平台发货起始时间',
            'payStart.required_with'            => '请输入支付起始时间',
            'deliveryStart.required_with'       => '请输入发货起始时间',
        ];
    }

}
