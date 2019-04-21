<?php
namespace App\Form\Handler;

use Core\Entity\Entity;
use Core\Form\Handler;

abstract class Ticket extends Handler
{

    /**
     * @var \App\Repository\Ticket
     */
    protected $repo;

    public function __construct(\App\Repository\Ticket $repo)
    {
        $this->setRepo($repo);
    }

    /**
     * Entity to give if POST request
     *
     * @return Entity $entity
     */
    public function POSTEntity()
    {
        $entityParams = $this->post2EntityParams(['id', 'title', 'date', 'spent']);
        $entity = $this->buildEntity($entityParams);
        return $entity;
    }

    /**
     * @return \App\Repository\Ticket
     */
    protected function getRepo(): \App\Repository\Ticket
    {
        return $this->repo;
    }

    /**
     * @param \App\Repository\Ticket $repo
     */
    protected function setRepo(\App\Repository\Ticket $repo)
    {
        $this->repo = $repo;
    }
}