<?php

use PHPShoplazza\Oauth2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Request URL format: app_url?hmac=${hmac}&install_from=app_store&shop=${store_domian_name}&store_id=${store_id}
Route::get('/auth', function (Request $request) {
    $hmac = $request->hmac;
    $install_from = $request->install_from;
    $shop = $request->shop;
    $store_id = $request->store_id;

    // log values to laravel.log
    Log::info('hmac: '.$hmac);
    Log::info('install_from: '.$install_from);
    Log::info('shop: '.$shop);
    Log::info('store_id: '.$store_id);

    // create instance of oauth2 class
    $oauth = new Oauth2( env('CLIENT_ID'), env('CLIENT_SECRET'), env('REDIRECT_URL'), [ "read_shop" ]);
    
    // if any of the checks fail, then your app must reject the request with an error, and must not continue.
    // check if validshop
    if ($oauth->ValidShop($shop) == false) {
        return response()->json([
            'error' => 'Invalid shop'
        ], 400);
    }
    
    // check if hmac is valid
    if ($oauth->SignatureValid($hmac) == false) {
        return response()->json([
            'error' => 'Invalid hmac'
        ], 400);
    }
});
