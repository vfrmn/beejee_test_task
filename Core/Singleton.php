<?php

namespace Core;

trait Singleton
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

    static public function getInstance()
    {
        if (self::$instance === null) self::$instance = new self();
        return self::$instance;
    }
}
