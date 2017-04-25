<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;


class RebuyController extends Controller {


    protected function getRules(){
        return [
            'platForm'      => 'required',
            'skuCode'      => 'required',
            'orderStart'    => 'required',
            'orderEnd'      => 'required|min_date:orderStart',
        ];
    }

    protected function getMessages(){
        return [
            'platForm.required'     => '请选择店铺',
            'skuCode.required'      => '请输入商品规格码',
            'orderStart.required'   => '请输入开始时间',
            'orderEnd.required'     => '请输入截止时间',
        ];
    }

}
