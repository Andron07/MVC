<?php
require_once APP_ROOT . '/views/inc/header.view.php';
?>
<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <h1 class="display-3"><?= $data['title'] ?></h1>
        <p class="lead">
            <?= $data['description'] ?>
        </p>
        <p>App version: <?= APP_VERSION ?></p>
    </div>
</div>
<?php
require_once APP_ROOT . '/views/inc/footer.view.php';
?>