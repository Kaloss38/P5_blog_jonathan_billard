<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use \Twig\Extension\DebugExtension;

class Controller
{
    protected const V_DIR = ROOT_DIR."/src/Views/";

    //Twig - Render Method
    public function render(string $path, $datas = []){
        $loader = new FilesystemLoader(self::V_DIR);
        
        $twig = new Environment($loader, [
            'debug' => true
        ]);

        $twig->addExtension(new DebugExtension());

        echo $twig->render($path.'.html.twig' , $datas);
    }

    //addFlash

    //RedirectTo
    public function redirectTo(string $path){
        header("Location:" . $path);
        exit();
    }

    //Check if form is submit
    public function isSubmit(string $submit){
        if(isset($_POST[$submit])){
            return true;
        }

        return false;
    }
    //Check if form fields are valide
    public function isValidated(array $fields){
        $isValide = true;
        foreach($fields as $value){
            if($value == null || !isset($value) || $value == ""){
                $isValide = false;
            }
        }

        return $isValide;
    }

    /*
    *
    * Hydrate function for entities
    *
    */

    public function hydrate(array $data){
        foreach($data as $attribut => $value){
            $method = 'set'.ucfirst($attribut);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
}
