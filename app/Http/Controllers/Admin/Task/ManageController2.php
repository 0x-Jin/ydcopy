<?php



namespace App\Http\Controllers\Admin\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\TaskManage;
use App\Models\Admin\TaskManageDetail;
use DB;
use URL;
use Image;
use Carbon\Carbon;
use Excel;

class ManageController extends CommonController {

    private $to_map = array(
        'platform' => array('yhd' => '一号店', 'jd' => '京东', 'tmall' => '天猫', 'yfdyf' => '益丰大药房', 'other' => '其他'),
        'status' => array('on' => '进行中', 'finished' => '完结')
    );
    private $delimter = '-';
    private $white_msg = [
        'success' => '操作成功'
    ];
    private $black_msg = [
        'no_right' => '无权操作',
        'finish' => '任务已经结束',
        'not_in' => '不在当前的任务中',
        'not_yours' => '不是你的流程，不可以进行操作'
    ];
    private $salt = "gxjseui4873495jjddmxx";
    private $extension = ["png", "jpg", "gif", "doc"];
    private $current_login;

    public function __construct() {
        $this->current_login = auth()->user();
        Config::set('database.default', 'mysql');
        $this->return_url = URL::route('taskmanage.index'); //当前的所有操作最终跳转的页面：
    }

    //首页展示 dd(Carbon::now()->toRfc2822String());
    public function indexnew(Request $req) {
        $req->flashExcept('_token'); //存储起来
        $thead = array('id' => 'ID', 'sp' => 'ShopName', 'title' => '需求部门', 'realname' => '需求主体', 'tellphone' => '需求人', 'email' => '期望完成时间', 'getperson' => '(当前)处理人', 'address' => '(当前)分工部门',
            'rank' => '当前优先级', 'status' => '(当前)处理状态', 'op' => '操作');
        $department = $this->getAllDepartment();
        $viewData = [
            'extra' => [
                'currentCtrl' => '',
                'exportUrl' => '',
            ],
            'data' => [],
            'thead' => $thead,
            'department' => $department
        ];
        return view('Admin/Task/Manage', $viewData);
    }

