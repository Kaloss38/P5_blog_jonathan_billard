<?php

class User{
    private $id;
    private $pseudo;
    private $firstname;
    private $lastname;
    private $email;
    private $isActive;
    private $isAdmin;
    private $password;
    private $token;

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
    * PSEUDO
    *
    */

    public function getPseudo(){
        return $this->pseudo;
    }

    public function setPseudo($pseudo){
        return $this->pseudo = $pseudo;
    }

    /*
    *
    * FIRSTNAME
    *
    */

    public function getFirstname(){
        return $this->firstname;
    }

    public function setFirstname($firstname){
        return $this->firstname = $firstname;
    }

    /*
    *
    * LASTNAME
    *
    */

    public function getLastname(){
        return $this->lastname;
    }

    public function setLastname($lastname){
        return $this->lastname = $lastname;
    }

    /*
    *
    * EMAIL
    *
    */

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        return $this->email = $email;
    }

    /*
    *
    * IS ACTIVE
    *
    */

    public function getIsActive(){
        return $this->isActive;
    }

    public function setIsActive($isActive){
        return $this->isActive = $isActive;
    }

    /*
    *
    * IS ADMIN
    *
    */

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin){
        return $this->isAdmin = $isAdmin;
    }

    /*
    *
    * PASSWORD
    *
    */

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        return $this->password = $password;
    }

    /*
    *
    * TOKEN
    *
    */

    public function getToken(){
        return $this->token;
    }

    public function setToken($token){
        return $this->token = $token;
    }


}