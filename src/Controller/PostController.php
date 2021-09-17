<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Service\Pagination;

class PostController extends Controller{


    public function index($currentPage)
    {
        $paginate = new Pagination();

        $posts = $paginate->paginatePosts($currentPage, 5);
        
        return $this->render('public/actualities', [
            'posts' => $posts['posts'],
            'totalPages' => $posts['totalPages'],
            'currentPage' => $posts['currentPage']
        ]);
    }

    public function showPost($id)
    {
        $postManager = new PostManager();
        $post = $postManager->getById($id);

        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsValidatedFromPost($post);

        return $this->render('public/post', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}