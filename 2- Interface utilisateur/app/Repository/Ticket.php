<?php
namespace App\Repository;

use Core\JSON\Handler;

class Ticket
{

    const JSON_PATH = ROOT . '/tickets.json';

    /**
     * @var Handler
     */
    private $handler;

    public function __construct(Handler $handler)
    {
        $this->setHandler($handler);
    }

    public function all()
    {
        $return = [];
        foreach($this->getHandler()->extract() as $values) {
            $return[] = new \App\Entity\Ticket($values);
        }
        return $return;
    }

    public function add($values)
    {

    }

    public function edit($values)
    {

    }

    public function delete($element)
    {

    }

    /**
     * @return Handler
     */
    private function getHandler(): Handler
    {
        return $this->handler;
    }

    /**
     * @param mixed $handler
     */
    private function setHandler(Handler $handler)
    {
        $this->handler = $handler;
    }

}
