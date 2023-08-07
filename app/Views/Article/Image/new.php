<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Edit Article Image<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Edit Article Image</h1>

<?php if (session()->has("errors")) : ?>

    <ul>
        <?php foreach (session("errors") as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<?= form_open("articles/" . $article->id) ?>



</form>

<?= $this->endSection() ?>
