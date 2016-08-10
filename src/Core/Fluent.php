<?php

namespace Hasnayeen\Fluent\Core;

use Hasnayeen\Fluent\Core\NodeFactory;
use Hasnayeen\Fluent\Core\Request;

class Fluent
{
    public $user;
    
    public function __construct($user)
    {
        $this->user = $user;
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