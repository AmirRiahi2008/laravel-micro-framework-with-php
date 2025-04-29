<?php
namespace App\Controllers;
use App\Core\Request;
class PostsController{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function index()
    {
       foreach ($this->request->getAttrs() as $key => $value) {
        echo $key . "=" . $value . "<br>";
       }
    }
}