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

        $posts = $paginate->paginatePosts($currentPage, 3);
        
        return $this->render('public/actualities', [
            'posts' => $posts['posts'],
            'totalPages' => $posts['totalPages'],
            'currentPage' => $posts['currentPage']
        ]);
    }

    public function showPost($slug)
    {
        $postManager = new PostManager();
        $post = $postManager->getBySlug($slug);
        
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsValidatedFromPost($post);

        return $this->render('public/post', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}