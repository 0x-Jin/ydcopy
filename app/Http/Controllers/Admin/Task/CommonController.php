<?php


namespace App\Http\Controllers\Admin\Task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use DB;
use Cache;
class CommonController extends Controller
{

 

    protected function getAllDepartment($dbConfig = 'sqlsrv') {
        Config::set('database.default', 'sqlsrv');
        if (!Cache::has('all_department')) {
            $sql = "SELECT  Department_Id,Name from Department where IsLocked = 0 and Status = 0 ";
            $ret = DB::select($sql);
            Cache::forever('all_department', $ret);
        }
        return Cache::get('all_department');
    }


    protected function getAllWorkerFromDepartment($department) {
        Config::set('database.default', 'sqlsrv');
        if (intval($department) <= 0) {
            return [];
        } else {
            $sql = "select * from Users where Department_id = '$department'";
            $ret = DB::select($sql);
        }
        return $ret;
    }


    protected function getWorkerInfo($worker_id) {
        Config::set('database.default', 'sqlsrv');
        $sql = "select * from Users where User_Id = $worker_id and Status =0 and IsLocked = 0";
        $ret = DB::select($sql);
        return $ret;
    }

    protected function getDepartmentByPid($pid, $field) {
        Config::set('database.default', 'sqlsrv');
        $sql = "select * from Users left join Department on Department.Department_Id = Users.Department_Id where Users.$field = '$pid'";
        return DB::select($sql);
    }
    
}
