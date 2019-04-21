<?php
namespace Core\Form\Field;

/**
 * Class Field
 *
 * Form field, store validators for check given value
 */
abstract class Field{

    /**
     * @var String $name         Field Name
     * @var String $label        Field label content
     * @var String $value        Field value
     * @var Array  $validators   Instances of \Core\Service\Validator\Validator
     * @var String $errorMessage Error messsages from validators
     */
    protected $name,
              $label,
              $value,
              $validators = [],
              $errorMessage;


    /**
     * Execute hydrate if values are given
     *
     * @param array $options Valeurs pour les attributs de field
     */
    public function __construct($options){
        $this->hydrate($options);
    }


    ////ABSTRACT

    /**
     * Build HTML view
     * abstract implementation
     *
     * @return HTML|string
     */
    public abstract function buildModule();


    ////METHODS

    /**
     * Build error view form $this->errorMessages
     *
     * @return HTML|null
     */
    protected function buildErrorView(){
        $html = '';
        if($this->getErrorMessage() !== null){
            $html .= '<span class="red">' . $this->getErrorMessage() . '</span>';
        }
        return $html;
    }

    /**
     * Build field label
     *
     * @return HTML
     */
    protected function buildLabelView(){
        $html = '';
        if($this->getLabel() !== null){
            $html .= '<label>'. $this->getLabel() . "<br/>";
            $html .= $this->buildErrorView();
            $html .= '</label>';
        }
        return $html;
    }

    /**
     * Inquire field attributes values
     *
     * @param array $options Valeurs pour les attributs du field
     */
    public function hydrate($options){
        foreach($options as $k => $v){
            $method = 'set' . ucfirst($k);
            if(method_exists($this, $method)){
                $this->$method($v);
            }
        }
    }

    /**
     * Execute each validator stored in $this->>validators
     * Stop at the first non valid check, and store error message
     *
     * @return bool
     */
    public function validate(){
        $validators = $this->validators;
        if(!empty($validators)){
            foreach($validators as $validator){
                if(!$validator->isValid($this->getValue())){
                    $this->errorMessage = $validator->getErrorMessage();
                    return false;
                }
            }
        }
        return true;
    }


    ////GETTERS

    /**
     * @return String Error message
     */
    public function getErrorMessage(){
        return $this->errorMessage;
    }

    /**
     * @return String
     */
    public function getLabel(){
        return $this->label;
    }

    /**
     * @return String
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return String
     */
    public function getValue(){
        return $this->value;
    }


    ////SETTERS

    /**
     * @param String|null $label
     */
    public function setLabel($label){
        $this->label = $label;
    }

    /**
     * @param String $name
     */
    public function setName(String $name){
        $this->name = $name;
    }

    /**
     * Check if validators are instances of \Core\Form\Validator\Validator and assign them in $this->validators
     *
     * @param array $validators Tableau contenant des instances de \Core\Service\Validator\Validator
     */
    public function setValidators(Array $validators){
        foreach ($validators as $validator){
            if ($validator instanceof \Core\Form\Validator\Validator && !in_array($validator, $this->validators)){
                $this->validators[] = $validator;
            }
        }
    }

    /**
     * @param String|null $value
     */
    public function setValue($value){
        $this->value = $value;
    }

}