<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Task\Express;

use DB;

class FormatExpressTrace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'format:express_trace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'format the express trace info';

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
//        DB::enableQueryLog();

        $i = 1;

        $mdlExpress->where('status', 3)->chunk(100, function($mdls) use ($i){

            $this->info($i);
            $i++;

            foreach($mdls as $i=>$mdl){
                if(strpos($mdl->express_trace, '\\\u')){
                    $mdl->express_trace = str_replace('\\\u', '\u', $mdl->express_trace);
                    $mdl->save();
                } elseif(strpos($mdl->express_trace, '"u')) {
                    $mdl->express_trace = str_replace('u', '\u', $mdl->express_trace);
                    $mdl->save();
                }
                $mdl->formatTrace($mdl->ExpressNumber, $mdl->express_trace);
//                $job = (new \App\Jobs\Admin\Task\FormatOrderExpress($mdl->ExpressNumber, $mdl->express_trace));
//                dispatch($job);
            }
        });


//        dd(DB::getQueryLog());

//        $this->output->progressFinish();
        logger("artisan {$this->signature} finished", []);

    }
}
