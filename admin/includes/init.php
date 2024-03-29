<?php
// directories path
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
// defined('DS') ? null : define('SITE_ROOT', DS. 'xampp'.DS.'htdocs'.DS.'gallerySystem');
defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'Gallery-System-Php');
defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once 'functions.php';
require_once 'new_config.php';
require_once 'database.php';
require_once 'db_object.php';
require_once 'user.php';
require_once 'photo.php';
require_once 'comments.php';
require_once 'sessions.php';
require_once 'paginate.php';

?>

