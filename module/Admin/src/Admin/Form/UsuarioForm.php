<?php

namespace Admin\Form;

use Zend\Form\Form;
   
class UsuarioForm extends Form
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
                'placeholder' => 'Preencha o nome do usuário',
                'required' => 'required',
                'pattern' => '.{3,}'
            ),
            'options' => array(
                'label' => 'Nome',
            )
        ));
        
        $this->add(array(
            'name' => 'tipo',
            'type' => 'Select',
            'attributes' => array(
                'id' => 'tipo',
                'class' => 'form-control',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Tipo',
            )
        ));
        
        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'attributes' => array(
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Preencha o email do usuário',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Email',
            )
        ));
        
        $this->add(array(
            'name' => 'senha',
            'type' => 'Password',
            'attributes' => array(
                'id' => 'senha',
                'class' => 'form-control',
                'placeholder' => 'Preencha para alterar a senha do usuário'
            ),
            'options' => array(
                'label' => 'Senha',
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
   