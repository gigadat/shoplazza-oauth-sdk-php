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

        return view('page-test', ['tokenAndShop' => $tokenAndShop_arr, 'siteId' => $siteId]);
    }

    // submitSiteId controller
    public function submitSiteId(Request $request)
    {
        $request->validate([
            'site_id' => ['string', 'required'],
        ]);

        $siteId = $request->input('site_id');

        setcookie("siteId", $siteId, time() + 3600, '/');

        return redirect()->route('page.test');
    }

    // add badge script to the store
    public function addBadgecript() {
        $client = new Client();

        $postUrl = $request->input('shop') . "/openapi/2022-01/script_tags_new";
        $accessToken = $request->input('access_token');

        $badgeScriptPath = env('APP_ENV') === 'production' ? "/scripts/trulybadge.js" : "/scripts/trulybadge_qa.js";
        $badgeScriptUrl = env('APP_URL') . $badgeScriptPath;

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
        } catch (\Exception $e) {
            Log::error('Badge script add failed for ' . $postUrl . ': ' . $e->getMessage());
        }
    }

    // add site id to store's badge script
    public function updateBadgeScript(Request $request) {

    }
}
