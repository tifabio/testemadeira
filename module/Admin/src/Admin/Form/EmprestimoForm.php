<?php

namespace Admin\Form;

use Zend\Form\Form;
   
class EmprestimoForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct();
        
        $this->add(array(
            'name' => 'usuario',
            'type' => 'Select',
            'attributes' => array(
                'id' => 'usuario',
                'class' => 'form-control',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Locatário',
            )
        ));
        
        $this->add(array(
            'name' => 'livro',
            'type' => 'Select',
            'attributes' => array(
                'id' => 'livro',
                'class' => 'form-control',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Livro',
            )
        ));
        
        $this->add(array(
            'name' => 'dataprevista',
            'type' => 'Date',
            'attributes' => array(
                'id' => 'dataprevista',
                'class' => 'form-control',
                'placeholder' => 'Preencha a data prevista',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Devolver em',
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Button',
            'attributes' => array(
                'type'  => 'submit',
                'class' => 'btn btn-primary'
            ),
            'options' => array(
                'label' => '<i class="fa fa-save"></i> Gravar',
                'label_options' => array(
                    'disable_html_escape' => true,
                )
            )
        ));
    }
}
   