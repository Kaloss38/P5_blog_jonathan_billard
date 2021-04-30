<?php


//Autoload
require "../vendor/autoload.php";

define("CONF_DIR", realpath(dirname(__DIR__)) . "/config" );

define("VIEW_DIR", realpath(dirname(__DIR__)) . "/src/Views" );

define("ROOT_DIR", dirname(__DIR__));




// Start the routing
\Core\Router::start();

//VIEW_DIR . "home.view.php";