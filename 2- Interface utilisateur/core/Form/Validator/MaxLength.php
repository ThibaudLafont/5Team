<?php
namespace Core\Form\Validator;

/**
 * Class MaxLength
 * @package Core\Service\Validator
 *
 * Check string length
 */
class MaxLength extends Validator{

    /**
     * @var int
     */
	private	$maxLength;

    /**
     * @param String $errorMessage
     * @param Int    $maxLength
     */
	public function __construct(String $errorMessage, Int $maxLength){
		parent::__construct($errorMessage);
		$this->setMaxLength($maxLength);
	}


	////METHODS

    /**
     * Check string length
     *
     * @param  String $var
     * @return bool
     */
	public function isValid($var){
		$varLength = strlen($var);
		$maxLength = $this->getMaxLength();

		if($varLength > $maxLength) return false;
		return true;		
	}


	////SETTERS

    /**
     * @param $maxLength
     */
	public function setMaxLength(Int $maxLength){
		$this->maxLength = $maxLength;
	}


	////GETTERS

    /**
     * @return int
     */
	public function getMaxLength(){
		return $this->maxLength;
	}

}