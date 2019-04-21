<?php
namespace Core\Form\Field\Bootstrap;
use Core\Service\IsDate;

/**
 * Class Input
 * @package Core\Model\Form\Field
 *
 * Every type of input
 */
class BootstrapDateInput extends BootstrapInput
{
    use IsDate;

    /**
     * @param String|null $value
     */
    public function setValue($value){
        if($this->isFrenchDate($value)) {
            $this->value = $value->format('d/m/Y');
        } else {
            $this->value = $value;
        }
    }
}