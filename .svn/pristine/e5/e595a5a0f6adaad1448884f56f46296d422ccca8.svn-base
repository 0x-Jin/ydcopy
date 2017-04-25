<?php

namespace App\Jobs\Admin\Task;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Admin\Task\Express;

class FormatOrderExpress extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $ExpressNumber;
    protected $express_trace;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ExpressNumber, $express_trace)
    {
        $this->ExpressNumber = $ExpressNumber;
        $this->express_trace = $express_trace;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Express $mdlExpress){
        if($this->attempts() <= 1){
            $mdlExpress->formatTrace($this->ExpressNumber, $this->express_trace);
        }
    }


}
