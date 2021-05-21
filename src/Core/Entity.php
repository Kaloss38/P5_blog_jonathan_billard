<?php

namespace Core;

class Entity {

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