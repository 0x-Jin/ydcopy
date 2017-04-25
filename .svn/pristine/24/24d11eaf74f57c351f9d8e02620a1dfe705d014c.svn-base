<?php

namespace App\Models\Admin\Task;

use Illuminate\Database\Eloquent\Model;
use App\Api\Kdniao;
use DB;

class Express extends Model {

    protected $table = 'admin_order_express';
    protected $dateFormat = 'U';
    protected $fillable = [
        'OdCode',
        'TradeId',
        'ActuallyPaid',
        'ReceivableAmounts',
        'DispatchStatus',
        'ExpressNameActual',
        'ExpressNumber',
        'IsCod',
        'TotalProductQuantity',
        'ShopName',
        'PayTime',
        'OperateTime',
        'DeliveryDate',
        'BUYERMEMO',
        'SELLERMEMO',
        'PLATFORMMEMO',
        'REMARK',
        'status',
        'Reason',
    ];


    public function trace($bn){
        $Kdniao = new Kdniao();

        $bn = trim($bn);
        $mdl = $this->where('ExpressNumber', $bn)->first();

        if($mdl){
            $ListCode = config('kdniao.Code');
            if(!array_key_exists($mdl->ExpressNameActual, $ListCode)){
                logger('KdNiao.error', ['no'=>$bn, 'res'=>'不支持的快递', 'code'=>$mdl->ExpressNameActual]);
                return ['status'=>0, 'msg'=>'不支持的快递'];
            }
            $code = $ListCode[$mdl->ExpressNameActual];
            $responseJson = $Kdniao->search($code, $bn);
            $rtArr = json_decode($responseJson, true);

            if($rtArr['Success']){
                if(isset($rtArr['Reason'])){
                    $mdl->status = $rtArr['Reason'] == '此单无物流信息' ? 5 : 4;
                    $mdl->Reason = $rtArr['Reason'];
                } else {
                    $mdl->status = isset($rtArr['State']) ? $rtArr['State'] : 2;
                    $mdl->express_trace = json_encode($rtArr['Traces']);
                    $this->delTrace($bn);
                    $this->formatTrace($bn, $rtArr['Traces']);
                }
                $mdl->save();
                return ['status'=>1, 'msg'=>'更新成功'];
            } else {
                return ['status'=>0, 'msg'=>'api数据未找到'];
                logger('KdNiao.trace.error', ['no'=>$bn, 'res'=>$responseJson, 'from'=>'model Express trace']);
            }
        } else {
            return ['status'=>0, 'msg'=>'api数据未找到'];
            logger('KdNiao.trace.error', ['no'=>$bn, 'res'=>$bn.'missing', 'from'=>'model Express trace']);
        }


    }

    /**
     * 接受快递鸟物流推送信息
     */
    public function receive($receiveData){
        DB::enableQueryLog();
        foreach($receiveData['Data'] as $items){
            //物流状态: 0默认，1-已订阅，2-在途中，3-签收,4-问题件

            $updateData = [
                'status' => isset($items['State']) ? $items['State'] : 2,
                'express_trace' => json_encode($items['Traces']),
            ];

            $rt = $this->where('ExpressNumber', $items['LogisticCode'])->update($updateData);
            $this->formatTrace($items['LogisticCode'], $items['Traces']);

            if(! $rt){
                logger('jobs.error', ['sql'=>DB::getQueryLog()]);
                $job = (new \App\Jobs\Admin\Task\SearchExpressTrace($items['LogisticCode']));
                dispatch($job);
            }
        }
        return $rt;
    }

    public function delTrace($ExpressNumber){
        $sql = sprintf("Delete from admin_express_trace%s where expressnumber = '%s'", substr($ExpressNumber, -1), $ExpressNumber);
        $bool = DB::delete($sql);
        return $bool;
    }

    /**
     * 格式化物流信息，分开插入数据
     * @param $mdl
     */
    public function formatTrace($ExpressNumber, $jsonTrace){
        DB::setFetchMode(2);

        $subfix = substr($ExpressNumber, -1);

        $rawSql = "INSERT INTO admin_express_trace%s (ExpressNumber, AcceptStation, AcceptTime, created_at, updated_at) VALUE (?,?,?,?,?)";

        $insertSql = sprintf($rawSql, $subfix);

        $traceJson = is_array($jsonTrace) ? $jsonTrace : json_decode($jsonTrace, true);

        if(is_array($traceJson)){
            foreach($traceJson as $trace){
                $acceptTime = strtotime($trace['AcceptTime']);

                $selectSql = sprintf("select id from admin_express_trace%s where ExpressNumber = '%s' and AcceptTime = '%s'",
                    $subfix, $ExpressNumber, $acceptTime);

                $isExist = DB::select($selectSql);

                if( !$isExist ){
                    $vals = [ $ExpressNumber, $trace['AcceptStation'], $acceptTime, time(), time() ];
                    $bool = DB::insert($insertSql, $vals);
                    if(! $bool) logger('fmtTrace Error', ['sql'=>$insertSql]);
                }
            }
        } else {
            $this->trace($ExpressNumber);
        }
    }
}
