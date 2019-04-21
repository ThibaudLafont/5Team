<?php
namespace App\Form\Handler;

use Core\Entity\Entity;
use Core\Form\Handler;

class Add extends Ticket
{

    /**
     * Function to execute if form submitted & valid
     *
     * @param Entity $entity
     */
    public function execute($entity)
    {
        $this->getRepo()->add($entity);
    }
}