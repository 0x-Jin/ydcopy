<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OmsUser extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'Users';
    protected $primaryKey = 'User_Id';
    

    public function hasOneDepartment(){
        return $this->hasOne('App\Models\Admin\OmsDepartment','Department_Id','Department_Id');
    }    
    
	

}
