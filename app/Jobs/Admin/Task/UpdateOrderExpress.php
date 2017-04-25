<?php

namespace App\Jobs\Admin\Task;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Admin\Task\Express;

class UpdateOrderExpress extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $receiveData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receiveData)
    {
        $this->receiveData = $receiveData;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Express $mdlExpress)
    {
        if($this->attempts() <= 1){
            $mdlExpress->receive($this->receiveData);
        }
    }


}
