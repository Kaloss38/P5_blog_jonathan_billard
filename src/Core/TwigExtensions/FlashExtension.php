<?php

namespace Core\TwigExtensions;

use App\Session\FlashService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FlashExtension extends AbstractExtension{

    private $flashService;
    
    public function __construct()
    {
        $this->flashService = new FlashService(); 
    }

    public function getFunctions():array
    {
        return [
            new TwigFunction('flash', [$this, 'getFlash'])
        ];
    }

    public function getFlash($type):?string {
        return $this->flashService->get($type);
    }
}