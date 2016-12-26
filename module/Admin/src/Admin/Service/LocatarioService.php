<?php
namespace Admin\Service;

use Doctrine\ORM\EntityManager;

use Admin\Model\Usuario;

use Admin\Form\LocatarioForm;

class LocatarioService extends UsuarioService
{
    
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }    
    
    public function getAll(array $id_tipo = [], $ativos = true)
    {
        return parent::getAll(array(3), $ativos = true);
    }
    
    public function getForm($id = 0)
    {
        $locatario = ($id > 0) ? $this->em->find("Admin\Model\Usuario", $id) : new Usuario();
        $form = new LocatarioForm();
        $form->get('id')->setValue($locatario->getId());
        $form->get('nome')->setValue($locatario->getNome());
        $form->get('email')->setValue($locatario->getEmail());
        $form->get('cpf')->setValue($locatario->getCpf());
        $form->get('datanascimento')->setValue($locatario->getDatanascimento());
        if($id == 0) {
            $form->get('senha')->setAttribute('required', 'required');    
            $form->get('senha')->setAttribute('placeholder', 'Preencha a senha do locatário');
        }
        return $form;
    }
}