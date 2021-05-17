<?php

namespace App\Controller;

use Core\Controller;
use App\Manager\PostManager;

class PostController extends Controller{

    public function __construct(PostManager $PostManager){
        $this->postManager = $PostManager;
    }

    public function index()
    {
        
       
        return $this->render('public/actualities', [
            
        ]);
    }
}