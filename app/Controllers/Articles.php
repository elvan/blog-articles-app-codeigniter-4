<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Article;
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

    public function show($id)
    {
        $model = new ArticleModel;

        $article = $model->find($id);

        return view("Articles/show", [
            "article" => $article
        ]);
    }

    public function new()
    {
        return view("Articles/new", [
            "article" => new Article
        ]);
    }

    public function create()
    {
        $model = new ArticleModel;

        $article = new Article($this->request->getPost());

        $id = $model->insert($article);

        if ($id === false) {

            return redirect()->back()
                ->with("errors", $model->errors())
                ->withInput();
        }

        return redirect()->to("articles/$id")
            ->with("message", "Article saved.");
    }

    public function edit($id)
    {
        $model = new ArticleModel;

        $article = $model->find($id);

        return view("Articles/edit", [
            "article" => $article
        ]);
    }

    public function update($id)
    {
        $model = new ArticleModel;

        $article = $model->find($id);

        $article->fill($this->request->getPost());

        if (!$article->hasChanged()) {

            return redirect()->back()
                ->with("message", "Nothing to update.");
        }

        if ($model->save($article)) {

            return redirect()->to("articles/$id")
                ->with("message", "Article updated.");
        }

        return redirect()->back()
            ->with("errors", $model->errors())
            ->withInput();
    }
}
