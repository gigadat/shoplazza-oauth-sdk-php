<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TrulyBadgeController extends Controller
{
    // plugin installation page
    public function index()
    {
        return Inertia::render('TrulyBadge/Index');
    }

    // test plugin functionality
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

    // handle site id submission
    public function submitSiteId(Request $request)
    {
        $request->validate([
            'site_id' => ['string', 'required'],
        ]);

        $siteId = $request->input('site_id');

        setcookie("siteId", $siteId, time() + 3600, '/');

        // get token and shop from cookie and pass shop and access token to addBadgescript method
        $tokenAndShop = $_COOKIE["tokenAndShop"] ?? null;
        parse_str($tokenAndShop, $tokenAndShop_arr);

        // check if scriptTagId exists in cookie
        $scriptTagId = $_COOKIE["scriptTagId"] ?? null;

        // if scriptTagId exists, use PUT request to update badge script
        if ($scriptTagId) {
            $this->updateBadgeScript($tokenAndShop_arr, $siteId, $scriptTagId);
        } else {
            $this->addBadgeScript($tokenAndShop_arr, $siteId);
        }

        return redirect()->route('page.test');
    }

    // add badge script to the store
    public function addBadgeScript($tokenAndShop_arr, $siteId) 
    {   
        Log::info('Adding badge script to store ' . $tokenAndShop_arr['shop'] . ' with site id ' . $siteId);

        $client = new Client();

        $postUrl = "https://" . $tokenAndShop_arr['shop'] . "/openapi/2022-01/script_tags_new";
        $accessToken = $tokenAndShop_arr['access_token'];

        // if site id exists, add query parameter to badgeScriptPath
        $badgeScriptPath = env('APP_ENV') === 'production' ? "/js/trulybadge.js" : "/js/trulybadge_qa.js";
        if ($siteId) {
            $badgeScriptPath .= '?siteId=' . $siteId;
        }
        $badgeScriptUrl = env('APP_URL') . $badgeScriptPath;

        // use script_tag request to add badge script to store
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

            if ($response->getStatusCode() == 200) {
                Log::info('Badge script added successfully for ' . $postUrl);

                // get script_tag id from response and store in cookie
                $scriptTagId = json_decode($response->getBody())->script_tag->id;
                setcookie("scriptTagId", $scriptTagId, time() + 3600, '/');

                setcookie("trulyBadgeResponse", $response->getBody(), time() + 3600, '/');
            } else {
                Log::error('Badge script add failed for ' . $postUrl);
            }
        } catch (\Exception $e) {
            Log::error('Badge script add failed for ' . $postUrl . ': ' . $e->getMessage());
        }
    }

    // update badge script in the store
    public function updateBadgeScript($tokenAndShop_arr, $siteId, $scriptTagId) {
        Log::info('Updating badge script for store ' . $tokenAndShop_arr['shop'] . ' with site id ' . $siteId);

        $client = new Client();

        $putUrl = "https://" . $tokenAndShop_arr['shop'] . "/openapi/2022-01/script_tags_new/" . $scriptTagId;
        $accessToken = $tokenAndShop_arr['access_token'];

        // if site id exists, add query parameter to badgeScriptPath
        $badgeScriptPath = env('APP_ENV') === 'production' ? "/js/trulybadge.js" : "/js/trulybadge_qa.js";
        if ($siteId) {
            $badgeScriptPath .= '?siteId=' . $siteId;
        }
        $badgeScriptUrl = env('APP_URL') . $badgeScriptPath;

        // use script_tag request to add badge script to store
        try {
            $response = $client->request('PUT', $putUrl, [
                'body' => json_encode([
                    'src' => $badgeScriptUrl
                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'access-token' => $accessToken,
                    'content-type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                Log::info('Badge script updated successfully for ' . $putUrl);
            } else {
                Log::error('Badge script update failed for ' . $putUrl);
            }
        } catch (\Exception $e) {
            Log::error('Badge script update failed for ' . $putUrl . ': ' . $e->getMessage());
        }
    }
}
