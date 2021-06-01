<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;
use App\Entity\Post;

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
        $file = $_FILES['thumbnail'];
        $repertoire = "../public/img/";
        $imgToAdd = $this->addImage($file, $repertoire);

        $currentTime = $this->getCurrentTime();

        $post = [
          'title' => $_POST['title'],
          'header' => $_POST['header'],
          'content' => $_POST['content'],
          'creationDate' => $currentTime,
          'modificationDate' => $currentTime,
          'thumbnail' => $imgToAdd
        ];

        //new instance POST
        $newPost = new Post();
        //Hydrate POST instance
        $this->hydrate($newPost, $post);

        //check form for issubmit
        if( $this->isSubmit('submit') && $this->isValidated($post)){
            $postManager = new PostManager();
            $postManager->createPost($newPost);

            $this->redirectTo('articles');
        }


    }


}