<?php

namespace App\Http\Controllers\Admin\Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UserRequest;
use App\Models\Admin\Task\User;
use Validator;

//可分离

//让模型本身也进行初始化 
class UserController extends Controller
{
    
    //验证分离与检验  简洁 优化
    public function postnew(Request $re){
        
        $this->mdl = new User();
        
        $total = $this->mdl->count();
        
        if($this->req->has('name')) $this->mdl = $this->mdl->where('name', 'like',  '%'.$this->req->title.'%');
        
        if($this->req->has('age'))  $this->mdl = $this->mdl->where('age', $this->req->age );
        
        if($this->req->has('height')) $this->mdl = $this->mdl->where('height', $this->req->height);
        
        $count = $this->mdl->count();
        
        $newArray = $this->mdl->select('id','name','age','height','addtime')->offset($this->req->start)->limit($this->req->length)->get();
        
        $filterData = array();
        //为适应前端的数据 而调整后端数据、、 合理  ？？  最后一列还需要自己来适应 mygod
        foreach($newArray as $k=>$v){
            $filterData[$k] = array($v->name,$v->age,$v->height,date('Y-m-d H:i:s',$v->addtime),"<a href='javascript:update({$v->id})' class='btn btn-xs btn-info btn-edit mr10'><i class='fa fa-pencil-square-o'></i>编辑</a><a  href='javascript:dele({$v->id})' class='btn btn-xs btn-warning btn-del mr10' ><i class='fa fa-trash-o'></i>删除</a>");
        }
        
        $viewData = [
            'draw' => intval( $re[ 'draw' ] ),
            "recordsTotal" => $total,
            "recordsFiltered" => $count,
            'data' => $filterData
        ];
        
        return response()->json($viewData);
        
    }
    
    
    public function addnew(){
         $data = array(
             'age'=>12,
             'height'=>12,
             'name'=>'xixi'
         );
         $this->mdl = new User();
         $this->mdl->save($data);
    }
    
    
    public function indexnew(){
        return view('Admin/User/index');
    }
    
    public function editnew(Request $re){
        $this->mdl = new User();
        $id = intval($re->id);
        $data = $this->mdl->where('id',$id)->get();
        return view('Admin/User/edit',array('data'=>$data[0]));
    }
    
    // 分离出UserRequest 进行独立验证s  -> 422出错： ajax
//    public function doedit(UserRequest $uq){
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|unique:posts|max:255',
//            'body' => 'required',
//        ]);      
//    }
    
    public function doedit(UserRequest $request){
        
        $input = $request->all();
        
        $rules = [
            'name'=>'required|email',
            'age'=>'required',
            'height'=>'required|digits_between:10,11',
        ];
        
        $message = [
            'name.*'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'height.*'=>'身高不能为空输入错误',
//          'height.digits_between'=>'身高必须是10在11之间'
        ];
        
        //分离验证组件 中文处理 
        $validator = Validator::make($input,$rules,$message );
        
        if ($validator->fails()) {
            return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        
        
        
        
    }
   
    
    
  
    
    
}
