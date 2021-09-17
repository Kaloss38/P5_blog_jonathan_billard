<?php

namespace Core\Security;

use Core\Controller;
use Core\Cookie\PHPCookie;
use App\Manager\UserManager;

class CookieAuth extends Controller{

    private $configFile;
    private $config;

    public function __construct()
    {
        $this->configFile = file_get_contents(CONF_DIR . '/config.json');
        $this->config = json_decode($this->configFile);
    }

    //Auto-log user if remember has been checked
    public function AuthWithCookie()
    {
        $saltStart = $this->config->security->saltStart;
        $saltEnd = $this->config->security->saltEnd;

        $tokenCookie = preg_split('/^'.$saltStart.'|'.$saltEnd.'$/', $this->cookie()->get('token'));
        
        if($tokenCookie && ($this->session()->get('user') === NULL) && ($this->cookie()->get('isConnected') == "1"))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserByToken($tokenCookie[1]);
            $cookieIdUser = preg_split('/^'.$saltStart.'|'.$saltEnd.'$/', $this->cookie()->get('idUser'));

            $checkIdUser = password_verify($user->getPseudo(), $cookieIdUser[1]);
            
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
