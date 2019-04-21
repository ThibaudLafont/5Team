<?php
namespace Core;

trait Hydrate
{
    /**
     * Office constructor. Hydrate object if data is inquired
     * @param array $datas
     */
    public function __construct(Array $datas = []){
        if(!empty($datas)) $this->hydrate($datas);
    }

    /**
     * Hydrate object with values
     *
     * @param array $datas Valeurs pour les attributs de l'entité
     */
    private function hydrate(Array $datas){
        foreach($datas as $k => $v){
            $method = 'set'.ucfirst($k);
            if(method_exists($this, $method)) $this->$method($v);
        }
    }
}