<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use \Twig\Extension\DebugExtension;
Use Core\Response\Response;

class Controller
{
    protected const V_DIR = ROOT_DIR."/src/Views/";
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(self::V_DIR);
        
        $this->twig = new Environment($loader, [
            'debug' => true
        ]);

        $this->twig->addExtension(new DebugExtension());    
    }

    //Twig - Render Method
    public function render(string $path, $datas = []){
        
        $view = $this->twig->load($path.'.html.twig');
        $content = $view->render($datas);

        $response = new Response($content);

        return $response->send();
    }

    //addFlash

    //RedirectTo
    public function redirectTo(string $path){
        header("Location:" . $path);
        exit();
    }

    //Check if form is submit
    //submit is the name of submit button
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

    /*
    *
    * Save IMG in local
    *
    */

    
}
