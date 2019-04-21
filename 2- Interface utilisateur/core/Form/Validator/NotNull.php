<?php
namespace Core\Form\Validator;

/**
 * Class NotNull
 * @package Core\Service\Validator
 *
 * Check if given value is null or empty
 */
class NotNull extends Validator{

    /**
     * @param  mixed $var
     * @return bool
     */
	public function isValid($var){
	    if(is_string($var)) return $var != '';
	    else return is_null($var);
	}
	
}