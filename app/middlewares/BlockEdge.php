<?php
namespace App\Middlewares;
use hisorange\BrowserDetect\Parser as Browser;
use App\Middlewares\Contract\MiddlewareInterface;
class BlockEdge implements MiddlewareInterface{
    public function handle()
    {
        if(Browser::isEdge()){
            die("Your Browser is blocked !!");
        }
    }
}