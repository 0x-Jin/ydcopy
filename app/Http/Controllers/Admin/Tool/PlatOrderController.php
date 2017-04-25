<?php

namespace App\Http\Controllers\Admin\Tool;

use App\Http\Controllers\Controller;

class PlatOrderController extends Controller {


    protected function getRules(){
        return [
            'startDate' => 'required',
            'startHour' => 'required',
            'endDate' => 'required',
            'endHour' => 'required',
            'platForm' => 'required',
        ];
    }

    protected function getMessages(){
        return [
            'required'  => '该字段必填',
        ];
    }
}
