<?php

namespace Iluminar\Fluent\Node;

use Iluminar\Fluent\Core\Node;

/**
 * This class represents a user in facebook graph api.
 */
class User extends Node
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

    public function posts()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function feed()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function photos()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function albums()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function books()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function groups()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function likes()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function permissions()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function friendlists()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function friends()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function games()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function movies()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function music()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function objects()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function television()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function home()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function inbox()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function friendrequests()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function notifications()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function outbox()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function followers()
    {
        $this->endpoint .= '/'.'subscribers';

        return $this;
    }

    public function following()
    {
        $this->endpoint .= '/'.'subscribedto';

        return $this;
    }

    public function questions()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function checkins()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function videos()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function tagged_places()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function achievements()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }

    public function apprequests()
    {
        $this->endpoint .= '/'.__FUNCTION__;

        return $this;
    }
}
