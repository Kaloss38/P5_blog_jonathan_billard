<?php

namespace App\Controller;

use Core\Controller;
use App\Service\PHPmailerTemplates;

class HomeController extends Controller{

    public function home()
    {
        return $this->render('public/home', []);
    }

    public function sendMessage()
    {
        if( $this->isSubmit('submit') && $this->isValidated($_POST)){
            
            if(!$_POST['legalMentions'])
            {
                $this->flash()->error("Vous n'avez pas accepté les mentions légales");
                $this->redirectTo('/');
            }

            $template = PHPmailerTemplates::sendMessageTemplate($_POST['name'], $_POST['email'], $_POST['message']);
            $this->mail()->sendMessage($template);

            $this->flash()->success('Votre message à bien été envoyé');

            $this->redirectTo('/');
        }
        else{
            $this->flash()->error('Une erreure est survenue');
            $this->redirectTo('/');
        }
    }

    public function mentionsLegales()
    {
        return $this->render('public/mentions-legales', []);
    }

}