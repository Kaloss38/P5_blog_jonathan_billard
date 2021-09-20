<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\CommentManager;
use Core\Controller;

use App\Manager\UserManager;

use App\Service\PHPmailerTemplates;

use Core\Cookie\PHPCookie;

class UserController extends Controller{
    private const LOGINURL = "/login";
    
    //--- Authentification ---//
    public function login()
    {
        if($this->session()->get('user') != null){
            $this->redirectTo('/');
        }

        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $userManager = new UserManager();
            $user = $userManager->getUserFromEmail($_POST['email']);

            if( password_verify($_POST['password'], $user->getPassword()) && $user->getIsActive() ){
                //Remember me + cookie service
                $token = $this->generateToken();
                $this->session()->set('user', [
                    "id" => $user->getId(),
                    "pseudo" => $user->getPseudo(),
                    "isAdmin" => $user->getIsAdmin(),
                    "token" => $token
                ]);

                if($_POST['rememberMe']){
                    $configFile = file_get_contents(CONF_DIR . '/config.json');
                    $config = json_decode($configFile);

                    $saltStart = $config->security->saltStart;
                    $saltEnd = $config->security->saltEnd;
                    
                    $this->cookie()->set('idUser', $saltStart. password_hash($user->getPseudo(), PASSWORD_BCRYPT). $saltEnd);
                    $this->cookie()->set('token', $saltStart. $user->getToken() . $saltEnd);
                    $this->cookie()->set('isConnected', "1");
                }

                $this->redirectTo('/');
            }
            else{
                $this->flash()->error("Une erreur est survenue, merci de vérifier vos informations");
            }
        }

        return $this->render('auth/login');
    }

    public function subscribe()
    {
        if($this->session()->get('user') != null){
            $this->redirectTo('/');
        }
        
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $newUser = new User($_POST);
            $userManager = new UserManager();
            $userCountMail = count($userManager->getUsersFromEmail($newUser));
            $userCountPseudo = count($userManager->getUserByPseudo($newUser));

            //If user mail not present in database and mail is valid
            if($userCountPseudo != 0){
                $this->flash()->error("Ce pseudo est déjà utilisé");
                $this->redirectTo('/subscribe');    
            }

            if( $userCountMail == 0 && filter_var($newUser->getEmail(), FILTER_VALIDATE_EMAIL)){
                
                if($newUser->getPassword() === $_POST['confirmPassword'])
                {
                    $token = $this->generateToken();
                    $userManager->createUser($newUser, $token);

                    //Send mail for validate user

                    $template = PHPmailerTemplates::validateUserTemplate($newUser, $token);
                    $this->mail()->sendMail($newUser, $template);
                    $this->flash()->success("Inscription prise en compte, vérifiez vos mails afin de valider votre compte");

                    $this->redirectTo(self::LOGINURL);
                }
                else {
                    $this->flash()->error("Vos mots de passe ne correspondent pas");   
                }
            }
            else{
                $this->flash()->error("Une erreur est survenue, merci de vérifier vos informations");
            }
        }

        return $this->render('auth/subscribe');
    }

    public function validate($token)
    {
        $userManager = new UserManager();
        
        $user = $userManager->getUserByToken($token);

        if(!$user->getIsActive()){
            $newToken = $this->generateToken();
            $userManager->validateUser($user, $newToken);
            $this->flash()->success("Votre compte à bien été validé, connectez-vous !");
            $this->redirectTo(self::LOGINURL);
        }
        else{
            $this->flash()->error("Une erreur est survenue, votre compte est déjà validé");
            $this->redirectTo(self::LOGINURL);
        }
    }

    public function forgetPassword()
    {
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $userManager = new UserManager();
            $user = $userManager->getUserFromEmail($_POST['email']);

            if($user){
                $token = $this->generateToken();

                $userManager->updateUserToken($user, $token);

                $template = PHPmailerTemplates::resetUserPasswordTemplate($user, $token);
                $this->mail()->sendMail($user, $template);

                $this->flash()->success("Un e-mail vous à été envoyé afin de réinitiliser votre mot de passe");  
            }
            else{
                $this->flash()->error("Une erreur s'est produite, veuillez vérifier vos informations"); 
            }
                
        }

        return $this->render('auth/forget-password');
    }

    public function resetPassword($token)
    {
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $userManager = new UserManager();
            $user = $userManager->getUserByToken($token);
            if($_POST['password'] === $_POST['confirmPassword'])
            {
                $userManager->updatePassword($_POST['password'], $token);
                $userManager->updateUserToken($user, "");

                $this->flash()->success("Votre mot de passe a été réinitialisé, connectez-vous !");
                $this->redirectTo(self::LOGINURL);
            }
            else{
                $this->flash()->error("Vos mots de passe ne correspondent pas");    
            }

        }

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
        $this->roles()->isAuth();
        $this->checkUser($pseudo);

        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $newPseudo = $_POST['newPseudo'];
            $userManager = new UserManager();
            $checkPseudo = $userManager->searchUserByPseudo($newPseudo);  
            
            if(!$checkPseudo)
            {
                //update Pseudo in db
                $userManager->updatePseudo($pseudo, $newPseudo);
                
                //if cookie set, update pseudo
                if($this->cookie()->get('isConnected') != null)
                {
                    $configFile = file_get_contents(CONF_DIR . '/config.json');
                    $config = json_decode($configFile);
                    
                    $saltStart = $config->security->saltStart;
                    $saltEnd = $config->security->saltEnd;
                    
                    $this->cookie()->set('idUser', $saltStart. password_hash($newPseudo, PASSWORD_BCRYPT). $saltEnd);
                }
                
                //setsession
                $userWithNewPseudo = $userManager->searchUserByPseudo($newPseudo);

                $token = $this->generateToken();

                $this->session()->set('user', [
                    "id" => $userWithNewPseudo->getId(),
                    "pseudo" => $userWithNewPseudo->getPseudo(),
                    "isAdmin" => $userWithNewPseudo->getIsAdmin(),
                    "token" => $token
                ]);

                $this->flash()->success("Votre pseudo à bien été modifié");
            }
            else{
                $this->flash()->error("Ce pseudo est déjà utilisé");
            }

            $this->redirectTo('/user/'. $pseudo);
        }
         
    }

    public function updatePassword($pseudo)
    {
        $this->roles()->isAuth();
        $this->checkUser($pseudo);

        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            $userManager = new UserManager();
            $user = $userManager->searchUserByPseudo($pseudo);
            if(password_verify($_POST['currentPassword'], $user->getPassword()))
            {
                if($_POST['newPassword'] == $_POST['confirmPassword']){
                    $userManager->UserUpdatePassword($_POST['newPassword'], $pseudo);
                    $this->flash()->success("Votre mot de passe à bien été modifié"); 
                }
                else{
                    $this->flash()->error("Vos mot de passe ne corresponde pas");    
                }
            }
            else{
                $this->flash()->error("Mot de passe incorrect");
            }

            $this->redirectTo('/user/'. $pseudo);
        }
    }

    private function checkUser($pseudo)
    {
        $userSession = $this->session()->get('user'); 

        if($userSession['pseudo'] != $pseudo)
        {
            $this->redirectTo('/');
        }

    }


}