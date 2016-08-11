<?php

namespace Iluminar\Fluent\Core;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

/**
 * Make http request to facebook graph api.
 */
class Request
{
    const API_BASE_URL = 'https://graph.facebook.com/v2.7/';
    const AUTH_BASE_URL = 'https://www.facebook.com/2.7/dialog/oauth';

    public static function get($url = null, $endpoint = null, $params = null)
    {
        $url = ($url == null) ? self::API_BASE_URL.$endpoint : $url;

        return self::makeRequest('GET', $url, $params);
    }

    public static function post($url, $params = null)
    {
        $client = new Client();

        return $client->post($url, $params);
    }

    public static function makeRequest($method, $url, $params)
    {
        $client = new Client();
        $response = $client->request($method, $url, $params);

        return self::parseResponse($response);
    }

    public static function parseResponse($response)
    {
        $array = json_decode((string) $response->getBody(), true);

        return Collection::make($array);
    }
}
