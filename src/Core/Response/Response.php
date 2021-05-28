<?php

namespace Core\Response;

use Core\Response\ResponseInterface;

class Response implements ResponseInterface {

    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }
    
    public function send(){
        echo $this->content;
    }

    public function __toString(){
        return $this->content;
    }
}