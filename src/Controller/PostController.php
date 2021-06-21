<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;

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

        return $this->render('public/post', [
            'post' => $post
        ]);
    }
}