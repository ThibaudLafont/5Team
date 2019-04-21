<?php
namespace Core\Form\Field;

/**
 * Class Input
 * @package Core\Model\Form\Field
 *
 * Every type of input
 */
class Input extends Field{

    /**
     * @var string $type      Input type (text by default)
     * @var int    $maxLength Max length
     */
	protected $type ='text',
			  $maxLength;


	////METHODS

    /**
     * Build of HTML view
     * abstract implementation
     *
     * @return HTML|string
     */
	public function buildModule(){

		$html  = $this->buildLabelView();
		$html .= "<input id=\"{$this->getName()}\" type=\"{$this->getType()}\" name=\"{$this->getName()}\"";
		if($this->getMaxLength() !== null){
			$html .= " maxlength=\"{$this->getMaxLength()}\"";
		}
		if($this->getValue() !== null){
			$html .= " value=\"{$this->getValue()}\"";
		}
		$html .= '/>';

		return $html;
	}


	////SETTERS

    /**
     * @param Int $length
     */
	public function setMaxLength(Int $length){
		$this->maxLength = $length;
	}

    /**
     * @param String $type
     */
	public function setType(String $type){
		$this->type = $type;
	}


	////GETTERS

    /**
     * @return int
     */
	public function getMaxLength(){
		return $this->maxLength;
	}

    /**
     * @return string
     */
	public function getType(){
		return $this->type;
	}
}