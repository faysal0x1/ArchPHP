<?php

namespace Core;

class Container
{

    /**
     * The container's bindings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * The container's bindings.
     *
     * @var array
     */

    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }


    public function resolve($key)
    {

        if (!isset($this->bindings[$key])) {
            throw new \Exception("No binding found for {$key}");
        }

        if (array_key_exists($key, $this->bindings)) {
            $resolver = $this->bindings[$key];
            return call_user_func($resolver);
        }
    }
}
