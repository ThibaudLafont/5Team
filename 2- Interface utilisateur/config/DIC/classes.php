<?php
return
[
    // Tables
    'Repository/Ticket' => function(){
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
            new \App\Repository\Ticket(
                new \Core\JSON\Handler(\App\Repository\Ticket::JSON_PATH)
            )
        );
    },
    // Form Handlers
    'Handler\Ticket' => function(){
        return new \App\Form\Handler\Ticket(
            $this->get('Repository/Ticket')
        );
    }
];