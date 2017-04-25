<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;

class NoteController extends Controller {


    public function post(){
        if($this->req->has('title')) $this->mdl = $this->mdl->where('title', 'like',  '%'.$this->req->title.'%');
        $data = [
            "total" => $this->mdl->count(),
            "rows"  => $this->mdl->offset($this->req->offset)->limit($this->req->limit)->get()
        ];
        return response()->json($data);
    }

    public function save(){
        $method = $this->req->has('id') ? '_update' : '_create';
        $rt = call_user_func_array([$this, $method], [$this->req, $this->mdl]);
        return response()->json($rt);
    }

    protected function _create($req, $mdl){
        $this->validate($req, [
            'title'        => 'required',
            'description'  => 'required'
        ]);
        return $mdl->create($req->except('_token')) ? ['status'=>1, 'msg'=>'添加成功!'] : ['status'=>0, 'msg'=>'添加失败!'];
    }

    protected function _update($req, $mdl){
        $this->validate($req, [
            'title'        => 'required',
            'description'  => 'required'
        ]);
        $mdl = $mdl->find($req->id);
        return $mdl->update($req->except('_token')) ? ['status'=>1, 'msg'=>'修改成功!'] : ['status'=>0, 'msg'=>'修改失败!'];
    }

    public function del(){
        $rt = $this->mdl->destroy($this->req->id) ? ['status'=>1, 'msg'=>'删除成功!'] : ['status'=>0, 'msg'=>'删除失败!'];
        return response()->json($rt);
    }


}
