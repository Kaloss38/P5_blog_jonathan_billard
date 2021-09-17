<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Entity\Comment;

class CommentController extends Controller{

    public function addComment($slug){
        //Récupérer utilisateur en session une fois que le système d'authentification sera fait
        $postManager = new PostManager();
        $post = $postManager->getBySlug($slug);

        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $this->csrf();
            $newComment = new Comment($_POST);
            $commentManager = new CommentManager();

            $userId = $this->session()->get('user')['id'];
            $commentManager->createComment($newComment, $post, $userId);

            $this->flash()->success("Commentaire envoyé et en attente de modération");
            
            $this->redirectTo('/news/post/'. $slug .'/');
        }
    }
}