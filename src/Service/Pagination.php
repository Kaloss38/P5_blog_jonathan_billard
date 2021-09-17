<?php

namespace App\Service;

use App\Manager\PostManager;

class Pagination{

    /*
    *
    * Return an array of all posts and total and current pages
    * @currentPage current page number of actualities
    * @limitPerPage Limit of item in currentpage
    */

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