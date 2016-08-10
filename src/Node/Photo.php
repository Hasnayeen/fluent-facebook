<?php

namespace Hasnayeen\Fluent\Node;

use Hasnayeen\Fluent\Core\Node;
use Hasnayeen\Fluent\Core\Request;

/**
* This class represents a user in facebook graph api
*/
class Photo extends Node
{
    public $id;
    public $endpoint;

    public function __construct($token, $id)
    {
        parent::setToken($token);
        $this->id = $id;
        $this->endpoint = $this->id;
    }

    public function __call($method, $parameters)
    {
        dd($method);
        $class = $this->createClass($method);

        return $this->defaultCall($class); 
    }

    public function posts()
    {
        return Request::get($this->id . '/posts', ['access_token' => $this->token]);
    }
}