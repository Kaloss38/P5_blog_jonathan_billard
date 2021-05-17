<?php


use Core\Router;
 
Router::setDefaultNamespace('App\Controller');

//------ HOME -----//

Router::get('/', 'HomeController@home')->setName('home');

//------ ADMIN ------//

//home - all posts
Router::get('/admin/articles', 'AdminController@index')->setName('adminAllPosts');
//add post
Router::get('/admin/articles/add', 'AdminController@addPost')->setName('adminAddPost');
//update post
Router::get('/admin/articles/update/{id}', 'AdminController@addPost')->setName('adminAddPost');
//delete post
Router::get('/admin/articles/delete/{id}', 'AdminController@addPost')->setName('adminAddPost');

//all comments page
Router::get('/admin/commentaires/validate', 'AdminController@allComments')->setName('adminAddPost');
//desaprove comment
Router::get('/admin/commentaires/unvalidate/{id}', 'AdminController@desaproveComment')->setName('adminAddPost');

//comments waiting list page
Router::get('/admin/commentaires/waiting', 'AdminController@allCommentsWaiting')->setName('adminAddPost');
//validate comment waiting
Router::get('/admin/commentaires/waiting/validate/{id}', 'AdminController@validateCommentWaiting')->setName('adminAddPost');
//delete comment waiting list
Router::get('/admin/commentaires/waiting/delete/{id}', 'AdminController@deleteCommentsWaiting')->setName('adminAddPost');

//------ ACTUALITIES ------//
Router::get('/news', 'PostController@index')->setName('news');


