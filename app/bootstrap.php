<?php
// Load Configs
require_once 'config/config.php';
//load helpers
require_once 'helpers/url.helper.php';
require_once 'helpers/session.helper.php';
// Autoload Core libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
