<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Controller
{
    protected const V_DIR = ROOT_DIR."/src/Views/";

    //Twig - Render Method
    public function render(string $path, $datas = []){
        $loader = new FilesystemLoader(self::V_DIR);
        
        $twig = new Environment($loader, [
            'debug' => true
        ]);

        echo $twig->render($path.'.html.twig' , $datas);
    }

    //Flash

    //RedirectTo


}
