<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Article<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1><?= esc($article->title) ?></h1>

<p><?= esc($article->content) ?></p>

<?php if (
  $article->isOwner() ||
  auth()->user()->can("articles.edit")
) : ?>

  <a href="<?= url_to("Articles::edit", $article->id) ?>">Edit</a>

<?php endif; ?>

<?php if (
  $article->isOwner() ||
  auth()->user()->can("articles.delete")
) : ?>

  <a href="<?= url_to("Articles::confirmDelete", $article->id) ?>">Delete</a>

<?php endif; ?>

<?= $this->endSection() ?>
