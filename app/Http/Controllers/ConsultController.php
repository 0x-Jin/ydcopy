<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Consult\ConsultRequest;
use Illuminate\Support\Facades\Input;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use DB;
use Image;
use Cache;
//use App\Api\Kdniao;
class ConsultController extends Controller {

    private $initalize;
    
    public function cc() {
        $Kdniao = new \APP\Api\Kdniao();
        $responseJson = $Kdniao->subscribe('YTO', '883455476324886158');//传入简号和单号
        $rtArr = json_decode($responseJson, true);
        //dd($rtArr);
    }
    
    
    //投诉展示
    public function index() {
        $Kdniao = new \APP\Api\Kdniao();
        $responseJson = $Kdniao->subscribe('YTO', '883455476324886158');//传入简号和单号
        $rtArr = json_decode($responseJson, true);
       // dd($rtArr);
    }
    
    //缓存第一级数据
    private function getCacheFrom(){
         if (!Cache::has('all_province')) {
            $this->getAreaData('pro', 1, 1, false);
            Cache::forever('all_province', $this->initalize);
        }
        $this->initalize =  Cache::get('all_province');
    } 

    public function doConsult(ConsultRequest $req) {
        //强制设置引擎为mysql
        Config::set('database.default', 'mysql');
        //得到所有的数据
        $reqall = $req->all();
        $afterall =  $this->toMapping($reqall);
      
        $result = DB::table('yfdyf_consult')->insert($afterall);
        $redirect = URL::route('tousu');
        if($result){
            return view('Admin/Common/Message',['title'=>'投诉提醒','url'=>$redirect,'message'=>'投诉成功']);
        }
        return view('Admin/Common/Message',['title'=>'投诉提醒','url'=>$redirect,'message'=>'投诉失败，稍后重试']);
    }

    //ajax请求地址，造路由
    public function address(Request $req) {
        $type = $req->input('type', 'pro'); //作为调试的入口
        $pid = $req->input('pid', 1); //得到最上一级id
        $sid = $req->input('sid', 1); //次级的id
        $this->getAreaData($type, $pid, $sid); //获取数据
    }

    //图片上传 token missing
    public function upload() {
        $file = Input::file('Filedata');
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return Response::json( array('error'=>1,'msg' => '只允许下面图片 png, jpg or gif'));
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).microtime().'.'.$extension;
        $file->move($destinationPath, $fileName);
        $img = Image::make($destinationPath.$fileName);
        $img->resize(320, 240);
        $img->save($destinationPath.$fileName);
        return Response::json(array('error'=>0,'msg'=>asset($destinationPath.$fileName)));
    }

    //获取地区数据
    private function getAreaData($type, $pid, $sid, $echo = true) {
        $data = $this->getData();
        //先选择所有数据,拆分成省市区
        if ($type == 'pro') {
            foreach ($data as $k => $v) {
                $afdata[] = array($k => $v['province_name']);
            }
        }elseif ($type == 'city') {
            //得到请求的的pid
            foreach ($data as $k => $v) {
                if ($k == $pid) {//判断当前的是否
                    if (isset($v['city'])) {
                        foreach ($v['city'] as $kk => $vv) {//判断cityname是否相等
                            $afdata[] = array($kk => $vv['city_name']);
                        }
                    }
                }
            }
        }elseif($type == 'area') {
            //最后一个级别的数据
            foreach ($data as $k => $v) {
                if ($k == $pid) {//两个约束
                    if (isset($v['city'])) {//注意存在空的情况会报错，必须检查
                        foreach ($v['city'] as $kk => $vv) {
                            if ($kk == $sid) {
                                foreach ($vv['area'] as $kkk => $vvv) {
                                    $afdata[] = array($kkk => $vvv);
                                }
                            }
                        }
                    }
                }
            }
        }else{
            exit();
        }
        if ($echo) {
            $this->makeSelect($afdata, $type);
        } else {
            $this->initalize = $afdata;
        }
    }

    private function makeSelect($pro, $force = 'pro') {
        $select = "<select name='{$force}' id='{$force}' class='select' onchange='toajax(this)'>";
        //增强交互性
        $select .= "<option value=''>请选择</option>";
        foreach ($pro as $v) {
            foreach ($v as $kk => $vv)
                $select .= "<option value='{$kk}'>{$vv}</option>";
        }
        $select .= "</select>";
        echo $select; //输出数据
    }


    private function getData() {
        return require storage_path()."\area.php";//加载相应的缓存
    }
    
    private function toMapping($data){
        $afterData = [];
        $afterData['published_at'] = Carbon::now();
        $afterData['status'] = 'review';
        if(isset($data['images'])){
             $afterData['thumb'] = implode(',',$data['images']);
        }
        $afterData['address'] = $data['proname'].$data['cityname'].$data['areaname'];//仔细想想这里
        $afterData['remark'] = $data['comment'];
        foreach($data as $k=>$v){
            if(in_array($k,['title','body','realname','email','tellphone','platform'])){
                 $afterData[$k] = $data[$k];
            }
        }
        return $afterData;
    }

}
