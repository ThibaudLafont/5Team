<?php
namespace Core\Service;

/**
 * Class Router
 * @package Core\Service
 *
 * Regex based router
 */
class Router
{

    /**
     * @var array $routes Contain regex and resolvers
     */
    private $routes = array();


    ////METHODS

    /**
     * From a config file, store all routes and resolvers
     *
     * @param $path Path to config files
     */
    public function addDefinitions($path){
        $routes = require($path);
        if(is_array($routes)){
            foreach($routes as $k => $v){
                $this->route($k, $v);
            }
        }
    }

    /**
     * Check an URI and load related controller method if match with $this->routes
     *
     * @param $uri URL
     * @return mixed
     *
     * @throws \Exception
     */
    public function execute($uri) {
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $uri, $params) === 1) {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }
        throw new \Exception('No matching route');
    }

    /**
     * Add an entry to $this->routes;
     *
     * @param ReGex    $pattern
     * @param Callable $callback
     */
    public function route($pattern, Callable $callback) {
        $this->routes[$pattern] = $callback;
    }
}