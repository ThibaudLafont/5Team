<?php
namespace Core\Form\Validator;

use Core\Service\IsDate;

/**
 * Class NotNull
 * @package Core\Service\Validator
 *
 * Check if given value is a date in french format d/m/Y
 */
class FrenchDate extends Validator
{
    use IsDate;

    /**
     * @param  mixed $var Date in french format d/m/Y
     * @return bool
     */
	public function isValid($var)
    {
        return $this->isFrenchDate($var);
	}
	
}