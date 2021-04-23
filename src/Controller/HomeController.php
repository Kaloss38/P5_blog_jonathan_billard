<?php

namespace App\Controller;

class HomeController{

    public function __construct(){

    }

    public function home()
    {
        return "La page index appelée depuis une methode d'un controller";
    }
}