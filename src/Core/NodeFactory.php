<?php

namespace Iluminar\Fluent\Core;

class NodeFactory
{
    
    public static function create($name, $param)
    {
        $class = "Iluminar\Fluent\Node\\" . ucfirst($name);
        list($token, $id) = $param;

        return new $class($token, $id);
    }
}