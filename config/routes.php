<?php


use Core\Router;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
 
Router::setDefaultNamespace('App\Controller');

//------ HOME -----//

Router::get('/', 'HomeController@home')->setName('home');

//------ ADMIN ------//

//home - all posts
Router::get('/admin/articles/{currentPage}', 'AdminController@index')->setName('adminAllPosts');
//add post view
Router::get('/admin/add-article', 'AdminController@addPost')->setName('adminAddPost');
//save post view
Router::post('/admin/articles-save', 'AdminController@savePost')->setName('adminSavePost');
//update post
Router::all('/admin/articles/edit/{slug}', 'AdminController@editPost');
//delete post
Router::all('/admin/articles/delete/{slug}', 'AdminController@deletePost');

//all comments page
Router::get('/admin/commentaires/validate', 'AdminController@allComments');
//desaprove comment
Router::get('/admin/commentaires/unvalidate/{id}', 'AdminController@desaproveComment');

//comments waiting list page
Router::get('/admin/commentaires/waiting', 'AdminController@allCommentsWaiting');
//validate comment 
Router::get('/admin/commentaires/validate/{id}', 'AdminController@validateComment');
//desapprove comment
Router::get('/admin/commentaires/desapprove/{id}', 'AdminController@disapproveComment');
//delete comment
// /admin/commentaires/delete/
Router::get('/admin/commentaires/delete/{id}', 'AdminController@deleteComment');

//comments validate list page
Router::get('/admin/commentaires/validated', 'AdminController@allCommentsValidated');
//comments desapprove list page
Router::get('/admin/commentaires/disapproved', 'AdminController@allCommentsDisapproved');

//------ ACTUALITIES ------//
Router::get('/news/{currentPage}', 'PostController@index')->setName('news');

//------ POST ------//
Router::get('/news/post/{slug}', 'PostController@showPost')->setName('post');

//------ User add comment ------//
Router::all('/news/post/{slug}/ajout-commentaire', 'CommentController@addComment');

//------ AUTH ------//

//login
Router::all('/login', 'UserController@login');
//subscribe
Router::all('/subscribe', 'UserController@subscribe');
//Validate user
Router::get('/validate/{token}/{pseudo}', 'UserController@validate');
//Password Forget
Router::all('/forget-password', 'UserController@forgetPassword');
//Password reset
Router::all('/reset-password/{token}', 'UserController@resetPassword');
//Logout
Router::all('/logout', 'UserController@logout');

//------ USER ------//
Router::get('/user/{pseudo}', 'UserController@viewProfil');
Router::all('/user/{pseudo}/updatePseudo', 'UserController@updatePseudo');
Router::all('/user/{pseudo}/updatePassword', 'UserController@updatePassword');

//------ ERRORS ------//
Router::get('/not-found', 'ErrorController@notFound');
Router::get('/forbidden', 'ErrorController@notFound');

Router::error(function(Request $request,\Exception $exception) {

    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect('/not-found');
        // Forbidden
        case 403:
            response()->redirect('/forbidden');
    }
    
});

