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
        $controller = $this->getDic()->get('Controller\Ticket');
        $controller->add();
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
