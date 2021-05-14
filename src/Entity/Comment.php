<?php

class Comment{
    private $id;
    private $postId;
    private $userId;
    private $content;
    private $creationDate;
    private $validated;

    public function __construct(){

    }

    /*
    *
    * ID
    *
    */

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }

    /*
    *
    * POST ID
    *
    */

    public function getPostId(){
        return $this->postId;
    }

    public function setPostId($postId){
        return $this->postId = $postId;
    }

    /*
    *
    * USER ID
    *
    */

    public function getUserId(){
        return $this->userId;
    }

    public function setUserId($userId){
        return $this->userId = $userId;
    }

    /*
    *
    * CONTENT
    *
    */

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        return $this->content = $content;
    }

    /*
    *
    * CREATION DATE
    *
    */

    public function getCreationDate(){
        return $this->creationDate;
    }

    public function setCreationDate($creationDate){
        return $this->creationDate = $creationDate;
    }
    
    /*
    *
    * VALIDATED
    *
    */

    public function getValidated(){
        return $this->validated;
    }

    public function setValidated($validated){
        return $this->validated = $validated;
    }

}