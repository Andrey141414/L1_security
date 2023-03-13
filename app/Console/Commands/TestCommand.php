<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $all_time = 60;
        $time_step = 5;
        $value = "123";
        $jobs = DB::table('jobs')->where('queue','booking')->get();
        if(DB::table('jobs')->where('queue','booking')->count() == 0)
        {
            echo "Нет заданий в очереди\n";
            return ;
        }

        for($i = 0;$i<$all_time/$time_step;$i++)
        {
            $jobs = DB::table('jobs')->where('queue','booking')->get();
            echo($this->isOurJobInQueue($jobs, $value));
            sleep($time_step);    
        }
        //echo($this->isOurJobInQueue($jobs, $value)); 
        // $break = false;

        // while($break)
        // {
            
        // }
        

        return;






        $str = "O:16:\"App\\Jobs\\TestJob\":2:{s:26:\"\u0000App\\Jobs\\TestJob\u0000jobParam\";s:5:\"Value\";s:5:\"queue\";s:7:\"booking\";}";
        echo($this->searchParam('jobParam',$str));
        return;
        // //'{\"\u0000App\\O:16:\"App\\Jobs\\TestJob\":2:{s:8:\"jobParam\";i:123;s:5:\"queue\";s:7:\"booking\";}}';
        // echo(json_encode(unserialize($str)));
        //return ;
        //
        $path = 'C:\Users\andru\OneDrive\Рабочий стол\всякая всячина\laravel\Очереди\application\storage\test.txt';
        file_put_contents($path,"\n".Carbon::now()."\n",FILE_APPEND);
        //echo("test\n");
        return;
    }


    function isOurJobInQueue($jobs, $value)
    {
        foreach($jobs as $job)
        {
            $payload = (unserialize(json_decode($job->payload)->data->command)->jobParam);
            echo("payload = $payload \tValue = $value\n");
            if($payload == $value)
            {
                return "Yes\n";
            }
        }
        return "No\n";
    }
    function searchParam($paramName,$str)
    {
        //echo($paramName);
        return $paramName;
    }
}
