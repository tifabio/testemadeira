<?php

namespace Admin\Form;

use Zend\Form\Form;
   
class LocatarioForm extends UsuarioForm
{
    public function __construct($name = null)
    {
        parent::__construct();
        
        $this->add(array(
            'name' => 'tipo',
            'type' => 'Hidden',
            'attributes' => array(
                'id' => 'tipo',
                'value' => '3'
            )
        ));
        
        $this->add(array(
            'name' => 'cpf',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'cpf',
                'class' => 'form-control',
                'placeholder' => 'Preencha o CPF do locatário',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'CPF',
            )
        ));
        
        $this->add(array(
            'name' => 'datanascimento',
            'type' => 'Date',
            'attributes' => array(
                'id' => 'datanascimento',
                'class' => 'form-control',
                'placeholder' => 'Preencha a data de nascimento do locatário',
                'required' => 'required'
            ),
            'options' => array(
                'label' => 'Data de nascimento',
            )
        ));
        
        $this->get('nome')->setAttribute('placeholder', 'Preencha o nome do locatário');
        $this->get('email')->setAttribute('placeholder', 'Preencha o email do locatário');
        $this->get('senha')->setAttribute('placeholder', 'Preencha caso queira alterar a senha do locatário');
    }
}
   