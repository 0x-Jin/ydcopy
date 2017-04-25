<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Task\Express;
use DB;

class CheckOrderExpress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:order_express';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check the order status trace info';

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
    public function handle(Express $mdlExpress){
        logger("artisan {$this->signature} stared", []);

        $mdlExpress->whereIn('status', [1,4])
            ->wherenull('express_trace')
            ->whereNotIn('ExpressNameActual', ['中通', '京东快递'])
            ->where('created_at', '<', time()-3600*24*2)
            ->chunk(50, function($mdls) use($mdlExpress){
                $strTradeIds = '';
                $ids = [];

                foreach($mdls as $mdl){
                    $ids[$mdl->TradeId] = $mdl->id;
                    $strTradeIds.= " ,'{$mdl->TradeId}'";
                }
                $strTradeIds = substr($strTradeIds, 2);

                $mssqlData = $this->getOrderStatus($strTradeIds);

                $Reason = '';
                foreach($mssqlData as $row){
                    $Reason .= $row['ISRETURN'] == 1 ? ',退货' : '';
                    $Reason .= $row['REFUNDSTATUS'] == 2 ? ',退款' : '';
                    $mdlExpress->where('id', $ids[$row['TradeId']])->update([ 'status'=>5, 'Reason' => substr($Reason, 1)]);
                }
            });

        logger("artisan {$this->signature} finished", []);
    }

    private function getOrderStatus($strTradeIds){
        $mssql = DB::connection('sqlsrv');
        $mssql->setFetchMode(2);

        $querySql = "select TradeId, ISRETURN, REFUNDSTATUS from SalesOrder where TradeId in({$strTradeIds}) and (ISRETURN = 1 or REFUNDSTATUS = 2)";
        $mssqlData = $mssql->select($querySql);

        return $mssqlData;
    }

}
