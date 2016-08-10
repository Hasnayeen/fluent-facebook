<?php

namespace Hasnayeen\Fluent\Node;

use Hasnayeen\Fluent\Core\Node;
use Hasnayeen\Fluent\Core\Request;

/**
* This class represents an individual entry in a profile's feed in facebook social graph
*/
class Post extends Node
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
        $class = $this->createClass($method);

        return $this->defaultCall($class); 
    }
}