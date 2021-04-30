<?php

namespace App\Controller;

use App\Controller\UserController;

class AdminController extends UserController{

    public function __construct(){

    }

    public function index()
    {
        return $this->render('admin/homeAdmin', []);
    }
}