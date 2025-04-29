<?php
namespace App\Core\Routing;
class Routes
{
    private static $routes;

    public static function add($method, $uri, $action, $middleware = [])
    {
        $method = is_array($method) ? $method : [$method];
        self::$routes[] = ["method" => $method, "uri" => $uri, "action" => $action, "middleware" => $middleware];
    }
    public static function get($uri, $action, $middleware = [])
    {
        self::add("get", $uri, $action, $middleware);
    }
    public static function post($uri, $action, $middleware = [])
    {
        self::add("post", $uri, $action, $middleware);
    }
    public static function delete($uri, $action, $middleware = [])
    {
        self::add("delete", $uri, $action, $middleware);
    }
    public static function getRoutes()
    {
        return self::$routes;
    }
}