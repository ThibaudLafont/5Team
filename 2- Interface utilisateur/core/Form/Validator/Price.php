<?php
namespace Core\Form\Validator;

/**
 * Class NotNull
 * @package Core\Service\Validator
 *
 * Check if given value is a price
 */
class Price extends Validator{

    /**
     * @param  mixed $var
     * @return bool
     */
	public function isValid($var){
	    if(preg_match('/^(\d)+(\.\d{2})?$/', (float)$var) && (float)$var>0) return true;
	    else return false;
	}
	
}