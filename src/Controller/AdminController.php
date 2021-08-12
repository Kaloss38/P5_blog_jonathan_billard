<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;
use App\Entity\Post;
use App\Manager\CommentManager;

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
        $newPost = new Post($_POST);

        //check form for issubmit
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $postManager = new PostManager();
            $postManager->createPost($newPost, $pictureLink);

            $this->flash()->success("L'article a bien été créé");

            $this->redirectTo('/admin/articles');
        }
    }

    public function deletePost($id)
    {
       $postManager = new PostManager();
       $postManager->deletePost($id);

       $this->flash()->success("L'article a bien été supprimé");
       
       $this->redirectTo('/admin/articles');
    }

    public function editPost($id)
    {
        $postManager = new PostManager();
        $post = $postManager->getById($id);

        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $post->setTitle($_POST['title']);
            $post->setHeader($_POST['header']);
            $post->setContent($_POST['content']);
            
            $this->updatePost($post);

            $this->flash()->success("L'article a bien été modifié");

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

    public function allCommentsWaiting()
    {
        $commentManager = new CommentManager();
        $commentsWaiting = $commentManager->getAllWaitingComments();
        
        return $this->render('admin/commentsWaiting', [
            'commentsWaiting' => $commentsWaiting
        ]);
    }

    public function validateComment($id)
    {
        $commentManager = new CommentManager();
        $commentToValidate = $commentManager->getById($id);
        $commentManager->validateComment($commentToValidate);

        $this->flash()->success("Le commentaire à bien été validé");

        $this->redirectTo('/admin/commentaires/validated');
    }

    public function disapproveComment($id)
    {
        $commentManager = new CommentManager();
        $commentToDisapprove = $commentManager->getById($id);
        $commentManager->disapproveComment($commentToDisapprove);

        $this->flash()->success("Le commentaire à bien été désapprouvé");

        $this->redirectTo('/admin/commentaires/disapproved');
    }

    public function deleteComment($id)
    {
        $commentManager = new CommentManager();
        $commentToDelete = $commentManager->getById($id);
        $commentManager->deleteComment($commentToDelete);

        $this->flash()->success("Le commentaire à bien été supprimé");

        $this->redirectTo('/admin/commentaires/waiting'); 
    }

    public function allCommentsDisapproved()
    {
        $commentManager = new CommentManager();
        $commentsDisapproved = $commentManager->getAllDisapprovedComments();
        
        return $this->render('admin/commentsDisapproved', [
            'commentsDisapproved' => $commentsDisapproved
        ]);
    }

    public function allCommentsValidated()
    {
        $commentManager = new CommentManager();
        $commentsValidated = $commentManager->getAllValidatedComments();
        
        return $this->render('admin/commentsValidated', [
            'commentsValidated' => $commentsValidated
        ]); 
    }

}