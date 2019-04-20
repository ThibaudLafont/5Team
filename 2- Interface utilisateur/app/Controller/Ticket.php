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
        $this->render('index.php');
    }

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

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->getRepo()->delete($id);
        }
    }

    public function spent()
    {
        $spent = $this->getRepo()->spent();
        $this->render('fragments/_spent.php', $spent);
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