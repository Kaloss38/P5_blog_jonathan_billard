<?php

namespace Core\Session;

use Core\Session\PHPSession;

class FlashService {

    private $session;

    private $sessionKey = 'flash';

    private $messages;

    public function __construct()
    {
        $this->session = new PHPSession();
    }

    public function success(string $message)
    {
        $flash = $this->session->get($this->sessionKey, []);
        $flash['success'] = $message;
        $this->session->set($this->sessionKey, $flash);
    }

    public function get(string $type): ?string
    {
        if(is_null($this->messages)){
            $this->messages = $this->session->get($this->sessionKey, []);
            $this->session->delete($this->sessionKey);
        }

        if(array_key_exists($type, $this->messages)){
            return $this->messages[$type];
        }
        
        return null; 
    }
}