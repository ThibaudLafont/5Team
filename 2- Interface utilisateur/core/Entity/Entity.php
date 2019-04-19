<?php
namespace Core\Entity;

/**
 * Class Entity
 * @package Core\Entity
 *
 * Define main functions of entities
 */
class Entity
{
    /**
     * Execute $this->hydrate if datas are given
     *
     * @param array $data Values of entity attributes
     */
    public function __construct(Array $data = []){
        if(!empty($data)) $this->hydrate($data);
    }

    /**
     * Dynamic assignment of attributes from an indexed array
     *
     * @param array $data Values of entity
     */
    public function hydrate(Array $data){
        foreach($data as $k => $v){
            $method = 'set'.ucfirst($k);
            if(method_exists($this, $method)) $this->$method($v);
        }
    }
}