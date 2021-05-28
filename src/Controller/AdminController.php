<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;

class AdminController extends Controller{

    public function index()
    {
        $postManager = new PostManager();
        $posts = $postManager->getAll();

        return $this->render('admin/homeAdmin', [
            'posts' => $posts
        ]);
    }

    public function addPost(){

        return $this->render('/admin/addPost', []);
    }

    public function savePost(){
        //set image to save in local
        $file = $_FILES['image'];
        $repertoire = "public/img/";
        // $imgToAdd = $this->addImage($file, $repertoire);

        $post = [
          'title' => $_POST['title'],
          'header' => $_POST['header'],
          'content' => $_POST['content'],
          'creationDate' => '',
          'modificationDate' => '',
        //   'thumbnail' => $imgToAdd
        ];

        //new instance POST
        //Hydrate POST instance

        if( $this->isSubmit("") && $this->isValidated($post)){
            $postManager = new PostManager();

            // $postManager->createPost();
            $this->redirectTo('articles');
        }

        
    }


}