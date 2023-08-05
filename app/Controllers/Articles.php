<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Article;
use App\Models\ArticleModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController
{
    private ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    public function index()
    {
        $data = $this->model->findAll();

        return view("Articles/index", [
            "articles" => $data
        ]);
    }

    public function show($id)
    {
        $article = $this->getArticleOr404($id);

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
        $article = new Article($this->request->getPost());

        $id = $this->model->insert($article);

        if ($id === false) {

            return redirect()->back()
                ->with("errors", $this->model->errors())
                ->withInput();
        }

        return redirect()->to("articles/$id")
            ->with("message", "Article saved.");
    }

    public function edit($id)
    {
        $article = $this->getArticleOr404($id);

        return view("Articles/edit", [
            "article" => $article
        ]);
    }

    public function update($id)
    {
        $article = $this->getArticleOr404($id);

        $article->fill($this->request->getPost());

        if (!$article->hasChanged()) {

            return redirect()->back()
                ->with("message", "Nothing to update.");
        }

        if ($this->model->save($article)) {

            return redirect()->to("articles/$id")
                ->with("message", "Article updated.");
        }

        return redirect()->back()
            ->with("errors", $this->model->errors())
            ->withInput();
    }

    public function delete($id)
    {
        $article = $this->getArticleOr404($id);

        if ($this->request->is("delete")) {

            $this->model->delete($id);

            return redirect()->to("articles")
                ->with("message", "Article deleted.");
        }

        return view("Articles/delete", [
            "article" => $article
        ]);
    }

    private function getArticleOr404($id): Article
    {
        $article = $this->model->find($id);

        if ($article === null) {

            throw new PageNotFoundException("Article with id $id not found");
        }

        return $article;
    }
}
