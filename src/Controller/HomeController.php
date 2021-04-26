<?php

namespace App\Controller;

use Core\Controller;

class HomeController extends Controller{

    public function __construct(){

    }

    public function home()
    {
        return $this->render('public/home', []);
    }
}