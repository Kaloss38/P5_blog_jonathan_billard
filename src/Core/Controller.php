<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Controller
{
    //Twig - Render Method
    public function render(string $path, $datas = []){
        $loader = new FilesystemLoader('../src/Views/');
        
        $twig = new Environment($loader, [
            'cache' => 'false',
        ]);

        echo $twig->render($path.'.html.twig' , $datas);
    }

    //Flash

    //RedirectTo


}
