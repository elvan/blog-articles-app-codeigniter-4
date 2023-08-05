<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view("header", ["title" => "Home"])
            . view("Home/index");
    }
}
