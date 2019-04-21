<?php
return
[
    '/^\/\/?$/' => function(){
        $controller = $this->getDic()->get('Controller\Ticket');
        $controller->index();
    },
    '/^\/list\/?$/' => function(){
        $controller = $this->getDic()->get('Controller\Ticket');
        $controller->list();
    },
    '/^\/add\/?$/' => function(){
        $this->getDic()->get('Controller\Ticket\Add');
    },
    '/^\/edit\/(\d+)\/?$/' => function($id){
        $controller = $this->getDic()->get('Controller\Ticket');
        $controller->edit($id);
    },
    '/^\/delete\/(\d+)\/?$/' => function($id){
        $controller = $this->getDic()->get('Controller\Ticket');
        $controller->delete($id);
    },
    '/^\/spent\/?$/' => function(){
        $controller = $this->getDic()->get('Controller\Ticket');
        $controller->spent();
    },
];
