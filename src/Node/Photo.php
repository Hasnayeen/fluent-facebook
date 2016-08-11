<?php

namespace Iluminar\Fluent\Node;

use Iluminar\Fluent\Core\Node;
use Iluminar\Fluent\Core\Request;

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
        return $this->createClass($method);
    }

    public function likes()
    {
        $this->endpoint .= '/' . __FUNCTION__;

        return $this;
    }

    public function insights()
    {
        $this->endpoint .= '/' . __FUNCTION__;

        return $this;
    }

    public function tags()
    {
        $this->endpoint .= '/' . __FUNCTION__;

        return $this;
    }

    public function comments()
    {
        $this->endpoint .= '/' . __FUNCTION__;

        return $this;
    }
}