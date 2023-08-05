<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class Articles extends BaseController
{
    public function index()
    {
        $model = new ArticleModel;

        $data = $model->findAll();

        return view("Articles/index", [
            "articles" => $data
        ]);
    }
}
