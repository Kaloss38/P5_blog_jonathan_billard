<?php

namespace App\Service;

use App\Entity\User;
use PHPMailer\PHPMailer\PHPMailer;

class PHPmailerService {

    private function setConfig()
    {
        $configFile = file_get_contents(CONF_DIR . '/config.json');
        $config = json_decode($configFile);

        return $config->phpmailer;
    }

    public function sendMail(User $user, array $template){
        $infosConfig = $this->setConfig();

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = $infosConfig->host;
        $mail->SMTPAuth = true;
        $mail->Username = $infosConfig->username;
        $mail->Password = $infosConfig->password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $infosConfig->port;

        $mail->setFrom($infosConfig->fromMail, $infosConfig->fromName);
        $mail->addAddress($user->getEmail());

        $mail->isHTML(true);

        $mail->Subject = $template['subject'];
        $mail->Body = $template['body'];

        $mail->send();
    }
}