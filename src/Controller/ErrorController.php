<?php

namespace App\Controller;
use Core\Controller;

class ErrorController extends Controller{

    public function notFound()
    {
        return $this->render('/error/notFound');
    }

}