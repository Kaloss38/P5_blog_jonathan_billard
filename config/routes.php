<?php


use Core\Router;
 
Router::setDefaultNamespace('App\Controller');

// HOME //

Router::get('/', 'HomeController@home')->setName('home');

// ADMIN HOME //

Router::get('/admin', 'AdminController@index')->setName('admin');

// ACTUALITIES //
Router::get('/news', 'PostController@index')->setName('news');


