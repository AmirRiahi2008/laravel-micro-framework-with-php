<?php


namespace App\Core;
class Request
{
    private $method;
    private $uri;
    private $agent;
    private $ip;
    private $params;
    private $attrs;

    public function __construct()
    {
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->uri = strtok($_SERVER["REQUEST_URI"], "?");
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->params = $_POST;
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function getUri()
    {
        return $this->uri;
    }
    public function getIp()
    {
        return $this->ip;
    }
    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }
    public function getParam($key)
    {
        return $this->params[$key];
    }
    public function getAttrs()
    {
        return $this->attrs;
    }
    public function getAttr($key)
    {
        return $this->attrs[$key];
    }
    public function addAttr($key, $value)
    {
        $this->attrs[$key] = $value;
    }
}