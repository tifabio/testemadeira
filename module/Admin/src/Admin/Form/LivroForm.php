<?php

namespace Admin\Form;

use Zend\Form\Form;
   
class LivroForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct();
        
        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'titulo',
                'class' => 'form-control',
                'placeholder' => 'Preencha o nome do livro',
                'required' => 'required',
                'pattern' => '.{3,}'
            ),
            'options' => array(
                'label' => 'Nome',
            )
        ));
        
        $this->add(array(
            'name' => 'categoria',
            'type' => 'Select',
            'attributes' => array(
                'id' => 'categoria',
                'class' => 'form-control',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Categoria',
            )
        ));
        
        $this->add(array(
            'name' => 'quantidade',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'quantidade',
                'class' => 'form-control',
                'placeholder' => 'Preencha a quantidade de livros',
                'required' => 'required',
                'pattern' => '.{1,}'
            ),
            'options' => array(
                'label' => 'Quantidade',
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
   