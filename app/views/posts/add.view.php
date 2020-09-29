<?php
require_once APP_ROOT . '/views/inc/header.view.php';
?>
<a href="<?=URL_ROOT ?>/posts/" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?= URL_ROOT ?>/posts/add" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="test" id="title" name="title" class="form-control form-control-lg <?= !empty($data['title_error']) ? 'is-invalid' : '' ?>" value="<?= $data['title'] ?>">
            <span class="invalid-feedback"><?= $data['title_error'] ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea id="body" class="form-control form-control-lg <?= !empty($data['body_error']) ? 'is-invalid' : '' ?>" name="body" ><?= $data['body'] ?></textarea>
            <span class="invalid-feedback"><?= $data['body_error'] ?></span>
        </div>
        <div class="col">
            <input type="submit" class="btn btn-success btn-block" value="Add">
        </div>
    </form>
</div>
<?php
require_once APP_ROOT . '/views/inc/footer.view.php';
?>