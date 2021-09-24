<?php

namespace App\Service;

use App\Entity\User;

class PHPmailerTemplates{
    private const DOMAIN = "http://localhost/";

    public static function validateUserTemplate(User $user, string $token)
    {
        return [
            "subject" => "Validation de votre compte",
            "body" => 'Bonjour '.$user->getPseudo().',
            <br>
            Afin de valider votre adresse email, merci de cliquer sur le lien suivant :
            <br>
            <a href="'.self::DOMAIN.'validate/'.$token.'/'.$user->getPseudo().'" target="_blank"> Confirmation de votre compte</a>'
        ];
    }
    
    public static function resetUserPasswordTemplate(User $user, string $token)
    {
        return [
            "subject" => "Réinitialisation de votre mot de passe",
            "body" => 'Bonjour '.$user->getPseudo().',
            <br>
            Afin de réinitialiser votre mot de passe, merci de cliquer sur le lien suivant :
            <br>
            <a href="'.self::DOMAIN.'reset-password/'.$token.'" target="_blank"> Réinitialiser votre mot de passe</a>'
        ];
    }

    public static function sendMessageTemplate(string $name, string $email , string $message)
    {
        return [
            "subject" => "Nouveau message de ".$name,
            "body" => 'Bonjour, vous avez un nouveau message de '.$name.'.
            <br>
            <br>
            Message:
            <br>
            '.$message.'
            <br>
            <br>
            <br>
            Pour répondre à ce message -------> '.$email
        ];
    }
}