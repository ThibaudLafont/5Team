<?php
namespace Core\Form;

//Uses
use Core\Entity\Entity;
use Core\Form\Field\Field;

/**
 * Class Form
 * @package Core\Model\Form
 *
 * Allow creation and validation of custom form
 *
 * Dependency : Core\Model\Entity\Entity
 *              Core\Model\Form\Field\Field
 */
class Form{

    /**
     * @var Instance  $entity           \Core\Entity\Entity
     * @var Array     $fields           Instances of \Core\Form\Field\Field
     * @var bool|null $isValid          True or false below given validation
     * @var Array     $validatedMessage Array containing error messages if $this->isValid() is false
     * @var TagHTML   $surround         HTML tag surrounding fields
     */
    private $entity,
            $fields = [],
            $isValid,
            $validatedMessage =
            [
                'error'   => 'Form contain errors',
                'success' => 'Form has been submit'
            ],
            $surround = 'p';

    /**
     * Use $this->setEntity
     *
     * @param Entity $entity
     */
    public function __construct(Entity $entity){
        $this->setEntity($entity);
    }


    ////METHODS

    /**
     * Add new field to form
     *
     * @param  Field $field
     * @return Form  $this  Use fluent pattern
     */
    public function addField(Field $field){
        $getter = 'get' . ucfirst($field->getName());
        $field->setValue($this->getEntity()->$getter());
        $this->fields[] = $field;
        return $this;
    }

    /**
     * Build and return dynamic view to form
     * Ask foreach field to build their views and concat
     *
     * @return HTML
     */
    public function buildView(){
        $html = '';

        $html .= $this->getValidatedMessage();

        foreach($this->fields as $field){
            $html .= $this->surround($field->buildModule());
        }

        return $html;
    }

    /**
     * Surround given content with $this->surround
     *
     * @param  HTML $html HTML content to surround
     * @return HTML string
     */
    private function surround($html){
        $tag = $this->surround;
        $html = "<{$tag}>{$html}</{$tag}>";
        return $html;
    }

    /**
     * Execute each validation tests of each field
     *
     * @return bool
     */
    public function validate(){
        $valid = true;
        foreach($this->fields as $field){
            if(!$field->validate()) $valid = false;
        }
        $this->setIsValid($valid);
        return $valid;
    }


    ////SETTERS

    /**
     * @param Entity $entity
     */
    public function setEntity(Entity $entity){
        $this->entity = $entity;
    }

    /**
     * @param bool $valid
     */
    public function setIsValid(Bool $valid){
        if(is_bool($valid)) $this->isValid = $valid;
    }

    /**
     * @param String $type    Message type [success|error]
     * @param String $message Message
     */
    public function setValidatedMessage(String $type, String $message){
        $valid_type = ['success', 'error'];
        if(in_array($type, $valid_type)) $this->validatedMessage[$type] = $message;
    }


    ////GETTERS

    /**
     * @return Entity
     */
    public function getEntity(){
        return $this->entity;
    }

    /**
     * Return bool if validation was asked
     *
     * @return bool|null
     */
    public function getIsValid(){
        return $this->isValid;
    }

    /**
     * Return adapted message in case of validation
     *
     * @return HTML|''
     */
    public function getValidatedMessage(){
        $valid =$this->getIsValid();
        if(!is_null($valid)){
            if($valid === false) $key = 'error';
            else $key = 'success';
            return "<p class=\"form_{$key}\">{$this->validatedMessage[$key]}</p>";
        }
        return '';
    }

}