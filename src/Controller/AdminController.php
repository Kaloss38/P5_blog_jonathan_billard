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

            $this->addFlash('success', 'Votre acticle à bien été créé.');
            $this->redirectTo('/admin/articles');
        }
    }

    public function deletePost($id)
    {
       $postManager = new PostManager();
       $postManager->deletePost($id);
       
       $this->addFlash('success', 'Votre acticle à bien été supprimé.');
       $this->redirectTo('/admin/articles');
    }

    public function editPost($id)
    {
        $postManager = new PostManager();
        $post = $postManager->getById($id);
        
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $this->hydrate($post, $_POST);
            $this->updatePost($post);

            $this->addFlash('success', 'Votre acticle à bien été modifié.');
            $this->redirectTo('/admin/articles');
        }

        return $this->render('admin/editPost', [
            'post' => $post
        ]);
    }

    public function updatePost(Post $post)
    {
        $file = $_FILES['thumbnail']['size'];

        if($file == 0)
        {
            $postManager = new PostManager();
            $postManager->updatePost($post, $post->getThumbnail());
            
        }
        else 
        {
            $newfile = $_FILES['thumbnail'];
            $currentTimeFormat = $this->getCurrentTime()->format('Y-m-d_H:i:s');

            $this->savePicture($newfile, $currentTimeFormat);
            $pictureLink = $this->searchPicture($currentTimeFormat);
            
            $postManager = new PostManager();
            $postManager->updatePost($post, $pictureLink);  
        }
    }


}