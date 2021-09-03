<?php 

namespace Core\Cookie;

class PHPCookie {
    
    private $path = "/";
    private $domain = "localhost";

    /**
     * Récupère une information en cookie
     * param string $key
     * param mixed $default
     * return mixed
     */
    public function get(string $key, $default = null)
    {
        if(array_key_exists($key, $_COOKIE))
        {
            return $_COOKIE[$key];
        }
        return $default;
    }

    /**
     * Ajoute une information en cookie
     * param string $key
     * param mixed $default
     * return mixed
     */
    public function set(string $key, $value):void
    {
        setcookie(
            $key,
            $value,
            time() + 60 * 60 * 24 * 30,
            $this->path,
            $this->domain,
            true,
            true
        );
    }

    /**
     * Supprime une clé en cookie
     * string $key
     */
    public function delete(string $key):void
    {
        unset($_COOKIE[$key]);
    }
}