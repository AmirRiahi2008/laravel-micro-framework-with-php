<?php
namespace App\Controllers;
use App\Core\Request;
use App\Models\User;
class HomeController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        $userModel = new User(2);
        // $userModel = new User(1);
        // $userModel->insert(["name" => "aaaaaaaaaaa" , "pass" => "123"]);
        // $userModel->delete(["id" => 56]);
        // $userModel->name = "amirww";
        // $userModel->save();
        // $userModel->update([
        //     "name" => "hassan",
        //     "pass" => "123Amir"
        // ], [
        //     "id" => "42"
        // ]);
        echo "Welcome to home screen 😇";
    }
}