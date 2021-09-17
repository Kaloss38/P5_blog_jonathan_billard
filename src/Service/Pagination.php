<?php

namespace App\Service;

use App\Manager\PostManager;

class Pagination{

    public function paginatePosts($currentPage, $limitPerPage)
    {
        $postManager = new PostManager();
        $totalRow = count($postManager->getAll());
        $totalPages = ceil($totalRow/$limitPerPage);

        if(isset($currentPage) && !empty($currentPage) && $currentPage > 0)
        {
            $currentPage = intval($currentPage);
        }
        else{
            $currentPage = 1;
        }
        
        $start = ($currentPage-1)*$limitPerPage;
        $posts = $postManager->getAll('LIMIT '.$start.','.$limitPerPage);

        return [ 'posts' => $posts, 'totalPages' => $totalPages, 'currentPage' => $currentPage];
    }

}