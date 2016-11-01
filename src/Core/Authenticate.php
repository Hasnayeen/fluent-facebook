<?php

namespace Iluminar\Fluent\Core;

use App\User;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Iluminar\Fluent\Core\Request as FluentRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Authenticate
{
    const BASE_URL = 'https://www.facebook.com/v2.7/dialog/oauth';
    const GRAPH_URL = 'https://graph.facebook.com/v2.7';
    const TOKEN_URL = 'https://graph.facebook.com/oauth/access_token';
    const RESPONSE_TYPE = 'code';

    protected $request;
    protected $clientId;
    protected $clientSecret;
    protected $redirectUrl;
    protected $encodingType = PHP_QUERY_RFC1738;
    protected $fields = ['name', 'email', 'gender', 'verified'];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->clientId = Config::get('fluent.facebook.client_id');
        $this->clientSecret = Config::get('fluent.facebook.client_secret');
        $this->redirectUrl = Config::get('fluent.facebook.redirect_uri');
    }

    public function redirect()
    {
        $this->request->session()->set('state', $state = Str::random(40));

        return new RedirectResponse($this->getAuthUrl($state));
    }

    public function getAuthUrl($state)
    {
        return self::BASE_URL.'?'.$this->getQueryParams($state).$this->getAllScopes();
    }

    public function getAllScopes()
    {
        $scopes = '&scope=';
        foreach (Config::get('fluent.scopes') as $key => $scope) {
            $scopes .= ($scope) ? $key.',' : '';
        }
        $scopes = rtrim($scopes, ',');

        return $scopes;
    }

    public function getQueryParams($state)
    {
        $fields = [
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->redirectUrl,
            'response_type' => self::RESPONSE_TYPE,
            'state'         => $state,
        ];

        return http_build_query($fields, '', '&', PHP_QUERY_RFC1738);
    }

    public function getCode()
    {
        return $this->request->input('code');
    }

    public function getAccessTokenResponse($code)
    {
        $postKey = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';

        $response = FluentRequest::post(self::TOKEN_URL, [
            $postKey => [
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => $this->redirectUrl,
                'code'          => $code,
            ],
        ]);
        $data = [];

        parse_str($response->getBody(), $data);

        return Arr::add($data, 'expires_in', Arr::pull($data, 'expires'));
    }

    public function user()
    {
        $response = $this->getAccessTokenResponse($this->getCode());

        $user = $this->getUserByToken($token = Arr::get($response, 'access_token'))->toArray();
        $user['token'] = Arr::get($response, 'access_token');
        $user['refresh_token'] = Arr::get($response, 'refresh_token');
        $user['expires_in'] = Arr::get($response, 'expires_in');

        return $user;
    }

    protected function getUserByToken($token)
    {
        $meUrl = self::GRAPH_URL.'/me?access_token='.$token.'&fields='.implode(',', $this->fields);

        if (!empty($this->clientSecret)) {
            $appSecretProof = hash_hmac('sha256', $token, $this->clientSecret);

            $meUrl .= '&appsecret_proof='.$appSecretProof;
        }

        return FluentRequest::get($meUrl, null, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
