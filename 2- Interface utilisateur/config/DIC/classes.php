<?php
return
[
    // Tables
    'Repository\Ticket' => function(){
        return new \App\Repository\Ticket(
            new \Core\JSON\Handler(\App\Repository\Ticket::JSON_PATH)
        );
    },
    //Service
    'Router' => function(){
        return new \App\Service\Router($this);
    },
    //Controller
    'Controller\Ticket' => function(){
        return new \App\Controller\Ticket(
            $this->get('Repository\Ticket')
        );
    },
    // Form Handlers
    'Handler\Add' => function(){
        return new \App\Form\Handler\Add(
            $this->get('Repository\Ticket')
        );
    },
    'Handler\Edit' => function($id){
        return new \App\Form\Handler\Edit(
            $this->get('Repository\Ticket'),
            $id
        );
    }
];