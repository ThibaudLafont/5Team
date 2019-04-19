<?php
namespace Core\Controller;

/**
 * Class Controller
 * @package Core\Controller
 *
 * Define main functions of controller
 */
abstract class Controller
{
    /**
     * 403 response
     */
    public function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        echo '403 error - Forbidden';
    }

    /**
     * 404 response
     */
    public function notFound(){
        header('HTTP/1.0 404 Not Found');
        echo '404 error - Page not found';
    }
}