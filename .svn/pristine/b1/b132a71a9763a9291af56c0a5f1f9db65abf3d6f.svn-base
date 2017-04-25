<?php

namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Controller;


class TelController extends Controller {

    protected function getRules(){
        return [
            'start'   => 'required',
            'end'     => 'required|min_date:start|over_time_requiredWith:'.(6*30*24*3600).',start,skuCode,keyWord',
        ];
    }

    protected function getMessages(){
        return [
            'start.required'   => '请输入起始时间',
            'end.required'     => '请输入截止时间',
            'end.over_time_required_with'     => '时间间隔>6个月，编码或关键字必填',
        ];
    }
}
