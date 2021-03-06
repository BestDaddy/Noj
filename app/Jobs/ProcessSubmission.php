<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Submission\SubmissionModel;
use App\Babel\Babel;
use Illuminate\Support\Facades\Log;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries=1;
    protected $all_data=[];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($all_data)
    {
        $this->all_data=$all_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $babel=new Babel();
        $babel->submit($this->all_data);
    }

    public function failed()
    {
        Log::info('sub_id failed: '. $this->all_data["sid"]);
        $submissionModel=new SubmissionModel();
        $submissionModel->updateSubmission($this->all_data["sid"], ["verdict"=>"Submission Error"]);
    }
}
