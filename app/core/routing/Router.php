<?php
namespace App\Core\Routing;
use App\Core\Request;
class Router
{
    private $routes;
    private $currentRoute;
    private $request;

    const BASE_CONTROLLER = "App\controllers\\";

    public function __construct(Request $request)
    {
        $this->routes = Routes::getRoutes();
        // niceDD($this->routes);
        $this->request = $request;
        $this->currentRoute = $this->findRoute($this->request) ?? null;
        if ($this->currentRoute) {
            $this->runMiddleware();
        }
    }
    public function runMiddleware()
    {
        if (!$this->currentRoute)
            return;
        if (!isset($this->currentRoute["middleware"]))
            return;

        foreach ($this->currentRoute["middleware"] as $middle) {
            $class = new $middle;
            $class->handle();
        }

    }

    public function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if (!in_array($request->getMethod(), $route["method"])) {
                continue;
            }
            if ($this->regexMatch($route)) {
                // niceDD("YES");
                return $route;
            }
        }
    }

    public function regexMatch($route)
    {

        $pattern = "/^" . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $route["uri"]) . "$/";
        $res = preg_match($pattern , $this->request->getUri() , $matches);
        if (!$res)
            return;
        foreach ($matches as $key => $value) {
            if(!is_numeric($key)){
                $this->request->addAttr($key, $value);

            }
        }
        return true;

    }

    public function run()
    {
        // niceDD($this->currentRoute);
        if ($this->currentRoute)
            $this->handleActions($this->currentRoute);
        else {
            includeView("error.404");
        }
    }
    public function handleActions($currentRoute)
    {
        $action = $currentRoute["action"];
        if (!$action)
            return null;
        if (is_callable($action))
            $action();
        if (is_string($action)) {
            $action = explode("@", $action);

        }
        if (is_array($action)) {
            $class = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];
            if (!class_exists($class)) {
                echo "Class not exists";
            }
            if (!method_exists($class, $method)) {
                echo "Method not exists";
            }
            $classModel = new $class($this->request);
            $classModel->$method();
        }
    }

}