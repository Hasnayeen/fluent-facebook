<?php

namespace Hasnayeen\Fluent\Core;

class NodeFactory
{
    
    public static function create($name, $param)
    {
        $class = "Hasnayeen\Fluent\Node\\" . ucfirst($name);
        list($token, $id) = $param;

        return new $class($token, $id);
    }
}