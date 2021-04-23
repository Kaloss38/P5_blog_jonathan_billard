<?php


use Core\Router;

// Router::group(['namespace' => '\App\Controllers', 'exceptionHandler' => \App\Handlers\CustomExceptionHandler::class], function () {

// 	Router::get('/', 'PublicController@home')->setName('home');

// });

//  
Router::setDefaultNamespace('App\Controller');

Router::get('/', 'HomeController@home')->setName('home');

// Router::get('/', function() {
//     return "Ici, la page d'accueil";
// });

Router::get('/test', function() {
    return 'Redirection pour tester';
});