    public function postnew(Request $req) {
        $reqData = $req->all();
        if (isset($reqData['mathStart']) && isset($reqData['mathEnd']) && strtotime($reqData['mathEnd']) < strtotime($reqData['mathStart'])) {
            return;
        }
        $reqData['pageSize'] = isset($reqData['length']) ? $reqData['length'] : 10;
        $reqData['pageNo'] = isset($reqData['start']) ? $reqData['start'] : 1;
        Config::set('database.default', 'mysql');
        $max_detail = DB::select("select max(`detail_id`) as max_did from yfdyf_task_detail d group by d.task_id"); //找出所有最大的；
        $detail_ids = '';
        foreach ($max_detail as $v) {
            $detail_ids .= $v->max_did . ',';
        }
        $detail_ids = rtrim($detail_ids, ',');
        if ($detail_ids) {
            $sql = "select t.task_id,t.platform,t.department_id,t.title,t.author,t.expire_time,d.detail_id,d.currentone,d.current_department,d.rank,t.`status` from yfdyf_task t left join yfdyf_task_detail as d on d.task_id = t.task_id where d.detail_id in ($detail_ids)";
            $sql .=!empty($reqData['platform']) ? " and t.platform = '{$reqData['platform']}'" : "";
            $sql .=!empty($reqData['title']) ? " and t.title like '%{$reqData['title']}%'" : "";
            $sql .=!empty($reqData['mathStart']) ? " and t.addtime > {$reqData['mathStart']}" : "";
            $sql .=!empty($reqData['endStart']) ? " and t.addtime < {$reqData['endStart']}" : "";
            $sql .=!empty($reqData['status']) ? " and t.status = '{$reqData['status']}'" : "";
            $sql .=!empty($reqData['giveperson']) ? " and t.department_id = '{$reqData['giveperson']}'" : "";
            $sql .=!empty($reqData['toperson']) ? " and d.current_department = '{$reqData['toperson']}'" : "";
            $reqData['pageSize'] = $reqData['pageSize'] > 0 ? intval($reqData['pageSize']) : 10;
            $reqData['pageNo'] = $reqData['pageNo'] > 1 ? $reqData['pageNo'] : 1;
            $offset = $reqData['pageSize'] * ($reqData['pageNo'] - 1);
            $sql .= " order by t.addtime limit $offset,{$reqData['pageSize']}";
            $data = DB::select($sql);
            $filterCount = count($data);
            $newArray = [];
            $currentpersoninfo = $this->getCurrentPersonInfo(0);
            $currentuserid = $currentpersoninfo->User_Id;
            $is_admin = $this->is_admin();
            if (!empty($data)) {
                foreach ($data as $item) {
                    $currentone = $this->getDepartmentByPid($item->author, 'User_Id');
                    $item->title = "<a href='javascript:showtask(".$item->task_id.")'>".$item->title."</a>";
                    $item->author = $currentone[0]->Description;
                    $item->department_id = $currentone[0]->Name;
                    $item->status = $this->to_map['status'][$item->status];
                    $item->platform = $this->to_map['platform'][$item->platform];
                    $pinfo = $this->getDepartmentByPid($item->currentone, 'User_Id');
                    if($currentuserid == $item->currentone || $is_admin){
                        $item->rank = "<span onmouseover='alimg'>".$item->rank."</span>
                        <i class='fa fa-pencil-square-o' onclick='fastedit(".$item->detail_id.",this)' id='alimg'></i>
                        ";
                    }
                    if (empty($pinfo)) {
                        $item->currentone = "未知人";
                        $item->current_department = "未知部门" . "<span onmouseover='show_task_progress(" . $item->task_id . ",this)' class='fa fa-search'></span>";
                    } else {
                        $item->currentone = $pinfo[0]->Description;
                        $item->current_department =
                            $pinfo[0]->Name . "<span onMouseUp='show_task_progress(" . $item->task_id . ",this)' class='fa fa-search'></span>"

                      ;
                    }
                    $item->expire_time = date('Y-m-d', $item->expire_time);
                    unset($item->detail_id);
                    $item = $this->object_to_array($item);
                    $string = "
                    <button  onclick='javascript:update({$item[0]})' class='btn btn-xs btn-info btn-edit mr10'>   <i class='fa fa-pencil-square-o'></i>编辑</button>

                    <button class='btn btn-xs btn-warning btn-del' onclick='javascript:dele({$item[0]})'>   <i class='fa fa-trash-o'></i>删除</button>
                    ";
                    array_push($item, $string); //将当前分工部门进行数据传递  附带一个
                    $newArray[] = $item;
                }
            }
        }else{
            $recordsTotal = 0;
            $filterCount = 0;
            $newArray = [];
        }
        Config::set('database.default', 'mysql');
        $recordsTotal = DB::table('yfdyf_task')->count();
        $viewData = [
            'draw' => intval($reqData['draw']),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $filterCount,
            'data' => $newArray
        ];
        echo json_encode($viewData);
    }

    //对象转数组
    private function object_to_array($obj) {
        $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
        foreach ($_arr as $key => $val) {
            $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
            $arr[] = $val;
        }
        return $arr;
    }

