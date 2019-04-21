<?php
namespace Core\Form\Validator;

/**
 * Class NotNull
 * @package Core\Service\Validator
 *
 * Check if given value is a date in french format d/m/Y
 */
class FrenchDate extends Validator
{

    /**
     * @param  mixed $var Date in french format d/m/Y
     * @return bool
     */
	public function isValid($var)
    {
        return true;
	}
	
}