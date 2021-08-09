<?php

namespace Core\Session;

interface SessionInterface {
    /**
     * Récupère une information en session
     * param string $key
     * param mixed $default
     * return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Ajoute une information en session
     * param string $key
     * param mixed $default
     * return mixed
     */
    public function set(string $key, $default):void;

    /**
     * Supprime une clé en session
     * string $key
     */
    public function delete(string $key):void;
}