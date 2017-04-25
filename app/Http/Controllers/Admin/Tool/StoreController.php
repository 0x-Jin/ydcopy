<?php

namespace App\Http\Controllers\Admin\Tool;

use App\Http\Controllers\Controller;

class StoreController extends Controller {


    public function post(){
        $this->validate($this->req, [
            'item' => 'required',
        ]);

        $params = $this->req->except(['_token', 'nocache']);
        $data = $params ? $this->mdl->getData($params) : [];
        return response()->json($data);
    }
}
