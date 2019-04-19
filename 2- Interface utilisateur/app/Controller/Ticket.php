<?php
namespace App\Controller;

use Core\Controller\Controller;

class Ticket extends Controller
{
    public function index()
    {
        echo 'index';
    }

    public function list()
    {
        echo 'list';
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
        echo 'spent';
    }
}