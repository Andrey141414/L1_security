<?php

use App\Jobs\TestJob;
use App\Jobs\TestJob123;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (Request $request) {
    
    $param = $request->key;
    TestJob::dispatch($param)->onQueue('booking');
    TestJob123::dispatch($param)->onQueue('booking1');
    return $param;
});

Route::get('/getParam', function () {

    //Queue::class;
     
    //$str = (unserialize($payload['data']['command']));


    //return ($payload);
});

Route::get('/posts', [PostsController::class,'index']);

Route::get('/find_phone', function () {

   return view('find_phone');
});