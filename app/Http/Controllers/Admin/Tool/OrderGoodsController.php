<?php

namespace App\Http\Controllers\Admin\Tool;

use App\Http\Controllers\Controller;

class OrderGoodsController extends Controller {


    public function post(){
        $this->validate($this->req, [
            'shipment_id' => 'required',
        ]);

        $params = $this->req->except(['_token', 'nocache']);
        $data = $params ? $this->mdl->getData($params) : [];
        return response()->json($data);
    }
}
