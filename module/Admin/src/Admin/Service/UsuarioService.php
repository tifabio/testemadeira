<?php
namespace Admin\Service;

use Doctrine\ORM\EntityManager;

use Admin\Model\Usuario;

use Admin\Form\UsuarioForm;

class UsuarioService
{
    
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }    
    
    public function getAll(array $id_tipo = [], $ativos = true)
    {
        // se não for definido (por parâmetro) o tipo de usuário, 
        // traz os tipos 1 e 2 por padrão
        $id_tipo = (count($id_tipo) == 0) ? array(1, 2) : $id_tipo;
        
        return $this->em->getRepository("Admin\Model\Usuario")
                        ->findBy(array('ativo' => ($ativos) ? 1 : 0,
                                       'idtipo' => $id_tipo));
                                 
    }
    
    public function getTipoValueOptions(array $id_tipo = [], $ativos = true)
    {
        // se não for definido (por parâmetro) o tipo de usuário, 
        // traz os tipos 1 e 2 por padrão
        $id_tipo = (count($id_tipo) == 0) ? array(1, 2) : $id_tipo;
        
        $result = $this->em->getRepository("Admin\Model\TipoUsuario")
                           ->findBy(array('ativo' => ($ativos) ? 1 : 0,
                                          'id' => $id_tipo),
                                    array('tipo' => 'ASC'));
        $tipos = array();
        $tipos[''] = 'Selecione';
                                        
        foreach($result as $tipo) {
            $tipos[$tipo->getId()] = $tipo->getTipo();
        }
        
        return $tipos;
    }
    
    
    public function save($request)
    {
        $usuario = ($request->getPost("id") > 0) ? $this->em->find("Admin\Model\Usuario", $request->getPost("id")) : new Usuario();
        
        $usuario->setId($request->getPost("id"));
        $usuario->setIdtipo($request->getPost("tipo"));
        $usuario->setNome($request->getPost("nome"));
        $usuario->setEmail($request->getPost("email"));
        if (!empty($request->getPost("senha"))) {
            $usuario->setSenha(md5($request->getPost("senha")));
        }
        
        if($usuario->getId() > 0) {
            $this->em->merge($usuario);
        } else {
            $this->em->persist($usuario);
        }
        
        $this->em->flush();
    }
    
    public function delete($id)
    {
        $usuario = $this->em->find("Admin\Model\Usuario", $id);
        $usuario->setAtivo(0);
        
        $this->em->merge($usuario);
        
        $this->em->flush();
    }
    
    public function getForm($id = 0)
    {
        $usuario = ($id > 0) ? $this->em->find("Admin\Model\Usuario", $id) : new Usuario();
        $form = new UsuarioForm();
        $form->get('id')->setValue($usuario->getId());
        $form->get('nome')->setValue($usuario->getNome());
        $form->get('tipo')->setValueOptions($this->getTipoValueOptions());
        $form->get('tipo')->setValue($usuario->getIdtipo());
        $form->get('email')->setValue($usuario->getEmail());
        return $form;
    }
}