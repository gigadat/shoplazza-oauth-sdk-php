<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrulyBadgeController extends Controller
{
    // pageTest controller
    public function pageTest()
    {
        $tokenAndShop = $_COOKIE["tokenAndShop"] ?? null;
        parse_str($tokenAndShop, $tokenAndShop_arr);

        $siteId = $_COOKIE["siteId"] ?? null;

        $trulyBadgeResponse = $_COOKIE["trulyBadgeResponse"] ?? null;

        return view('page-test', [
            'tokenAndShop' => $tokenAndShop_arr, 
            'siteId' => $siteId,
            'trulyBadgeResponse' => $trulyBadgeResponse,
        ]);
    }

    // submitSiteId controller
    public function submitSiteId(Request $request)
    {
        $request->validate([
            'site_id' => ['string', 'required'],
        ]);

        $siteId = $request->input('site_id');

        setcookie("siteId", $siteId, time() + 3600, '/');

        // get token and shop from cookie and pass shop and access token to addBadgecript method
        $tokenAndShop = $_COOKIE["tokenAndShop"] ?? null;
        parse_str($tokenAndShop, $tokenAndShop_arr);

        $this->addBadgecript($tokenAndShop_arr);

        return redirect()->route('page.test');
    }

    // add badge script to the store
    public function addBadgecript($tokenAndShop_arr) 
    {   
        Log::info('Adding badge script to store ' . $tokenAndShop_arr['shop']);

        // $request->validate([
        //     'shop' => ['string', 'required'],
        //     'access_token' => ['string', 'required'],
        // ]);

        $client = new Client();

        $postUrl = "https://" . $tokenAndShop_arr['shop'] . "/openapi/2022-01/script_tags_new";
        Log::info('postUrl: ' . $postUrl);
        $accessToken = $tokenAndShop_arr['access_token'];
        Log::info('accessToken: ' . $accessToken);

        // $postUrl = $request->input('shop') . "/openapi/2022-01/script_tags_new";
        // $accessToken = $request->input('access_token');

        $badgeScriptPath = env('APP_ENV') === 'production' ? "/js/trulybadge.js" : "/js/trulybadge_qa.js";
        $badgeScriptUrl = env('APP_URL') . $badgeScriptPath;
        Log::info('badgeScriptUrl: ' . $badgeScriptUrl);

        try {
            $response = $client->request('POST', $postUrl, [
                'body' => json_encode([
                    'display_scope' => 'online',
                    'event_type' => 'trulybadge',
                    'src' => $badgeScriptUrl
                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'access-token' => $accessToken,
                    'content-type' => 'application/json',
                ],
            ]);
                
            Log::info('Badge script added successfully for ' . $postUrl);
            Log::info($response->getBody());

            setcookie("trulyBadgeResponse", $response->getBody(), time() + 3600, '/');
        } catch (\Exception $e) {
            Log::error('Badge script add failed for ' . $postUrl . ': ' . $e->getMessage());
        }
    }

    // add site id to store's badge script
    public function updateBadgeScript(Request $request) {

    }
}
