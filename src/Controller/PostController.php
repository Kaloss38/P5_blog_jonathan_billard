<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;

class PostController extends Controller{

    public function __construct(PostManager $postManager){
        $this->postManager = $postManager;
    }

    public function index()
    {
        $posts = $this->postManager->getAll();
       
        return $this->render('public/actualities', [
            'posts' => $posts
        ]);
    }
}