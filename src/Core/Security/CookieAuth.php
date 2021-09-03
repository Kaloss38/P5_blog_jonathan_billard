<?php

namespace Core\Security;

use Core\Controller;
use Core\Cookie\PHPCookie;
use App\Manager\UserManager;

class CookieAuth extends Controller{

    //Auto-log user if remember has been checked
    public function AuthWithCookie()
    {
        

        $tokenCookie = $this->cookie()->get('token');
        if($tokenCookie && ($this->session()->get('user') === NULL) && ($this->cookie()->get('isConnected') == "1"))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserByToken($tokenCookie);
            $cookieIdUser = $this->cookie()->get('idUser');

            $checkIdUser = password_verify($user->getPseudo(), $cookieIdUser);
            
            if($user && $checkIdUser)
            {
                $token = $this->generateToken();
                $this->session()->set('user', [
                    "id" => $user->getId(),
                    "pseudo" => $user->getPseudo(),
                    "isAdmin" => $user->getIsAdmin(),
                    "token" => $token
                ]);
            }
            else{
                $this->redirectTo('/');
            }
        }
    }
}
