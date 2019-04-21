<?php
namespace App\Form\Builder;

use App\Form\Validator\UniqueDate;
use Core\Form\Builder;
use Core\Form\Field\Bootstrap\BootstrapDateInput;
use Core\Form\Field\Bootstrap\BootstrapInput;
use Core\Form\Validator\FrenchDate;
use Core\Form\Validator\MaxLength;
use Core\Form\Validator\NotNull;
use Core\Form\Validator\Price;

class Ticket extends Builder
{
    /**
     * Form build from $this->addField()
     */
    public function build()
    {
        $form = $this->getForm();
        $form
            ->addField(new BootstrapInput([
                'name' => 'id',
                'type' => 'hidden'
            ]))->addField(new BootstrapInput([
                'label'      => 'Title',
                'name'       => 'title',
                'maxLength'  => 75,
                'validators' => [
                    new NotNull('Title is mandatory'),
                    new MaxLength('Title max length is 55 characters', 55)
                ]
            ]))->addField(new BootstrapDateInput([
                'label' => 'Date',
                'name' => 'date',
                'maxLength' => 10,
                'validators' => [
                    new NotNull('Date is mandatory'),
                    new FrenchDate('Date should be in dd/mm/yyyy format'),
                    new UniqueDate('An other ticket has same date (must be unique)')
                ]
            ]))->addField(new BootstrapInput([
                'label' => 'Spent',
                'name' => 'spent',
                'maxLength' => 10,
                'validators' => [
                    new NotNull('Spent is mandatory'),
                    new Price('Must be a positive number with 2 decimals maximum'),
                    new MaxLength('Spent max length is 10', 10)
                ]
            ]));
    }
}