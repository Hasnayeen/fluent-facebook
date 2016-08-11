<?php

namespace Iluminar\Fluent\Core;

use Illuminate\Support\Facades\Auth;


class Fluent
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function __call($method, $parameters)
    {
        return $this->createClass($method, $parameters[0]);
    }

    public function createClass($name, $params)
    {
        return NodeFactory::create($name, [$this->user->token, $params]);
    }
}
