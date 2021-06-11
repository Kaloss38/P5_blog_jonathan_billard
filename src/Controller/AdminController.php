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

        $currentTimeFormat = $this->getCurrentTime()->format('Y-m-d_H:i:s');

        $this->savePicture($file, $currentTimeFormat);
        $pictureLink = $this->searchPicture($currentTimeFormat);       

        //new instance POST
        $newPost = new Post();
        //Hydrate POST instance
        $this->hydrate($newPost, $_POST);

        //check form for issubmit
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $postManager = new PostManager();
            $postManager->createPost($newPost, $pictureLink);

            $this->redirectTo('articles');
        }
    }

    public function deletePost($id)
    {
       $postManager = new PostManager();
       $postManager->deletePost($id);
       
       $this->redirectTo('articles');
    }


}