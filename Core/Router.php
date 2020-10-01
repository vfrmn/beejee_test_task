<?php

namespace Core;


class Router
{


    private function getActionData(): array
    {
        $controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
        $action = $_GET['action'] ?? DEFAULT_ACTION;
        return [$controller, $action];
    }


    public function run(): void
    {
        $actionData = $this->getActionData();
        $controller_name = '\\App\\Controllers\\' . $actionData[0];
        $method_name = $actionData[1];
        if (!class_exists($controller_name))
            die('Controller not found!');
        $controller = new $controller_name;


        if (!method_exists($controller, $method_name))
            die('Action not found!');
        $controller->$method_name();
    }
}