    public function edit(Request $req) {
        //得到当前登录的人，最终要进行的
        $currentpersoninfo = $this->getCurrentPersonInfo(0);
        $currentuserid = $currentpersoninfo->User_Id;
        Config::set('database.default', 'mysql');
        //判断用户拥有的可修改的权限部分
        $id = $req->input('id', 1);
        //所有当前任务链上的信息,按进行的顺序查找,find默认首键为id，注意转化成数组对象，这样排序是为了数组是按传递顺序的
        $mainObject = TaskManage::find($id);
        $maindata = $mainObject->toArray();
        $chainData = $mainObject->TaskDetail()->orderBy('order', 'asc')->get()->toArray(); //找到所有的链
        $flag = 0;
        //显示admin 部分，要改造：可以修改整条链
        if ( $this->is_admin() ) {
//            $flag = 1;
//            if (!empty($chainData[1]['addons']))
//                $chainData[1]['addons'] = explode(',', $chainData[1]['addons']); //$this->make_all($chainData[1]);
//            else
//                $chainData[1]['addons'] = [];
//            $next = ['write' => 0, 'data' => $chainData[1]]; //不可修改
//            $apiinfo = $this->getDepartmentByPid($next['data']['currentone'], 'User_Id');
//            $next['data']['currentone'] = $apiinfo[0]->Description;
//            $next['data']['current_department'] = $apiinfo[0]->Name;
//            if (!empty($chainData[0]['addons']))
//                $chainData[0]['addons'] = explode(',', $chainData[0]['addons']); //$this->make_all($chainData[0]);
//            else
//                $chainData[0]['addons'] = [];
//            $current = ['write' => 1, 'data' => array_merge($maindata, $chainData[0])];
//            if ($maindata['status'] == 'finished')
//                $current['write'] = 0;
//            $apiinfo = $this->getDepartmentByPid($current['data']['currentone'], 'User_Id');
//            $current['data']['currentone'] = $apiinfo[0]->Description;
//            $current['data']['current_department'] = $apiinfo[0]->Name;
//            $last = []; //下一级为空
            //整个链条修改，得到整个链条的修改
            $alldepartment = $this->getAllDepartment();//所有部门
            //dd($alldepartment);
            foreach($chainData as $k=>$v){
                if(!empty($v['addons'])){
                     $chainData[$k]['addons'] = explode(',', $chainData[$k]['addons']);
                }
                $apiinfo = $this->getDepartmentByPid($v['currentone'], 'User_Id');
                //所有链上的信息都要，得到所有的部门：
                $chainData[$k]['allperson'] = $this->getAllWorkerFromDepartment($apiinfo[0]->Department_Id);
                $chainData[$k]['currentone'] = $apiinfo[0]->Description;
                $chainData[$k]['current_department'] = $apiinfo[0]->Name;
            }
            
            return view('Admin/Task/adminManage', ['chainData' => $chainData,'mainData'=>$maindata,'alldepartment'=>$alldepartment]);
        } else {
            foreach ($chainData as $k => $v) {//判断链条
                if ($v['currentone'] == $currentuserid) {//说明是可以看到的;
                    if ($v['order'] == 1) {//如果是管理人发起的，如何解决
                        $flag = 1;
                        if (!empty($chainData[$k + 1]['addons']))
                            $chainData[$k + 1]['addons'] = explode(',', $chainData[$k + 1]['addons']); //explode(',',$chainData[$k-1]['addons']); $this->make_all($chainData[$k+1]);
                        else
                            $chainData[$k + 1]['addons'] = [];
                        $next = ['write' => 0, 'data' => $chainData[$k + 1]]; //不可修改
                        $apiinfo = $this->getDepartmentByPid($next['data']['currentone'], 'User_Id');
                        $next['data']['currentone'] = $apiinfo[0]->Description;
                        $next['data']['current_department'] = $apiinfo[0]->Name;

                        if (!empty($chainData[$k]['addons']))
                            $chainData[$k]['addons'] = explode(',', $chainData[$k]['addons']); //$this->make_all($chainData[$k]);
                        else
                            $chainData[$k]['addons'] = [];

                        $current = ['write' => 0, 'data' => $chainData[$k]]; //可以修改

                        $apiinfo = $this->getDepartmentByPid($current['data']['currentone'], 'User_Id');
                        $current['data']['currentone'] = $apiinfo[0]->Description;
                        $current['data']['current_department'] = $apiinfo[0]->Name;
                        $last = [];
                    } else {
                        $flag = 2;
                        $alllast = [];
                        //得到整个链条上面的所有部分：
                        foreach($chainData as $kk=>$vv){
                            //上级部分
                            if($vv['order'] < $v['order']){
                                if (!empty($chainData[$kk]['addons']))
                                     $chainData[$kk]['addons'] = explode(',', $chainData[$kk]['addons']);
                                else
                                      $chainData[$kk]['addons'] = [];
                                $last = ['data' => $chainData[$kk]]; //上一级不可控制，上几级
                                $apiinfo = $this->getDepartmentByPid($last['data']['currentone'], 'User_Id');
                                $last['data']['currentone'] = $apiinfo[0]->Description;
                                $last['data']['current_department'] = $apiinfo[0]->Name;
                                $alllast[] = $last;
                            }
                        }
                          //上级改为上几级
//                        if (!empty($chainData[$k - 1]['addons']))
//                            $chainData[$k - 1]['addons'] = explode(',', $chainData[$k - 1]['addons']);
//                        else
//                            $chainData[$k - 1]['addons'] = [];
//                        $last = ['write' => 0, 'data' => $chainData[$k - 1]]; //上一级不可控制，上几级
//                        $apiinfo = $this->getDepartmentByPid($last['data']['currentone'], 'User_Id');
//                        $last['data']['currentone'] = $apiinfo[0]->Description;
//                        $last['data']['current_department'] = $apiinfo[0]->Name;

                        if (!empty($chainData[$k]['addons']))
                            $chainData[$k]['addons'] = explode(',', $chainData[$k]['addons']);
                        else
                            $chainData[$k]['addons'] = [];
                        $current = ['write' => 1, 'data' => $chainData[$k]]; //当前级可以查看，下一级呢？如果当前的状态是完成则显示下一级
                        $apiinfo = $this->getDepartmentByPid($current['data']['currentone'], 'User_Id');
                        $current['data']['currentone'] = $apiinfo[0]->Description;
                        $current['data']['current_department'] = $apiinfo[0]->Name;

                        $next = [];
                        if ($v['status'] == 'finished') {
                            $current['write'] = 0;
                        }
                        $alldepartment = $this->getAllDepartment();
                        if ($v['status'] == 'finished' && $v['nextone'] !== null) {
                            if (!empty($chainData[$k]['addons']))
                                $chainData[$k]['addons'] = explode(',', $chainData[$k]['addons']);
                            else
                                $chainData[$k]['addons'] = [];
                            $current = ['write' => 0, 'data' => $chainData[$k]];
                            $apiinfo = $this->getDepartmentByPid($current['data']['currentone'], 'User_Id');
                            $current['data']['currentone'] = $apiinfo[0]->Description;
                            $current['data']['current_department'] = $apiinfo[0]->Name;
                            if (!empty($chainData[$k + 1]['addons']))
                                $chainData[$k + 1]['addons'] = explode(',', $chainData[$k + 1]['addons']);
                            else
                                $chainData[$k + 1]['addons'] = [];
                            $next = ['write' => 0, 'data' => $chainData[$k + 1]];
                            $apiinfo = $this->getDepartmentByPid($next['data']['currentone'], 'User_Id');
                            $next['data']['currentone'] = $apiinfo[0]->Description;
                            $next['data']['current_department'] = $apiinfo[0]->Name;
                        }
                    }
                    break;
                }
            }
        }

        if ($flag == 2) {
            return view('Admin/Task/editManage', ['current' => $current, 'next' => $next, 'last' => $alllast, 'alldepartment' => $alldepartment]);
        } elseif ($flag == 1) {//第一级
            $current['data']['title'] = $maindata['title'];
            return view('Admin/Task/begineditManage', ['current' => $current, 'next' => $next, 'last' => $last]);
        } else {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '无权操作当前任务']);
        }
    }

    private function create_code($data) {
        return base64_encode(base64_encode($data['task_id'] . $this->delimter . $data['datail_id'] . $this->delimter . $data['count']) . base64_encode($this->salt));
    }

    //批量完成,进行下载
    private function make_all($data) {
        if (empty($data['addons'])) {
            return [];
        }
        $addons = explode(',', $data['addons']); //附件部分还要优化
        foreach ($addons as $k => $v) {
            $data['addons'][$k] = $this->create_code(
                    [
                        'task_id' => $data['task_id'],
                        'detail_id' => $data['detail_id'],
                        'list' => $k + 1
            ]);
        }
        return $data['addons'];
    }

    public function doedit(Request $req) {
        $task_id = $req->input('task_id', 1);
        $main_task = DB::table('yfdyf_task')->where('task_id', $task_id)->get();
        $main_task = $main_task[0];
        //如果当前任务已经结束：
        if ($main_task->status == 'finished') {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前任务已经完结，不可以修改']);
        }
        $currentpersoninfo = $this->getCurrentPersonInfo(0);
        $currentperson = $currentpersoninfo->User_Id;
        Config::set('database.default', 'mysql');
        $detail_task_id = $req->input('detail_task_id', 1);
        $node_id = DB::table('yfdyf_task_detail')->where('detail_id', $detail_task_id)->get();
        $node_id = $node_id[0];
        if ($node_id->status == 'finished') {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '此节点已经完结，不可以再进行操作']);
        }
        if ($node_id->currentone != $currentperson) {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '流程不是你的，不可以进行操作']);
        }
        $current = $req->input('current');
        $next = $req->input('next');
        if (!empty($req->input('finished'))) {//完结没有进行验证
            $myself['status'] = 'finished';
            $myself['remark'] = $current['remark'];
            $myself['edittime'] = time();
            if (!empty($current['addons']))
                $current['addons'] = implode(',', $current['addons']);
            else
                $current['addons'] = '';
            $myself['addons'] = $current['addons'];
            if (!DB::table('yfdyf_task_detail')->where('detail_id', $detail_task_id)->update($myself)) {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '更新失败']);
            }

            if (DB::table('yfdyf_task')->where('task_id', $node_id->task_id)->update(['status' => 'finished'])) {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前任务被你完结了']);
            }
            return;
        }


        if (!empty($req->input('save'))) {
            if (!empty($current['addons'])) {
                $current['addons'] = implode(',', $current['addons']);
            } else {
                $current['addons'] = '';
            }

            $myself = array(
                'edittime' => Carbon::now()->timestamp,
                'addons' => $current['addons'],
                'rank' => intval($current['rank']),
                'remark' => $current['remark'],
                'expire_time' => strtotime($current['expire_time']),
                'op_time' => empty($current['op_time']) ? Carbon::now()->timestamp : strtotime($current['op_time']),
            );

            if (DB::table('yfdyf_task_detail')->where('detail_id', $detail_task_id)->update($myself)) {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前任务点被保存']);
            }
            return;
        }


        if (!empty($req->input('turn'))) {

            if (empty($next['current_department']) or empty($next['currentone'])) {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '下一个操作人信息不能为空']);
            }
            if (!empty($current['addons'])) {
                $current['addons'] = implode(',', $current['addons']);
            } else {
                $current['addons'] = '';
            }

            $myself = array(
                'remark' => $current['remark'],
                'addons' => $current['addons'],
                'rank' => intval($current['rank']),
                'edittime' => Carbon::now()->timestamp,
                'expire_time' => strtotime($current['expire_time']),
                'op_time'=> empty($current['op_time']) ? Carbon::now()->timestamp : strtotime($current['op_time']),
                'status' => 'finished'
            );


            if (DB::table('yfdyf_task_detail')->where('detail_id', $detail_task_id)->update($myself)) {
                $newdata = array(
                    'order' => $node_id->order + 1,
                    'currentone' => $next['currentone'],
                    'task_id' => $task_id,
                    'current_department' => $next['current_department'],
                    'lastone' => $currentperson,
                    'status' => 'on'
                );
                if (DB::table('yfdyf_task_detail')->insert($newdata))
                    return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前任务点流转到了下一节点']);
            }else {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前任务点流转失败']);
            }
            return;
        }
    }

    public function firstEdit(Request $req) {
        $task_id = $req->input('task_id');
        //找到当前的任务
        $task_item = TaskManage::find($task_id)->toArray();
        if ($task_item['status'] == 'finished') {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '任务已经结束,无权修改']);
        }
        //所有请求
        $allreq = $req->all();
        //必填项开始检验，检验部分信息
        if (empty($allreq['current']['currentone'])) {
            //错误1
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '请选择人']);
        }
        if (empty($allreq['current']['current_department'])) {
            //错误2
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '请选择部门']);
        }
        //发布者没有权限，不能修改，只有管理员可以控制
        $data_req = $req->input('current'); //所有的信息
        if ($this->is_admin()) {
            //判断管理员 ,若是更新主表:
            $data['author'] = $data_req['currentone'];
            $data['department_id'] = $data_req['current_department'];
            $data['title'] = $data_req['title'];
            // $data['platform'] = $data_req['platform'];
            $data['edittime'] = Carbon::now()->timestamp;
            $data['expire_time'] = strtotime($data_req['expire_time']);
            if (!DB::table('yfdyf_task')->where('task_id', $task_id)->update($data)) {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '更改失败']);
            }
            //更新附表的第一个
            if (!empty($data_req['addons'])) {
                $data_req['addons'] = implode(',', $data_req['addons']);
            }
            //当前人，当前部门，附件，备注信息
            $detail_data = array(
                'currentone' => $data_req['currentone'],
                'edittime' => Carbon::now()->timestamp,
                'current_department' => $data_req['current_department'],
                'addons' => $data_req['addons'],
                'remark' => $data_req['remark'],
                'expire_time' => $data['expire_time']
            );
            if (DB::table('yfdyf_task_detail')->where(array('task_id' => $task_id, 'order' => 1))->update($detail_data)) {
                return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '操作成功']);
            }
        } else {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '无权操作']);
        }
    }

    //设定是否是管理
    private function is_admin() {
        return $this->current_login->code == 'test';
    }

    //下载文件
    public function downFile(Request $req) {
        $code = base64_decode($req->input('code'));
        //解析出来
        $pos = substr($code, 0, strlen($code) - strlen(base64_decode($this->salt)));
        list($task_id, $detail_id, $list) = explode($this->delimter, $pos);
        //查找数据库，得到当前的文件位置
        $files = DB::table('yfdyf_task')->select('addons')->where(array('task_id' => $task_id, 'detail_id' => $detail_id))->get();
        $filearray = explode(',', $files['addons']);
        $file = $filearray[$list - 1]; //得到当前的文件是哪一个
        //应该是不要其他参数的
        if (code == sha1(base64_encode($task_id . '-' . $detail_id . '-' . $list) . base64_encode($this->salt))) {
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                exit;
            }
        }
    }

    public function downlist(Request $req){
        $name = $req->input('name');
        $destinationPath = 'uploads/addons/';
        $file = $destinationPath . $name;
        if ( file_exists( $file ) ) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                exit;
        }
    }

    public function dele(Request $req) {
        if (!$this->is_admin()) {//非管理员无法添加:
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '没有权利删除']);
        }
        $id = $req->input('id', 1);
        if (TaskManage::find($id)->TaskDetail()->where('task_id', $id)->delete() && TaskManage::find($id)->delete() ) {//关联删除部分
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '删除任务成功']);
        }
        return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '删除任务失败']);
    }

    public function add() {
        $person = $this->getCurrentPersonInfo();
        $department = $this->getAllDepartment();
        return view('Admin\Task\addManage', ['person' => $person, 'department' => $department]);
    }

    public function doadd(Request $req) {
        $reqdata = $req->all();
        if (empty($reqdata['title'])) {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '标题不能为空']);
        }
        if (empty($reqdata['expire_time'])) {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '期望时间不能为空']);
        }
        if (empty($reqdata['getone']) || empty($reqdata['worker'])) {
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '接收人的或部门不能为空']);
        }
        $myinfo = $this->getCurrentPersonInfo(0);
        $data['platform'] = $reqdata['platform'];
        $data['expire_time'] = strtotime($reqdata['expire_time']); //期望时间
        $data['title'] = $reqdata['title']; //标题
        $data['addtime'] = Carbon::now()->timestamp; //添加时间
        $data['status'] = 'on'; //当前任务状态
        if (!empty($reqdata['addons'])) {
            $reqdata['addons'] = implode(',', $reqdata['addons']);
        }
        $data['department_id'] = $myinfo->Department_Id;
        $data['author'] = $myinfo->User_Id;
        //接收人部分
        $receive['getone'] = $reqdata['getone']; //部门
        $receive['worker'] = $reqdata['worker']; //
        Config::set('database.default', 'mysql');
        $insert_id = DB::table('yfdyf_task')->insertGetId($data); //主表要更新的字段
        $receive['task_id'] = $insert_id; //得到对应的id
        DB::table('yfdyf_task_detail')->insert(
                array(
                    'order' => 1,
                    'status' => 'finished',
                    'addons' => empty($reqdata['addons']) ? '' : $reqdata['addons'], //附件存在：
                    'remark' => $reqdata['body'],
                    'op_time'=> Carbon::now()->timestamp,
                    'currentone' => $data['author'],
                    'current_department' => $data['department_id'],
                    'task_id' => $receive['task_id'],
                    'nextone' => $receive['worker'],
                    'expire_time' => $data['expire_time'],
                )
        );
        DB::table('yfdyf_task_detail')->insert(
                array(
                    'order' => 2, 'status' => 'on', 'addons' => '',
                    'currentone' => $reqdata['worker'], 'current_department' => $reqdata['getone'],
                    'task_id' => $receive['task_id'], 'lastone' => $data['department_id']
                )
        );
        return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '添加任务成功']);
    }

    private function getCurrentPersonInfo($type = 1) {
        $data = $this->getDepartmentByPid($this->current_login->code, 'Code');
        if ($type == 1) {
            $data[0]->Name = empty($data[0]) ? '未知' : $data[0]->Name;
            return ['pid' => $this->current_login->code, 'did' => $data[0]->Name];
        } else {
            return $data[0];
        }
    }

    public function upload() {
        $file = Input::file('files');
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $this->extension)) {
            return response()->json(array('error' => 1, 'msg' => '不允许上传格式'));
        }
        $destinationPath = 'uploads/addons/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10) . microtime() . '.' . $extension;
        $file->move($destinationPath, $fileName);
        return response()->json(array('error' => 0, 'msg' => asset($destinationPath . $fileName), 'short' => $fileName));
    }

    public function filedel(Request $req) {
        $filename = $req->input('name');
        if (!file_exists(public_path() . $filename)) {
            return json_encode(array('error' => 1, 'msg' => '文件删除失败'));
        }
        File::delete(public_path() . $filename);
        if (File::delete(public_path() . $filename))
            return json_encode(array('error' => 0, 'msg' => '文件删除成功'));
        return json_encode(array('error' => 1, 'msg' => '文件删除失败'));
    }


    public function showProgress(Request $req) {
        $task_id = intval($req->input('task_id', 1));
        $chainData = TaskManage::find($task_id)->TaskDetail()->orderBy('order', 'asc')->get()->toArray();
        $bool = false;
        $currentpersoninfo = $this->getCurrentPersonInfo(0);
        $currentperson = $currentpersoninfo->User_Id;
        foreach($chainData as $v){
            if($currentperson == $v['currentone']){
                $bool = true;
            }
        }
        if ($this->is_admin() || $bool) {
              $table = " <div class='modal-dialog'><div class='modal-content'><div class='modal-body'>";
            foreach ($chainData as $v) {
                $table .="<div>";
                $apiinfo = $this->getDepartmentByPid($v['currentone'], 'User_Id');
                $v['currentone'] = $apiinfo[0]->Description;
                $v['current_department'] = $apiinfo[0]->Name;
                if (empty($v['current_department'])) {
                    $v['current_department'] = "未知部门";
                }
                $table .= "<p>{$v['currentone']}--{$this->to_map['status'][$v['status']]}</p>";
                $table .= "</div>";
            }
            $table .= "</div></div></div>";
        } else {
           $table = " <div class='modal-dialog'><div class='modal-content'><div class='modal-body'>权限不够，不能查看流程进度</div></div>";
        }
        echo $table;
    }

    //得到相应的信息
    public function ajaxperson(Request $req) {
        $did = $req->input('did');
        $html = "";
        if ($did) {
            $options = $this->getAllWorkerFromDepartment($did);
            $myinfo = $this->getCurrentPersonInfo(0);
            $current = $myinfo->User_Id;
            foreach ($options as $option) {
                //限制选自己
                if($current != $option->User_Id)
                    $html .= "<option value='" . $option->User_Id . "'>" . $option->Code . "</option>";
            }
            if ($html == '')
                $html = "<option value=''>请选择人员</option>";
            echo $html;
        }
    }

    //查看任务
    public function viewTask(Request $req){
        //得到一些任务的id
        $task_id = $req->input('id');
        $chainData = TaskManage::find($task_id)->TaskDetail()->orderBy('order', 'asc')->get()->toArray();
        $newData = array();
        foreach($chainData as $v){
            //显示内容
            $apiinfo = $this->getDepartmentByPid($v['currentone'], 'User_Id');
            $v['currentone'] = $apiinfo[0]->Description;
            $v['current_department'] = $apiinfo[0]->Name;
            if(!empty($v['addons'])){
                $v['addons'] = explode(',',$v['addons']);
            }
            $newData[] = $v;
        }
        return view('Admin/Task/viewManage', ['newData' => $newData]);
    }

    //更新当前的节点：
    public function updateRank(Request $req){
        //更新当前的优先级
        $detail_id = $req->input('id');
        $rank = intval($req->input('rank')) > 0?intval($req->input('rank')):null;
        $myinfo = $this->getCurrentPersonInfo(0);
        $currentone = $myinfo->User_Id;
        Config::set('database.default', 'mysql');
        $Data =  DB::select("select * from yfdyf_task_detail where detail_id =".$detail_id);
        if(!$this->is_admin()){
            if( $Data[0]->currentone != $currentone || $Data[0]->status == 'finished' ){
               return response()->json(array('error' => 1, 'msg' => '非法更新'));
            }
        }
        if( DB::table('yfdyf_task_detail')->where('detail_id', $detail_id)->update(array('rank'=>$rank,'edittime'=>time())) ){
            return response()->json(array('error' => 0, 'msg' => '更新成功'));
        }else{
            return response()->json(array('error' => 1, 'msg' => '更新失败'));
        }
    }


    //管理员控制
    public function doAdmin(Request $req){
        if(!$this->is_admin()){
           return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '无权更新当前任务']);
        }
        $allData = $req->all();

        $canAdd = true;
        $ids = [];
        $i = 0;
        foreach($allData['current']["'currentone'"] as $k=>$v){
            $i++;
            $ids[] = $k;//所有主键，判断主表的主键是哪个
            if($i > 1){
                //重复
                if($v == $allData['current']["'currentone'"][$k-1]){
                    $canAdd = false;
                }
            }
        }
        $idsStr = implode(',',$ids);

        $mainData = DB::select("select * from yfdyf_task_detail where detail_id in (".$idsStr.") and `order` = 1");

        $detail_id = $mainData[0]->detail_id;
        $task_id = $mainData[0]->task_id;
        if($canAdd){
            //主表操作
            $master_data = array(
                'expire_time'=>strtotime($allData['current']["'expire_time'"][$detail_id]),
                'author'=>$allData['current']["'currentone'"][$detail_id],
                'department_id'=>$allData['current']["'current_department'"][$detail_id],
                'edittime'=>time()
            );
            DB::table('yfdyf_task')->where('task_id', $task_id)->update($master_data);
            //附表操作
            foreach($ids as $k=>$v){
                $lastone = ($v == $detail_id)?null:$allData['current']["'currentone'"][$ids[$k-1]];
                $nextone = ($k == count($ids)-1)?null:$allData['current']["'currentone'"][$ids[$k+1]];

                $slave_data = array(
                    'expire_time'=>strtotime($allData['current']["'expire_time'"][$v]),
                    'lastone'=>$lastone,
                    'nextone'=>$nextone,
                    'rank'=>isset($allData['current']["'rank'"][$v])?$allData['current']["'rank'"][$v]:null,
                    'remark'=>$allData['current']["'remark'"][$v],
                    'edittime'=>time(),
                    'op_time'=>strtotime($allData['current']["'op_time'"][$v]),
                );
                DB::table('yfdyf_task_detail')->where('detail_id', $v)->update($slave_data);
            }
           return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前任务更新成功']);
        }else{
            return view('Admin/Common/Message', ['title' => '操作提示', 'url' => $this->return_url, 'message' => '当前链中存在上下级重复']);
        }
    }


    //导出部分
    public function exportall() {
        $cellData = [
            ['序号', '平台', '需求部门', '需求主体', '需求人', '期望完成时间', '当前处理人', '当前分工部门', '当前优先级', '处理状态']
        ];
        $max_detail = DB::select("select max(`detail_id`) as max_did from yfdyf_task_detail d group by d.task_id"); //找出所有最大的；
        $detail_ids = '';
        foreach ($max_detail as $v) {
            $detail_ids .= $v->max_did . ',';
        }
        $detail_ids = rtrim($detail_ids, ',');
        $sql = "select t.task_id,t.platform,t.department_id,t.title,t.author,t.expire_time,d.currentone,d.current_department,d.rank,t.`status` from yfdyf_task t left join yfdyf_task_detail as d on d.task_id = t.task_id where d.detail_id in ($detail_ids)";
        $data = DB::select($sql);
        foreach ($data as $item) {
            $currentone = $this->getDepartmentByPid($item->author, 'User_Id');
            $item->author = $currentone[0]->Description;
            $item->status = $this->to_map['status'][$item->status];
            $item->platform = $this->to_map['platform'][$item->platform];
            $pinfo = $this->getDepartmentByPid($item->currentone, 'User_Id');
            if (empty($pinfo)) {
                $item->currentone = "未知人";
                $item->current_department = "未知部门";
            } else {
                $item->currentone = $pinfo[0]->Description;
                $item->current_department = $pinfo[0]->Name;
            }
            $item->expire_time = date('Y-m-d', $item->expire_time);
            $item = $this->object_to_array($item);
            array_push($cellData, $item);
        }
        Excel::create('任务管理', function($excel) use ($cellData) {
            $excel->sheet('sheet1', function($sheet) use ($cellData) {
                $sheet->setAutoSize(true);
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

}
