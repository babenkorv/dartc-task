<?php
session_start();

/*------------- Define base constants -------------*/
define('D_S', DIRECTORY_SEPARATOR);
define('VIEWS_PATH', '/application/view/');
define('IMG_PATH', __DIR__ . '/application/assets/img');
define('PROJECT_BASE_DIR', __DIR__);

/*------------- Autoload -------------*/
require_once 'vendor/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->run();

/*------------- Routing -------------*/
$query = trim($_SERVER['REQUEST_URI'], '/');

\vendor\Router::add('^$', ['controller' => 'main', 'action' => 'index']);
\vendor\Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

\vendor\Router::dispatch($query);

