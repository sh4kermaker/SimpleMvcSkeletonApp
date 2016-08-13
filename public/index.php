<?php

use SimpleMvc\Controller\AbstractController;
use SimpleMvc\Controller\RouterController;
use SimpleMvc\Model\Db;

session_start();
mb_internal_encoding("UTF-8");

define('APPLICATION_PATH', dirname(__DIR__));

chdir(APPLICATION_PATH);

if (!file_exists(APPLICATION_PATH . '/vendor/autoload.php')){
    throw new Exception("run composer update first");
}

require "vendor/autoload.php";

require "functions.php";

$locale = isset($_SESSION['locale']) ? $_SESSION['locale'] : AbstractController::LANGUAGE_SK;

putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("messages", "./private/locale");
textdomain("messages");
bind_textdomain_codeset("messages", "UTF-8");

$applicationEnv = getenv('APPLICATION_ENV');

if (!$applicationEnv){
    $applicationEnv = 'production';
}

define('APPLICATION_ENV', $applicationEnv);

if (APPLICATION_ENV == 'production'){
    error_reporting(0);
    ini_set('display_errors', 0);
}

$config = getConfig();

// Pripojenie k databaze ak je definovana
if (!empty($config['dbHost'])){
    Db::pripoj($config['dbHost'], $config['dbPouzivatel'], $config['dbHeslo'], $config['dbNazov']);
}

$queryStringPathParam = [$_SERVER['REQUEST_URI']];

$router = new RouterController($queryStringPathParam);
$router->renderView(); 