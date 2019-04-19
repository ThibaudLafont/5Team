<?php
return
[
    //Service
    'Router' => function(){
        return new \App\Service\Router($this);
    },
    //Controller
    'Controller\Ticket' => function(){
        return new \App\Controller\Ticket();
    }
];