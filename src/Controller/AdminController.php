<?php

namespace App\Controller;

use Core\Controller;

class AdminController extends Controller{

    public function __construct(){

    }

    public function index()
    {
        return $this->render('admin/homeAdmin', []);
    }
}