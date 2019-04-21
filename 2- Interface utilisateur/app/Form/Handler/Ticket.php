<?php
namespace App\Form\Handler;

use Core\Entity\Entity;
use Core\Form\Handler;

class Ticket extends Handler
{

    /**
     * @var \App\Repository\Ticket
     */
    private $repo;

    public function __construct(\App\Repository\Ticket $repo)
    {
        $this->setRepo($repo);
    }

    /**
     * Function to execute if form submitted & valid
     *
     * @param Entity $entity
     */
    public function execute($entity)
    {
        echo 'soumis';
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
    private function getRepo(): \App\Repository\Ticket
    {
        return $this->repo;
    }

    /**
     * @param \App\Repository\Ticket $repo
     */
    private function setRepo(\App\Repository\Ticket $repo)
    {
        $this->repo = $repo;
    }
}