<?php

namespace App\Controllers\Article;

use App\Controllers\BaseController;
use App\Entities\Article;
use App\Models\ArticleModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;

class Image extends BaseController
{
    private ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    public function new($id)
    {
        $article = $this->getArticleOr404($id);

        return view("Article/Image/new", [
            "article" => $article
        ]);
    }

    public function create($id)
    {
        $article = $this->getArticleOr404($id);

        $file = $this->request->getFile("image");

        if (!$file->isValid()) {

            $error_code = $file->getError();

            if ($error_code === UPLOAD_ERR_NO_FILE) {

                return redirect()->back()
                    ->with("errors", ["No file selected"]);
            }

            throw new RuntimeException($file->getErrorString() . " " . $error_code);
        }

        if ($file->getSizeByUnit("mb") > 2) {

            return redirect()->back()
                ->with("errors", ["File too large"]);
        }

        if (!in_array($file->getMimeType(), ["image/png", "image/jpeg"])) {

            return redirect()->back()
                ->with("errors", ["Invalid file format"]);
        }

        $path = $file->store("article_images");

        $path = WRITEPATH . "uploads/" . $path;

        service("image")
            ->withFile($path)
            ->fit(200, 200, "center")
            ->save($path);

        dd($path);
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
