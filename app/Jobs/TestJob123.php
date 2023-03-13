<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class TestJob123 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $jobParam;
    
  public $tries = 3;
  public $timeout = 5;
  public $retry_after = 10;
    /**
     * Create a new job instance.
     */
    public function __construct($jobParam)
    {
        $this->jobParam = $jobParam;
        //
    }

    
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(3);
        
        $payload = $this->job->payload();
        $str = json_encode(unserialize($payload['data']['command']->id)->jobParam);

        $path = 'C:\Users\andru\OneDrive\Рабочий стол\всякая всячина\laravel\Очереди\application\storage\test.log';
        file_put_contents($path, $str,FILE_APPEND);
        Artisan::call("command:test");
    }

    function searchParam($paramName)
    {

    }
}
