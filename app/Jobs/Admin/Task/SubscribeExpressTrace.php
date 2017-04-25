<?php

namespace App\Jobs\Admin\Task;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Admin\Task\Express;
use App\Api\Kdniao;

class SubscribeExpressTrace extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $mdl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mdl)
    {
        $this->mdl = $mdl;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Express $mdlExpress, Kdniao $Kdniao)
    {
        $ListCode = config('kdniao.Code');
        
        $mdl = $this->mdl;
        
        if($this->attempts() <= 1){
            $code = $ListCode[$mdl->ExpressNameActual];
            $responseJson = $Kdniao->subscribe($code, $mdl->ExpressNumber);
            $rtArr = json_decode($responseJson, true);
            if (isset($rtArr['Success'])) {
                logger('KdNiao success', ['no' => $mdl->ExpressNumber]);
                $mdl->status = 1;
                $mdl->save();
            } else {
                logger('KdNiao', ['no' => $mdl->ExpressNumber, 'res' => $responseJson]);
            }
        }
    }


}
