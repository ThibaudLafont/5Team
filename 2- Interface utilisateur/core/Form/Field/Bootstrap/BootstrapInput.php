<?php
namespace Core\Form\Field\Bootstrap;

use Core\Form\Field\Input;

/**
 * Class Input
 * @package Core\Model\Form\Field
 *
 * Every type of input
 */
class BootstrapInput extends Input
{
    /**
     * Build of HTML view
     * abstract implementation
     *
     * @return HTML|string
     */
    public function buildModule(){

        $html = '<div class="form-group">';
        $html  .= $this->buildLabelView();
        $html .= "<input id=\"{$this->getName()}\" type=\"{$this->getType()}\" name=\"{$this->getName()}\" class='form-control'";
        if($this->getMaxLength() !== null){
            $html .= " maxlength=\"{$this->getMaxLength()}\"";
        }
        if($this->getValue() !== null){
            $html .= " value=\"{$this->getValue()}\"";
        }
        $html .= '/></div>';

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
            $html .= '<label class="col-form-label">'. $this->getLabel() . "<br/>";
            $html .= $this->buildErrorView();
            $html .= '</label>';
        }
        return $html;
    }
}