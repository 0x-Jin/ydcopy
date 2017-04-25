<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;


class DecisionController extends Controller {


    public function post(){
        $data = [
            "total" => $this->mdl->count(),
            "rows"  => $this->mdl->offset($this->req->offset)->limit($this->req->limit)->get()
        ];

        return response()->json($data);
    }

    public function change(){
        $data = $this->mdl->change(request()->except('_token'));
        return response()->json($data);
    }

    public function getTotalZhixiao(){
        $data = $this->mdl->getZhixiao();
        return response()->json($data);
    }

    public function getZhixiao(){
        $data = $this->mdl->getZhixiao(request()->skuids);
        return response()->json($data);
    }

    public function getStore(){
        $mdl = new \App\Models\Admin\Tool\Store();

        $reqData = [ 'item'=>request()->skuid, 'warehouse'=>'c020' ];

        $data = $mdl->getData($reqData);
        return response()->json($data['rows']);
    }
}
