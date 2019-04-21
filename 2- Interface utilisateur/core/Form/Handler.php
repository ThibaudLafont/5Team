<?php
namespace Core\Form;

//Uses
use Core\Entity\Entity;

/**
 * Class Handler
 *
 * Allow dynamic handling of form (GET, POST)
 * Form Factory builder
 *
 * Eventually define :
 *      1- Entity to use if GET request
 *      2- POST values to fetch in case of submission
 *      3- Action to perform if form is submitted and valid
 *
 */
abstract class Handler
{

    /**
     * @var String                $name Handler name in App\Service
     * @var \Core\Form\Form $form Form instance
     */
    protected $name,
              $form;


    ////ABSTRACT

    /**
     * Function to execute if form submitted & valid
     *
     * @param Entity $entity
     */
    public abstract function execute($entity);

    /**
     * Entity to give if POST request
     *
     * @return Entity $entity
     */
    public abstract function POSTEntity();


    ////METHODS

    /**
     * Hydrate entity form array data
     *
     * @param  array $entity_params Entity attributes values
     * @return Entity
     */
    public function buildEntity($entity_params = []){
        $entity_class = '\App\Entity\\' . $this->getName();
        return new $entity_class($entity_params);
    }

    /**
     * Enitity for GET requests
     *
     * @return Entity $entity
     */
    public function GETEntity()
    {
        $entity = $this->buildEntity();
        return $entity;
    }

    /**
     * Build array from POST values
     *
     * @param  array $datas Array with input names to fetch
     * @return array        Array for entity->hydrate()
     */
    public function post2EntityParams(Array $datas){
        $fields = [];
        foreach($datas as $key){
            $fields[$key] = isset($_POST[$key]) ? $_POST[$key] : '';
        }
        return $fields;
    }

    /**
     * Create entity dynamically, based on request method, inject it to form
     * If POST: call validation
     * If POST and form->isValid(): execute given action
     */
    public function process(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $entity = $this->getEntity();
        }else{
            $entity = $this->postEntity();
        }

        $this->setForm($entity);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($this->getForm()->validate()){
                $this->execute($entity);
            }
        }
    }


    ////SETTERS

    /**
     * Create, hydrate and store form thanks to Form\Builder
     *
     * @param Entity  $entity
     */
    public function setForm(Entity $entity)
    {
        $builder_class = '\App\Form\Builder\\' . $this->getName();
        $formBuilder = new $builder_class($entity);

        $formBuilder->build();
        $form = $formBuilder->getForm();

        $this->form = $form;
    }

    /**
     * Dynamic fetch of Service\Handler name
     */
    public function setName(){
        $class = get_class($this); //Fetch class name

        $needle_pos = strpos($class, 'Handler\\'); //Define Class name without namespace
        $needle_length = strlen('Handler\\');
        $start = $needle_pos+$needle_length;

        $name = substr($class, $start); // Store class name without namespace prefix

        $end = strpos($name, '\\'); // Handle case of Handler heritage is from an other class of this
        if($end) $name = substr($name, 0, $end);

        $this->name = $name;
    }


    ////GETTERS

    /**
     * @return \Core\Form\Form
     */
    public function getForm(){
        return $this->form;
    }

    /**
     * @return String
     */
    public function getName(){
        if($this->name === null) $this->setName();
        return $this->name;
    }

}