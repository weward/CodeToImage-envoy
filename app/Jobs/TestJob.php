<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $param1;
    protected $param2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($param1, $param2 = null)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info("TestJob is working!!!!!");
        info("TestJob PARAM1: {$this->param1}");
        info("TestJob PARAM2: {$this->param2}");
    }
}
