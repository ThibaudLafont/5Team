<?php
return
[
    'Controller\Ticket\Add' => function(){
        $controller = $this->get('Controller\Ticket');
        $handler = $this->get('Handler\Ticket');
        $controller->add($handler);
    }
];