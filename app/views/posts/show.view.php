<?php
require_once APP_ROOT . '/views/inc/header.view.php';
?>
<a href="<?= URL_ROOT ?>/posts/" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?= $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written By: <?= $data['user']->name ?> at <?= $data['post']->created_at ?>
</div>
<p><?= $data['post']->body ?></p>
<hr>
<?php
if ($data['user']->id == $_SESSION['user_id']) {
?>
    <a href="<?= URL_ROOT ?>/posts/edit/<?= $data['post']->id ?>" class="btn btn-dark">Edit</a>

    <form class="pull-right" action="<?=URL_ROOT ?>/posts/delete/<?= $data['post']->id?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger " >
    </form>
<?php
}
?>
<?php
require_once APP_ROOT . '/views/inc/footer.view.php';
?>