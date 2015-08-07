<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Jobs\DeferrableFeatureExecution;
use Illuminate\Http\Request;


$app->get('/', function (Request $request) use ($app){
    Cache::put("account_status_{$request->input('accountId')}", true, 100000);
    return (string)Cache::get("account_status_{$request->input('accountId')}");
});

$executeFunction = function (Request $request) {
    // TODO: decrypt request...
    $accountId = $request->input('accountId');
    $accountStatus = Cache::get("account_status_{$accountId}");
    if ($accountStatus) {
        // queue stuff
        $featureInstanceId = $request->input('featureId');
        Queue::push(new DeferrableFeatureExecution($accountId, $featureInstanceId));
        return 'true';
    } else {
        return 'false';
    }
};

$app->get('/q', $executeFunction);
$app->post('/q', $executeFunction);

