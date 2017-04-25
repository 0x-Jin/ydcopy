<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;


class CountController extends Controller {


    protected function getRules(){
        return [
            'mathStart'     => 'required',
            'mathEnd'       => 'required|min_date:mathStart',
            'compareStart'  => 'required',
            'compareEnd'    => 'required|min_date:compareStart|max_date:'.strtotime(request()->mathStart),
            'platForm'      => 'required',
            'timeType'      => 'required',
        ];
    }

    protected function getMessages(){
        return [
            'mathStart.required'    => '请输入统计开始时间',
            'mathEnd.required'      => '请输入统计截止时间',
            'compareStart.required' => '请输入参考开始时间',
            'compareEnd.required'   => '请输入参考截止时间',
            'compareEnd.max_date'   => '参考截止时间需早于统计开始时间',

            'platForm.required'     => '请选择店铺',
            'timeType.required'     => '请选择时间类型',
        ];
    }
}