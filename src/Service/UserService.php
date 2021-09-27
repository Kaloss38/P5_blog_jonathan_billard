<?php

namespace App\Service;

use Core\Controller;

use App\Entity\User;

use App\Manager\UserManager;

use App\Service\PHPmailerTemplates;

class UserService extends Controller{

    private const USERURL = '/user/';

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

            $this->redirectTo(self::USERURL. $pseudo);
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

            $this->redirectTo(self::USERURL. $pseudo);
        }
    }

    private function checkUser($pseudo)
    {
        $userSession = $this->session()->get('user'); 

        if($userSession['pseudo'] != $pseudo)
        {
            $this->redirectTo(self::USERURL.$userSession['pseudo']);
        }

    }
}