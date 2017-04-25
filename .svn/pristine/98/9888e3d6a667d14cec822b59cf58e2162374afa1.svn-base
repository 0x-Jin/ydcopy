<?php

namespace App\Http\Controllers\Admin\Tool;

use App\Http\Controllers\Controller;

class DeliveryController extends Controller {


    public function post(){
        $this->validate($this->req, [
            'shipment_id' => 'required',
        ], ['required'=>'配货单号必填']);
        $this->req->flashExcept('_token');
        $params = $this->req->except(['_token', 'nocache']);
        $data = $params ? $this->mdl->cancel($params['shipment_id']) : [];
        $data['shipment_id'] = request()->get('shipment_id');
        return view($this->getCurrentPath(), $data);
    }
}
