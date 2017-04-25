<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class TaskManage extends Model
{

     protected $table = 'yfdyf_task';
     protected $primaryKey = 'task_id';
    
    //指定表的关系
    public function TaskDetail()
    {
        return $this->hasMany('App\Models\Admin\TaskManageDetail','task_id','task_id');
    }
    
    
    
    
}
