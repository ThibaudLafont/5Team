<?php
namespace Core\Service;

/**
 * Class DIC
 * @package Core\Service
 *
 * Dependency Injection Container
 */
class DIC
{

    /**
     * @var array $registry  Functions to resolve to obtain value or dependency
     * @var array $instances Store results of $registry functions wich was already called
     */
    protected
        $registry  = [],
        $instances = [];


    ////METHODS

    /**
     * Load a file containing functions to store in $this->registry
     *
     * @param $path Path to config file
     */
    public function addDefinitions($path){
        $data = require($path);
        foreach($data as $k=>$v) $this->set($k, $v);
    }

    /**
     * Get function or stored result related to a key
     *
     * @param String $key Target key
     * @param Array $params Optional needed parameters to resolve target function
     * @return mixed
     */
    public function get(String $key, $params = null){
        if(is_callable($this->registry[$key])){
            if(!isset($this->instances[$key])){
                if($params === null) {
                    $this->instances[$key] = $this->registry[$key]();
                }
                else {
                    if(!is_array($params)) $instance = call_user_func($this->registry[$key], $params);
                    else                   $instance = call_user_func_array($this->registry[$key], array_values($params));

                    $this->instances[$key] = $instance;
                }
            }
            return $this->instances[$key];
        }
        else{
            return $this->registry[$key];
        }
    }

    /**
     * Add an entry in registry
     *
     * @param String $key
     * @param void   $resolver
     */
    public function set(String $key, $resolver){
        if(!isset($this->registry[$key])) $this->registry[$key] = $resolver;
    }

}