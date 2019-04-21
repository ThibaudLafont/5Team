<?php
namespace App\Form\Validator;

use App\Repository\Ticket;
use Core\Form\Validator\Valeur;
use Core\Form\Validator\Validator;
use Core\JSON\Handler;

class UniqueDate extends Validator
{
    /**
     * Validation logic
     *
     * @param $var   Value
     * @return bool
     */
    public function isValid($var)
    {
        $repo = new Ticket(new Handler(Ticket::JSON_PATH));
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        foreach($repo->all() as $ticket) {
            if(
                $ticket->getFormattedDate() === $var &&
                $ticket->getId() !== $id
            ) {
                return false;
            }
        }
        return true;
    }
}