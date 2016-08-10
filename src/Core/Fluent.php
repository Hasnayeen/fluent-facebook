<?php

namespace Iluminar\Fluent\Core;

use Iluminar\Fluent\Core\NodeFactory;
use Iluminar\Fluent\Core\Request;

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