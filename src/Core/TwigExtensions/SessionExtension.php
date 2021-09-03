<?php

namespace Core\TwigExtensions;

use Core\Session\PHPSession;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SessionExtension extends AbstractExtension{

    private $sessionService;
    
    public function __construct()
    {
        $this->sessionService = new PHPSession(); 
    }

    public function getFunctions():array
    {
        return [
            new TwigFunction('session', [$this, 'getSession'])
        ];
    }

    public function getSession($key):?array {
        return $this->sessionService->get($key);
    }
}