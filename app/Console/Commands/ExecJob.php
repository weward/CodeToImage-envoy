<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExecJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exec:job {job} {--param=*} {--queue=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manual execution of Jobs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // @string
        $job = "\App\Jobs\\{$this->argument('job')}";
        // @array
        $params = $this->option('param');
        // @string
        $queue = $this->option('queue');

        if ($queue) {
            $job::dispatch(...$params)->onQueue($queue);
            $this->info("{$job} was successfully dispatched on {$queue} queue!");
            return;
        }

        $job::dispatch(...$params);
        $this->info("{$job} was successfully dispatched!");

        return Command::SUCCESS;
    }

}
