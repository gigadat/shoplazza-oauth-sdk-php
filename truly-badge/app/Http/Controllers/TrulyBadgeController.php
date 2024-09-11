<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TrulyBadgeController extends Controller
{
    // plugin installation landing page
    public function index()
    {
        return Inertia::render('TrulyBadge/Index');
    }

    // plugin home page
    public function home()
    {
        return Inertia::render('TrulyBadge/Home/Index');
    }

    // plugin badges page
    public function badges()
    {
        return Inertia::render('TrulyBadge/Badges/Index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'siteId' => ['string', 'required', 'uuid'],
        ]);

        $siteId = $request->input('siteId');

        // store siteId in cookie for 1 year
        $ExpirationTime = 12*31*24*60*60;
        setcookie('site-id', $siteId, [
            'SameSite' => 'Lax',
            'Secure' => true,
            'Expires' => time() + $ExpirationTime,
        ]);

        // get token and shop from cookie and pass shop and access token to addBadgescript method
        $tokenAndShop = $_COOKIE["tokenAndShop"] ?? null;
        parse_str($tokenAndShop, $tokenAndShop_arr);

        // check if script-tag-id exists in cookie
        $scriptTagId = $_COOKIE["script-tag-id"] ?? null;

        // if scriptTagId exists, use PUT request to update badge script
        if ($scriptTagId) {
            $this->updateBadgeScript($tokenAndShop_arr, $siteId, $scriptTagId);
        } else {
            $this->addBadgeScript($tokenAndShop_arr, $siteId);
        }

        return redirect()->route('badges', ['formSubmitted' => true]);
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

                // get script_tag id from response and store in cookie for 1 year
                $scriptTagId = json_decode($response->getBody())->script_tag->id;
                $ExpirationTime = 12*31*24*60*60;
                setcookie('script-tag-id', $scriptTagId, [
                    'SameSite' => 'Lax',
                    'Secure' => true,
                    'Expires' => time() + $ExpirationTime,
                ]);
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
