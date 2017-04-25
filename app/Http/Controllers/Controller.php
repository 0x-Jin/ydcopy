<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Psy\Command\DumpCommand;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->req = request();

        $mdlPath = sprintf('%s\Models\%s.php', app_path(), $this->getCurrentPath());
        $mdlNamespace = sprintf('\App\Models\%s', $this->getCurrentPath());
        $this->mdl = file_exists($mdlPath) ? new $mdlNamespace() : null;
    }


    public function index(){
        return view($this->getCurrentPath());
    }

    public function post(){
        $this->validate($this->req, $this->getRules(), $this->getMessages());
        $from = $this->req->nocache ? 'db' : 'file';
        $params = $this->req->except(['_token', 'nocache']);
        $this->req->flashExcept('_token');

        $data = $params ? $this->mdl->getData($params, $from) : [];

        return view($this->getCurrentPath(), [ 'total'=>count($data), 'data'=>array_slice($data, 0, 100), 'file'=>$this->mdl->dataPath]);
    }

    public function export($file){
        $this->mdlPath = sprintf('App\Models\%s', $this->getCurrentPath());
        $this->mdl = new $this->mdlPath();

        $pathPrefix = sprintf('Cache/%s/Data', $this->getCurrentPath('/'));
        $dataFilePath = $pathPrefix.'/'.$file;

        $arrData = $this->mdl->_queryFile($dataFilePath);

        if(empty($arrData)){
            return response()->json(['status'=>0, 'msg'=>'未知错误!']);
        }
        $bool = $this->mdl->export($file, $arrData);
        return response()->json($bool);
    }

    protected function getCurrentPath($sep='\\'){
        $class = $sep == '\\' ? get_class($this) : str_replace('\\', $sep, get_class($this));
        $pattern = '/.*Controllers'.'\\'.$sep.'(.*)Controller/';
        return preg_replace($pattern, '$1', $class);
    }

    protected function getRules(){
        return [];
    }

    protected function getMessages(){
        return [];
    }
}
