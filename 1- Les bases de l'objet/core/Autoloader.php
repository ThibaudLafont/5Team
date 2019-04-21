<?php
namespace Core;

/**
 * Class Autoloader
 * @package App\Service
 *
 * Dynamic requires based on namespaces
 */
class Autoloader
{

    /**
     * Call autoload function when class is called and not defined
     */
    static public function register(){
        spl_autoload_register(array(static::class, 'autoload'));
    }

    /**
     * Dynamic require in App and Core namespaces
     *
     * @param $class
     */
    static public function autoload($class){
        if(strpos($class, 'App\\') === 0 || strpos($class, 'Core\\') === 0)
        {
            $class = lcfirst($class);
            $class = str_replace('\\', '/', $class);
            require dirname(__DIR__) . '/' . $class . '.php';
        }
    }

}