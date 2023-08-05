<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Articles extends BaseController
{
    public function index()
    {
        $db = db_connect();

        dd($db->listTables());

        $data = [
            ["title" => "One", "content" => "The first"],
            ["title" => "Two", "content" => "Some content"]
        ];

        return view("Articles/index", [
            "articles" => $data
        ]);
    }
}
