<?php

namespace App\Models\Admin\Task;

use Illuminate\Database\Eloquent\Model;



class User extends Model
{
   
     /**
     * 关联到模型的数据表
     *
     * @var string
     */
    //定义操作的数据表
    protected $table = 'users';
    //指定特定的数据库连接
    protected $connection = 'connection-name';
    
    
    
    
}
