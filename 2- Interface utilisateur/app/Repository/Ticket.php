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
        foreach($this->getHandler()->getData() as $k=>$values) {
            $ticket = new \App\Entity\Ticket($values);
            $ticket->setId($k);
            $return[] = $ticket;
        }
        usort($return, [self::class, 'sortByDate']);
        return $return;
    }

    public function find($id)
    {
        $values = $this->getHandler()->getData()[$id];
        $entity = new \App\Entity\Ticket($values);
        $entity->setId($id);
        return $entity;
    }

    public function add($entity)
    {
        $handler = $this->getHandler();
        $handler->createElement([
            'title' => $entity->getTitle(),
            'date' => $entity->getFormattedDate(),
            'spent' => $entity->getSpent(),
        ]);
        $handler->write();
    }

    public function edit($entity)
    {
        $handler = $this->getHandler();
        $handler->editElement(
            $entity->getId(), [
            'title' => $entity->getTitle(),
            'date' => $entity->getFormattedDate(),
            'spent' => $entity->getSpent(),
        ]);
        $handler->write();
    }

    public function delete($element)
    {
        $this->getHandler()->removeElement($element);
        $this->getHandler()->write();
    }

    public function spent()
    {
        // Fetch all tickets for spent calcul
        $tickets = $this->all();
        // Store actual month for date comparaison of ticket date
        $month = date('m/Y');
        // Init spents
        $monthSpent = 0;
        $globalSpent = 0;

        // Spent calcul
        foreach($tickets as $ticket) {
            if($ticket->getDate()->format('m/Y') === $month) {
                $monthSpent += $ticket->getSpent();
            }
            $globalSpent+=$ticket->getSpent();
        }

        // Return results
        return compact('monthSpent', 'globalSpent');
    }

    private static function sortByDate($a, $b) {
        if ($a->getDate() == $b->getDate()) {
            return 0;
        }

        return ($a->getDate() > $b->getDate()) ? -1 : 1;
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
