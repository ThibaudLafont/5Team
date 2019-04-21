<?php
namespace App\Form\Handler;

use Core\Entity\Entity;
use Core\Form\Handler;

class Edit extends Ticket
{

    /**
     * @var integer
     */
    private $id;

    public function __construct(\App\Repository\Ticket $repo, int $id)
    {
        parent::__construct($repo);
        $this->setId($id);
    }

    /**
     * Function to execute if form submitted & valid
     *
     * @param Entity $entity
     */
    public function execute($entity)
    {
        $this->getRepo()->edit($entity);
    }

    public function GETEntity()
    {
        return $this->getRepo()->find($this->getId());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
}