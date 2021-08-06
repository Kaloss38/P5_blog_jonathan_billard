<?php 

namespace App\Session;

class ArraySession implements SessionInterface
{
    private $session;
    /**
     * Récupère une information en session
     * param string $key
     * param mixed $default
     * return mixed
     */
    public function get(string $key, $default = null)
    {
        if(array_key_exists($key, $_SESSION))
        {
            return $this->session[$key];
        }
        return $default;
    }

    /**
     * Ajoute une information en session
     * param string $key
     * param mixed $default
     * return mixed
     */
    public function set(string $key, $value):void
    {
        $this->session[$key] = $value;
    }

    /**
     * Supprime une clé en session
     * string $key
     */
    public function delete(string $key):void
    {
        unset($_SESSION[$key]);
    }
}