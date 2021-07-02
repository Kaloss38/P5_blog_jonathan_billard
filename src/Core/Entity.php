<?php

namespace Core;

class Entity {
    public function __construct(array $datas = []){
        if(!empty($datas))
        {
            $this->hydrate($datas);
        }
    }

    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $attr => $value) {
            $method = 'set' . ucfirst($attr);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

}