<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Task\Express;
use App\Api\Kdniao;

use DB;

class UpdateExpressTraceMt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:express_trace_mt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update the express trace info from KuaiDiNiao by manual';

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
    public function handle(Express $mdlExpress, Kdniao $Kdniao){
        logger("artisan {$this->signature} stared", []);
        $ListCode = config('kdniao.Code');

        DB::enableQueryLog();

        $mdlExpress
            ->where('status', 1)
            ->whereNotIn('ExpressNameActual', ['中通', '京东快递'])
            ->orderBy('id', 'desc')
            ->chunk(1000, function($mdls) use($Kdniao, $ListCode) {
                foreach($mdls as $row){
                    if(!array_key_exists($row['ExpressNameActual'], $ListCode)){
                        logger('KdNiao.error', ['no'=>$row['ExpressNumber'], 'res'=>'不支持的快递', 'code'=>$row['ExpressNameActual']]);
                        continue;
                    }
                    $code = $ListCode[$row['ExpressNameActual']];
                    $responseJson = $Kdniao->search($code, $row['ExpressNumber']);
                    $rtArr = json_decode($responseJson, true);
                    if($rtArr['Success']){
                        if(isset($rtArr['Reason'])){
                            $row->status = 4;
                            $row->reason = $rtArr['Reason'];
                            $row->express_trace = null;
                        } else {
                            $row->status = isset($rtArr['State']) ? $rtArr['State'] : 2;
                            $row->express_trace = json_encode($rtArr['Traces']);
                        }
                        $row->save();
                    } else {
                        logger('KdNiao', ['no'=>$row['ExpressNumber'], 'res'=>$responseJson]);
                    }
                }
                $this->line('50 passed----------');
            });
        logger("artisan {$this->signature} finished", []);
    }
}
