<?php

namespace Core\Security;

use Core\Controller;

class Roles extends Controller {

    private const LOGINURL = "/login";

    public function isAuth()
    {
        if($this->session()->get('user') === NULL)
        {
            $this->redirectTo(self::LOGINURL);
        }
    }

    public function isAdmin()
    {
        if(isset($this->session()->get('user')['isAdmin']) && $this->session()->get('user')['isAdmin'] === true){
            return true ;
        }
        else{
            $this->redirectTo(self::LOGINURL);

        }
    }
}