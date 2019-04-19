<?php
namespace App\Service;

use Core\Service\DIC;

/**
 * Class Router
 * @package App\Service
 *
 * Specialisation of router to inject DIC and return not found if no route match
 */
class Router extends \Core\Service\Router
{

    /**
     * @var DIC $dic
     */
    private $dic;

    /**
     * Router constructor.
     * @param DIC $dic
     */
    public function __construct(DIC $dic){
        $this->setDIC($dic);
    }


    ////METHODS

    /**
     * Call parent function and return not found if no match
     *
     * @param \Core\Service\URL $uri
     * @return mixed
     */
    public function execute($uri)
    {
        try{
            return parent::execute($uri);
        }catch(\Exception $e){
            $controller = $this->getDIC()->get('Controller\Ticket');
            $controller->notFound();
        }
    }


    ////SETTERS

    /**
     * @param DIC $dic
     */
    public function setDIC(DIC $dic){
        $this->dic = $dic;
    }


    ////GETTERS

    /**
     * @return DIC
     */
    public function getDIC(){
        return $this->dic;
    }

}
