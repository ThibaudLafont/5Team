<?php
return
[
    'Controller\Ticket\Add' => function(){
        $controller = $this->get('Controller\Ticket');
        $controller->add($this->get('Handler\Add'));
    },
    'Controller\Ticket\Edit' => function($id){
        $controller = $this->get('Controller\Ticket');
        $controller->edit($this->get('Handler\Edit', $id));
    }
];