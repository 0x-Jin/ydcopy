<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Admin\Task\Express;

class ImportOrderExpress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:order_express';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import order express from SQL Server to MySQL';
    protected $table = 'order_express';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        logger("artisan {$this->signature} stared", []);

        $mssql = DB::connection('sqlsrv');

        $mssql->setFetchMode(2);
        $fields = [
            "OdCode",
            "TradeId",
            "ActuallyPaid",
            "ReceivableAmounts",
            "DispatchStatus",
            "ExpressNameActual",
            "ExpressNumber",
            "IsCod",
            "TotalProductQuantity",
            "ShopName",
            "PayTime",
            "OperateTime",
            "DeliveryDate",
            "BUYERMEMO",
            "SELLERMEMO",
            "PLATFORMMEMO",
            "REMARK",
        ];
        $fieldsStr = implode(",", $fields);
        $date = date("Y-m-d", strtotime("-1 day"));

        $querySql = "select {$fieldsStr} from DispatchProductOrder where DispatchStatus = 7 and DeliveryDate between '{$date} 00:00:00.000' and '{$date} 23:59:59.999'";
        $mssqlData = $mssql->select($querySql);

        $this->output->progressStart(count($mssqlData));
        foreach($mssqlData as $row){
            $newData = array_map(function($val){ return is_null($val) ? '' : $val;}, $row);
            if($tmpMdl = Express::where('OdCode', $row['OdCode'])->first()){
                $bool = $tmpMdl->update($newData);
            } else {
                Express::create($newData);
            }
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();

        logger("artisan {$this->signature} finished", []);
    }
}
