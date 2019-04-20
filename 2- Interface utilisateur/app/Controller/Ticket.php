<?php
namespace App\Controller;

use Core\Controller\Controller;

class Ticket extends Controller
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
     * Index of application
     */
    public function index()
    {
        $this->render('index.php');
    }

    /**
     * Build view with all tickets.json elements
     */
    public function list()
    {
        $tickets = $this->getRepo()->all();
        $this->render('tickets.php', ['tickets' => $tickets]);
    }

    public function add()
    {
        echo 'add';
    }

    public function edit($id)
    {
        echo 'edit ' . $id;
    }

    /**
     * @param $id
     *
     * Delete element with given id from tickets.json
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->getRepo()->delete($id);
        }
    }

    /**
     * Return builded template for spent display
     */
    public function spent()
    {
        $spent = $this->getRepo()->spent();
        $this->render('fragments/_spent.php', $spent);
    }

    /**
     * @return mixed
     */
    private function getRepo(): \App\Repository\Ticket
    {
        return $this->repo;
    }

    /**
     * @param mixed $repo
     */
    private function setRepo(\App\Repository\Ticket $repo): void
    {
        $this->repo = $repo;
    }
}