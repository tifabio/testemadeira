<?php

namespace Admin\Form;

use Zend\Form\Form;
   
class CategoriaLivroForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct();
        
        $this->add(array(
            'name' => 'titulo',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'titulo',
                'class' => 'form-control',
                'placeholder' => 'Preencha o título da categoria',
                'required' => 'required',
                'pattern' => '.{3,}'
            ),
            'options' => array(
                'label' => 'Título',
            )
        ));
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
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
   