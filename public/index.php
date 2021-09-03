<?php

use Core\Router;
use Core\Security\CookieAuth;

//Autoload
require "../vendor/autoload.php";

define("CONF_DIR", realpath(dirname(__DIR__)) . "/config" );

define("VIEW_DIR", realpath(dirname(__DIR__)) . "/src/Views" );

define("ROOT_DIR", dirname(__DIR__));

//Starting session
session_start();

//Autolog if user remember
$cookieAuth = new CookieAuth();
$cookieAuth->AuthWithCookie();

// Start the routing
Router::start();

//VIEW_DIR . "home.view.php";
