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
     * @param string $templatePath
     * @param array $viewData
     *
     * Allow to inject variables in given template file
     */
    protected function render(string $templatePath, array $viewData = [])
    {
        if(!empty($viewData))
            extract($viewData);
        ob_start();
        include(ROOT . '/templates/' . $templatePath);
        echo ob_get_clean();
    }

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