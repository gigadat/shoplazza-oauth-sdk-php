<?php
return[
    'clientID' => env('CLIENT_ID'),
    'clientSecret' => env('CLIENT_SECRET'),
    'redirectURL'=> env('REDIRECT_URL'),
    'Scopes' => [
        "read_product", "write_product","read_shop","write_shop"
    ],
    'Endpoint'=>[
        "AuthURL"=>"/admin/oauth/authorize",
        "TokenURL"=>"/admin/oauth/token",
    ],
    "doMain" => "myshoplaza.com",
    "requestPath"=>"oauth_sdk/app_uri",
    "callbackPath"=>"oauth_sdk/redirect_uri",
    "funcRewrite" => true,

];
