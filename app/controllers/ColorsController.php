<?php
namespace App\Controllers;
 class ColorsController{
    public function red()
    {
        includeView("colors.red");
    } public function green()
    {
        includeView("colors.green");
    } public function purple()
    {
        includeView("colors.purple");
    }
 }