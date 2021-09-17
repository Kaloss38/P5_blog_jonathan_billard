<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use \Twig\Extension\DebugExtension;
Use Core\Response\Response;
use App\Service\PHPmailerService;
use Core\TwigExtensions\FlashExtension;
use Core\Session\PHPSession;
use Core\Cookie\PHPCookie;
use Core\Security\Roles;
use Core\Session\FlashService;
use Core\TwigExtensions\SessionExtension;
use Ramsey\Uuid\Uuid;

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
        $this->twig->addExtension(new FlashExtension()); 
        $this->twig->addExtension(new SessionExtension()); 
    }

    //Twig - Render Method
    public function render(string $path, $datas = []){
        $this->twig->addGlobal("session", $_SESSION);
        
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
    * Save IMG in local
    *
    */

    public function savePicture($picture, string $name)
    {
        if($picture !== NULL && $picture['error'] == 0 && $picture['size'] <= 3000000)
        {
            $infosfichier = pathinfo($picture['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'JPG', 'png', 'gif');
            if(in_array($extension_upload, $extensions_autorisees))
            {
                $picture['name'] = str_replace([':','-',' '], '_', $name) . '.' . $extension_upload;
                move_uploaded_file($picture['tmp_name'], '../public/img/' . $picture['name']);
                return true;
            }
        }
    }

    public function searchPicture(string $date_publication)
    {
        $extensions = ['.jpg', '.png', '.gif'];
        foreach($extensions as $extension)
        {
            $pathToPicture = '../public/img/' . str_replace([':', '-', ' '], '_', $date_publication) . $extension;
            if(file_exists($pathToPicture))
            {
                $picture = 'public/img/' . str_replace([':', '-', ' '], '_', $date_publication) . $extension;
            }
        }

        if(!isset($picture))
        {
            $picture = 'public/img/' . 'default.jpg';
        }

        return $picture;
    }

    /*
    *
    * Get current time
    *
    */

    public function getCurrentTime(){
        return new \DateTime("now");
    }

    /*
    *
    * use session
    *
    */

    public function session(){
        return new PHPSession();
    }

    /*
    *
    * use cookie
    *
    */

    public function cookie(){
        return new PHPCookie();
    }

    /*
    *
    * use flash
    *
    */

    public function flash(){
        return new FlashService();
    }

    /*
    *
    * generate token for users
    *
    */

    public function generateToken()
	{
		$uuid = Uuid::uuid4();

		return $uuid->toString();
	}

    /*
    *
    * send mails
    *
    */

    public function mail()
    {
        return new PHPmailerService();
    }

    /*
    *
    * ROLES
    *
    */

    public function roles()
    {
        return new Roles();
    }

    public function csrf()
    {
        if($_POST['csrf'] != $this->session()->get('user')['token']){
            $this->redirectTo('/');
        }
    }
}
