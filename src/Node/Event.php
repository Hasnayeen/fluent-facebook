<?php

namespace Iluminar\Fluent\Node;

use Iluminar\Fluent\Core\Node;

/**
 * This class represents an event in facebook social graph.
 */
class Event extends Node
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
}
