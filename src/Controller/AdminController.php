<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;

class AdminController extends Controller{

    public function index()
    {
        $postManager = new PostManager();
        $posts = $postManager->getAll();

        $this->render('admin/homeAdmin', [
            'posts' => $posts
        ]);
    }
}