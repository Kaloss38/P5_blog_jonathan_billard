<?php


use Core\Router;
 
Router::setDefaultNamespace('App\Controller');

Router::get('/', 'HomeController@home')->setName('home');

