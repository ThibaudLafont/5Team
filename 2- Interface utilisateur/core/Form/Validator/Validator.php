<?php
namespace Core\Form\Validator;

/**
 * Class Validator
 *
 * Abstract class of Validator.
 */
abstract class Validator{

    /**
     * @var String $errorMessage Error message if value is invalid
     */
	protected $errorMessage;

    /**
     * @param String $errorMessage
     */
	public function __construct(String $errorMessage){
		$this->setErrorMessage($errorMessage);
	} 

	////ABSTRACT

    /**
     * Validation logic
     *
     * @param $var   Valeur à vérifier
     * @return bool  True si valid, false sinon
     */
	abstract public function isValid($var);


	////SETTERS

    /**
     * @param String $errorMessage
     */
	public function setErrorMessage(String $errorMessage){
		$this->errorMessage = $errorMessage;
	}


	////GETTERS

    /**
     * @return String
     */
	public function getErrorMessage(){
		return $this->errorMessage;
	}

}