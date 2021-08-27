<?php

namespace Core\Service;

use App\Entity\User;

class PHPmailerTemplates{
    public static function validateUserTemplate(User $user, string $token)
    {
        $mailContent = [
            "subject" => "Validation de votre compte",
            "body" => 'Bonjour '.$user->getPseudo().',
            <br>
            Afin de valider votre adresse email, merci de cliquer sur le lien suivant :
            <br>
            <a href="http://localhost/validate/'.$token.'/'.$user->getPseudo().'" target="_blank"> Confirmation de votre compte</a>'
        ];

        return $mailContent;
    }
    
    public static function resetUserPasswordTemplate(User $user, string $token)
    {
        $mailContent = [
            "subject" => "Réinitialisation de votre mot de passe",
            "body" => 'Bonjour '.$user->getPseudo().',
            <br>
            Afin de réinitialiser votre mot de passe, merci de cliquer sur le lien suivant :
            <br>
            <a href="http://localhost/reset-password/'.$token.'" target="_blank"> Réinitialiser votre de mot de passe</a>'
        ];

        return $mailContent;
    }
}