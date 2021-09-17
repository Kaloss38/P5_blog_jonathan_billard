<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;
use App\Entity\Post;
use App\Manager\CommentManager;
use App\Service\Pagination;

class AdminController extends Controller{

    private const HOMEADMINURL = '/admin/articles/1';

    public function index($currentPage)
    {
        $paginate = new Pagination();
        $posts = $paginate->paginatePosts($currentPage, 5);

        return $this->render('admin/homeAdmin', [
            'posts' => $posts['posts'],
            'totalPages' => $posts['totalPages'],
            'currentPage' => $posts['currentPage']
        ]);
    }

    public function addPost()
    {
        $this->roles()->isAdmin();

        return $this->render('/admin/addPost');
    }

    public function savePost(){
        $this->roles()->isAdmin();

        //set image to save in local
        $file = $_FILES['thumbnail'];

        $currentTimeFormat = $this->getCurrentTime()->format('Y-m-d_H:i:s');

        $this->savePicture($file, $currentTimeFormat);
        $pictureLink = $this->searchPicture($currentTimeFormat);       

        //new instance POST
        $newPost = new Post($_POST);

        //check form for issubmit
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $this->csrf();
            $postManager = new PostManager();
            $userId = $this->session()->get('user')['id'];
            $slug = $this->slugify($newPost->getTitle());
            $postManager->createPost($newPost, $pictureLink, $userId, $slug);

            $this->flash()->success("L'article a bien été créé");

            $this->redirectTo(self::HOMEADMINURL);
        }
    }

    public function deletePost($slug)
    {
       $this->roles()->isAdmin();
       if( $this->isSubmit('submit') && $this->isValidated($_POST)){
           $this->csrf();
           $postManager = new PostManager();
           $postManager->deletePost($slug); 
           $this->flash()->success("L'article a bien été supprimé");
       }
       
       $this->redirectTo(self::HOMEADMINURL);
    }

    public function editPost($slug)
    {
        $this->roles()->isAdmin();

        $postManager = new PostManager();
        $post = $postManager->getBySlug($slug);
        
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $this->csrf();
            $post->setTitle($_POST['title']);
            $slugTitle = $this->slugify($post->getTitle());
            $post->setSlug($slugTitle);
            $post->setHeader($_POST['header']);
            $post->setContent($_POST['content']);
            
            $this->updatePost($post);

            $this->flash()->success("L'article a bien été modifié");

            $this->redirectTo(self::HOMEADMINURL);
        }

        return $this->render('admin/editPost', [
            'post' => $post
        ]);
    }

    public function updatePost(Post $post)
    {
        $this->roles()->isAdmin();

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
        $this->roles()->isAdmin();

        $commentManager = new CommentManager();
        $commentsWaiting = $commentManager->getAllWaitingComments();
        
        return $this->render('admin/commentsWaiting', [
            'commentsWaiting' => $commentsWaiting
        ]);
    }

    public function validateComment($id)
    {
        $this->roles()->isAdmin();

        $commentManager = new CommentManager();
        $commentToValidate = $commentManager->getById($id);
        $commentManager->validateComment($commentToValidate);

        $this->flash()->success("Le commentaire à bien été validé");

        $this->redirectTo('/admin/commentaires/validated');
    }

    public function disapproveComment($id)
    {
        $this->roles()->isAdmin();

        $commentManager = new CommentManager();
        $commentToDisapprove = $commentManager->getById($id);
        $commentManager->disapproveComment($commentToDisapprove);

        $this->flash()->success("Le commentaire à bien été désapprouvé");

        $this->redirectTo('/admin/commentaires/disapproved');
    }

    public function deleteComment($id)
    {
        $this->roles()->isAdmin();

        $commentManager = new CommentManager();
        $commentToDelete = $commentManager->getById($id);
        $commentManager->deleteComment($commentToDelete);

        $this->flash()->success("Le commentaire à bien été supprimé");

        $this->redirectTo('/admin/commentaires/waiting'); 
    }

    public function allCommentsDisapproved()
    {
        $this->roles()->isAdmin();

        $commentManager = new CommentManager();
        $commentsDisapproved = $commentManager->getAllDisapprovedComments();
        
        return $this->render('admin/commentsDisapproved', [
            'commentsDisapproved' => $commentsDisapproved
        ]);
    }

    public function allCommentsValidated()
    {
        $this->roles()->isAdmin();
        
        $commentManager = new CommentManager();
        $commentsValidated = $commentManager->getAllValidatedComments();
        
        return $this->render('admin/commentsValidated', [
            'commentsValidated' => $commentsValidated
        ]); 
    }

}