<?php
namespace App\Controller;

use Core\Controller\Controller;

class Ticket extends Controller
{
    private $repo;

    public function __construct(\App\Repository\Ticket $repo)
    {
        $this->setRepo($repo);
    }

    public function index()
    {
        $this->render('/templates/index.php');
    }

    public function list()
    {
        $tickets = $this->getRepo()->all();
        $this->render('/templates/tickets.php', ['tickets' => $tickets]);
    }

    public function add()
    {
        echo 'add';
    }

    public function edit($id)
    {
        echo 'edit ' . $id;
    }

    public function spent()
    {
        // Fetch all tickets for spent calcul
        $tickets = $this->getRepo()->all();
        // Store actual month for date comparaison of ticket date
        $month = date('m');
        // Init spents
        $monthSpent = 0;
        $globalSpent = 0;

        // Spent calcul
        foreach($tickets as $ticket) {
            if($ticket->getDate()->format('m') === $month) {
                $monthSpent += $ticket->getSpent();
            }
            $globalSpent+=$ticket->getSpent();
        }

        // Return results
        var_dump(compact('monthSpent', 'globalSpent'));
    }

    /**
     * @return mixed
     */
    private function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param mixed $repo
     */
    private function setRepo($repo): void
    {
        $this->repo = $repo;
    }
}