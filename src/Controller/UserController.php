<?php

namespace App\Controller;


use App\Manager\CommentManager;
use Core\Controller;

use App\Service\AuthService;
use App\Service\UserService;
use App\Manager\UserManager;

class UserController extends Controller{
    
    //--- Authentification ---//
    public function login()
    {
        $authService = new AuthService();
        
        $authService->login();

        return $this->render('auth/login');
    }

    public function subscribe()
    {
        $authService = new AuthService();
        
        $authService->subscribe();

        return $this->render('auth/subscribe');
    }

    public function validate($token)
    {
        $authService = new AuthService();
        
        $authService->validate($token);    
    }

    public function forgetPassword()
    {
        $authService = new AuthService();
        
        $authService->forgetPassword(); 
        
        return $this->render('auth/forget-password');
    }

    public function resetPassword($token)
    {
        $authService = new AuthService();
        
        $authService->resetPassword($token);
        
        return $this->render('auth/reset-password', [
            "token" => $token
        ]);
    }

    public function logout()
    {
        $this->session()->delete('user');
        $this->cookie()->set('isConnected', "0");
        $this->redirectTo('/');
    }

    //--- User Profil ---//
    public function viewProfil($pseudo)
    {
        $this->roles()->isAuth();
        $this->checkUser($pseudo);

        $userManager = new UserManager();
        $user = $userManager->searchUserByPseudo($pseudo);
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsValidatedFromUser($user);
        
        return $this->render('user/account', [
            "pseudo" => $pseudo,
            "comments" => $comments
        ]);
    }

    public function updatePseudo($pseudo)
    {
        $userService = new UserService();
        $userService->updatePseudo($pseudo);    
    }

    public function updatePassword($pseudo)
    {
        $userService = new UserService();
        $userService->updatePassword($pseudo);     
    }

    private function checkUser($pseudo)
    {
        $userSession = $this->session()->get('user'); 

        if($userSession['pseudo'] != $pseudo)
        {
            $this->redirectTo('/user/'.$userSession['pseudo']);
        }

    }

}