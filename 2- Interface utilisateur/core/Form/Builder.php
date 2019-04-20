<?php
namespace Core\Form;

//Uses
use Core\Entity\Entity;
use Core\Form\Form;

/**
 * Class Builder
 *
 * Allow to build a specific form, case by case
 * Eventually allow to :
 *      1- Create and hydrate form with entity
 *      2- Build the form with self::build method
 *
 * Dependency : \Core\Entity\Entity
 *              \Core\Form\Form
 */
abstract class Builder{

    /**
     * @var \Core\Form\Form
     */
	protected $form;

    /**
     * Create form from given entity
     *
     * @param \Core\Entity\Entity $entity
     */
	public function __construct(Entity $entity){

		$this->setForm(new Form($entity));

	}


	////ABSTRACT

    /**
     * Form build from $this->addField()
     */
	public abstract function build();


	////SETTERS

    /**
     * @param \Core\Form\Form $form
     */
	private function setForm(Form $form){
		$this->form = $form;
	}


	////GETTERS

    /**
     * @return \Core\Form\Form
     */
	public function getForm(){
		return $this->form;
	}

}