<?php

class Post{
    private $id;
    private $title;
    private $header;
    private $content;
    private $creationDate;
    private $modificationDate;
    private $thumbnail;

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

    /*
    *
    * TITLE
    *
    */

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        return $this->title = $title;
    }

    /*
    *
    * HEADER
    *
    */

    public function getHeader(){
        return $this->header;
    }

    public function setHeader($header){
        return $this->header = $header;
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
    * MODIFICATION DATE
    *
    */

    public function getModificationDate(){
        return $this->modificationDate;
    }

    public function setModificationDate($modificationDate){
        return $this->modificationDate = $modificationDate;
    }

    /*
    *
    * THUMBNAIL
    *
    */

    public function getThumbnail(){
        return $this->thumbnail;
    }

    public function setThumbnail($thumbnail){
        return $this->thumbnail = $thumbnail;
    }

}