<?php
//go to hell
namespace App\Http\Controllers\Admin\Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Admin\OmsDepartment;
use App\Models\Admin\OmsUser;

class OmsController extends Controller
{

    protected function getAllDepartment(){
         $all = OmsDepartment::select('Department_id','Name')->where(['IsLocked'=>0,'Status'=>0])->get();
         return $all;
    }


    protected function getAllWorkerFromDepartment($department) {
         return OmsUser::select('User_id','Code')->where('Department_id',$department)->get();
    }


    protected function getWorkerInfo($worker_id) {
         return OmsUser::select('*')->where(['User_Id'=>$worker_id,'Status'=>0,'IsLocked'=>0])->get();
    }

    //这个方法改造下;
    protected function getDepartmentByPid($pid, $field) {
        return OmsUser::select('Users.User_id','Users.Code','Department.Department_id','Department.Name')
                ->leftjoin('Department','Department.Department_id','=','Users.Department_id')
                ->where('Users.'.$field,$pid)
                ->get();
    }
    
    
}
