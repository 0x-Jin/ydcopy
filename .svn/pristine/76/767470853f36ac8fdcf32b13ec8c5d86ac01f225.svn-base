<?php

namespace App\Jobs\Admin\Task;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Admin\Task\Express;

class SearchExpressTrace extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $bn;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bn)
    {
        $this->bn = $bn;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Express $mdlExpress)
    {
        if($this->attempts() <= 1){
            $mdlExpress->trace($this->bn);
        }
    }


}
