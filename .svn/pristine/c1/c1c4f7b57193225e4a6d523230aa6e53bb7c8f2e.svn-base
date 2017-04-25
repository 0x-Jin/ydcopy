<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OmsDepartment extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'Department';
    protected $primaryKey = 'Department_Id';
    
    public function hasManyUser(){
        return $this->hasMany('App\Models\Admin\OmsUser','Department_Id','Department_Id');
    }
    
    
    
}
