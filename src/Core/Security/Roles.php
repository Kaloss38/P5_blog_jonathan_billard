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
        if($this->session()->get('user') === NULL)
        {
            $this->redirectTo(self::LOGINURL);
        }
        elseif(!$this->session()->get('user')['isAdmin'])
        {
            $this->redirectTo(self::LOGINURL);
        }
    }
}