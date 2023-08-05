<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = "article";

    protected $allowedFields = ["title", "content"];

    protected $validationRules = [
        "title" => "required|max_length[128]",
        "content" => "required"
    ];
}
