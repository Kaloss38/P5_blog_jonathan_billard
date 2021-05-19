<?php

namespace App\Controller;

use Core\Controller;

class AdminController extends Controller{

    public function index()
    {
        $this->render('admin/homeAdmin', []);
    }
}