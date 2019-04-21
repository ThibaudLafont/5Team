<?php
namespace App\Form\Builder;

use Core\Form\Builder;
use Core\Form\Field\Input;
use Core\Form\Validator\MaxLength;
use Core\Form\Validator\NotNull;

class Ticket extends Builder
{
    /**
     * Form build from $this->addField()
     */
    public function build()
    {
        $form = $this->getForm();
        $form
            ->addField(new Input([
                'name' => 'id',
                'type' => 'hidden'
            ]))->addField(new Input([
                'label'      => 'Title',
                'name'       => 'title',
                'maxLength'  => 75,
                'validators' => [
                    new NotNull('Title is mandatory'),
                    new MaxLength('Title max length is 55 characters', 55)
                ]
            ]))->addField(new Input([
                'label' => 'Date (dd/mm/YYYY)',
                'name' => 'date',
                'maxLength' => 10
            ]))->addField(new Input([
                'label' => 'Spent ($)',
                'name' => 'spent',
                'maxLength' => 10
            ]));
    }
}