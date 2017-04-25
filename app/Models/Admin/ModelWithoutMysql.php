<?php
namespace App\Models\Admin;

use Config;
use DB;
use Storage;
use Log;
use Excel;


class ModelWithoutMysql {

    public $dataPath = '';
    protected $methodSuffix = 'Data';
    protected $fileSuffix = '.data';
    protected $indexFile = 'index';


    public function getData($params, $from='file'){
        $strQuery = http_build_query($params);
        $path = $this->_getPath($strQuery);

        if($from == 'file'){
            $rt = $this->_queryFile($path, $strQuery);
        }
        if($from == 'db' || empty($rt)){
            $rt = $this->_queryDB($params, $path, $strQuery);
        }
        return $rt;
    }

    public function export($filename, $data){
        $filePath = storage_path('download/'.$filename.'.xls');
        $urlPath = sprintf('%s/storage/download/%s.xls',  str_replace('/admin', '', request()->getBaseUrl()) , $filename);

        if(file_exists($filePath)){
            return ['status'=>1, 'path'=>$urlPath];
        } else {
            $rt = Excel::create($filename, function($excel) use($data) {
                $excel->sheet('Sheetname', function($sheet) use($data) {
                    $sheet->fromArray($data);
                });
            })->store('xls', storage_path('download'), true);
            return isset($rt['full']) ? ['status'=>1, 'path'=>$urlPath] : ['status'=>0, 'msg'=>'未知错误!'];
        }
    }

    protected function _getPath($strQuery){
        $dir = str_replace(['\\','App/Models'], ['/','Cache'], get_class($this)).'/Data/';
        $indexs = $this->_queryFile($dir.$this->indexFile);
        if(array_key_exists($strQuery, $indexs)){
            $this->dataPath = $indexs[$strQuery]['filename'];
            return $dir.$this->dataPath;
        }
        return $dir;
    }

    public function _queryFile($path){
        $path .= $this->fileSuffix;
        return Storage::exists($path) ? unserialize(Storage::get($path)) : [];
    }

    protected function _queryDB($params, $path, $strQuery){
        $sql = $this->_genSql($params);
        $rt = $this->_select($sql);
        if(!empty($rt)){
            $rt = call_user_func_array(array($this, '_fmtData'), [$rt]);
            $content = serialize($rt);
            $this->_putQueryLog($path, $content, $strQuery);
        }
        return $rt;
    }

    protected function _genSql($params){
        return '';
    }

    protected function _select($sql, $dbConfig='sqlsrv'){
        try{
            DB::connection($dbConfig)->setFetchMode(2);
            $rt =  DB::connection($dbConfig)->select($sql);
        } catch(\Exception $e){
            $rt = [];
            Log::error($e->getMessage());
        }
        return $rt;
    }

    protected function _fmtData($rawData){
        return $rawData;
    }

    protected function _putQueryLog($path, $content, $strQuery){
        $path = empty($this->dataPath) ? $path : dirname($path).'/';
        $time = date("YmdHis");
        $prevDataIndex = $this->_queryFile($path.$this->indexFile);
        $this->dataPath = sprintf("%s%s", $time, str_pad(mt_rand(0, 9999), 4,  STR_PAD_LEFT) );
        $prevDataIndex[$strQuery] = [ 'filename'=>$this->dataPath, 'op'=> auth()->user()->code ];

        $this->_putFile($path.$this->indexFile, serialize($prevDataIndex));
        $this->_putFile($path.$this->dataPath, $content);
    }

    protected function _putFile($path, $content){
        $path .=$this->fileSuffix;
        return Storage::put($path, $content);
    }
}