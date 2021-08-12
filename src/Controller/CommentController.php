<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Entity\Comment;

class CommentController extends Controller{

    public function addComment($id){
        //Récupérer utilisateur en session une fois que le système d'authentification sera fait
        $postManager = new PostManager();
        $post = $postManager->getById($id);

        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $newComment = new Comment($_POST);
            $commentManager = new CommentManager();
            $commentManager->createComment($newComment, $post);

            $this->flash()->success("Commentaire envoyé et en attente de modération");
            
            $this->redirectTo('/news/post/'. $id .'/');
        }
    }
}