<?php

define('BASE_PATH', str_replace($_SERVER["DOCUMENT_ROOT"], '', dirname(__FILE__)));
define('BASE_URL', 'http://' . $_SERVER["HTTP_HOST"] . BASE_PATH);

require_once('core/App.php');

$app = new core\App();

echo 'hello';
