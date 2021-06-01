<?php


use Core\Router;
 
Router::setDefaultNamespace('App\Controller');

//------ HOME -----//

Router::get('/', 'HomeController@home')->setName('home');

//------ ADMIN ------//

//home - all posts
Router::get('/admin/articles', 'AdminController@index')->setName('adminAllPosts');
//add post view
Router::get('/admin/articles-add', 'AdminController@addPost')->setName('adminAddPost');
//save post view
Router::post('/admin/articles-save', 'AdminController@savePost');
//update post
Router::get('/admin/articles/update/{id}', 'AdminController@updatePost');
//delete post
Router::get('/admin/articles/delete/{id}', 'AdminController@deletePost');

//all comments page
Router::get('/admin/commentaires/validate', 'AdminController@allComments');
//desaprove comment
Router::get('/admin/commentaires/unvalidate/{id}', 'AdminController@desaproveComment');

//comments waiting list page
Router::get('/admin/commentaires/waiting', 'AdminController@allCommentsWaiting');
//validate comment waiting
Router::get('/admin/commentaires/waiting/validate/{id}', 'AdminController@validateCommentWaiting');
//delete comment waiting list
Router::get('/admin/commentaires/waiting/delete/{id}', 'AdminController@deleteCommentsWaiting');

//------ ACTUALITIES ------//
Router::get('/news', 'PostController@index')->setName('news');


