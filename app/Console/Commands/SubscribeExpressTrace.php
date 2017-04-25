<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Task\Express;
use App\Api\Kdniao;

class SubscribeExpressTrace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:express_trace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'subscribe the express trace info from KuaiDiNiao';

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
        $mdls = $mdlExpress
            ->where('status', '0')
            ->whereNotIn('ExpressNameActual', [ '京东快递'])
//            ->take(5000)
            ->orderBy('id', 'desc')
//            ->get();
            ->chunk(500, function($mdls) use($Kdniao) {
                
                $ListCode = config('kdniao.Code');
                foreach ($mdls as $row) {
                    if (!array_key_exists($row->ExpressNameActual, $ListCode)) {
                        logger('KdNiao.error', ['no' => $row->ExpressNumber, 'res' => '不支持的快递', 'code' => $row->ExpressNameActual]);
                        continue;
                    }
                    $job = new \App\Jobs\Admin\Task\SubscribeExpressTrace($row);
                    dispatch($job);
                }
            });
        logger("artisan {$this->signature} finished", []);
    }
}
