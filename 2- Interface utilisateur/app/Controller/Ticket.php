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
        $this->render('base.php');
    }

    /**
     * Build view with all tickets.json elements
     */
    public function list()
    {
        $tickets = $this->getRepo()->all();
        $this->render('tickets.php', ['tickets' => $tickets]);
    }

    public function add(\App\Form\Handler\Add $handler)
    {
        $this->handleForm($handler);
    }

    public function edit(\App\Form\Handler\Edit $handler)
    {
        $this->handleForm($handler);
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

    private function handleForm($handler)
    {
        $handler->process();
        $form = $handler->getForm();
        // Check if form is submitted for response code
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($form->getIsValid()) {
                http_response_code(201);
            } else {
                http_response_code(400);
            }
        }

        $this->render('form.php', ['form' => $handler->getForm()]);
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