<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;
use App\Manager\CommentManager;

class PostController extends Controller{


    public function index()
    {
        $postManager = new PostManager();
        $posts = $postManager->getAll();
        
        return $this->render('public/actualities', [
            'posts' => $posts
        ]);
    }

    public function showPost($id)
    {
        $postManager = new PostManager();
        $post = $postManager->getById($id);

        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsValidatedFromPost($post);

        return $this->render('public/post', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}