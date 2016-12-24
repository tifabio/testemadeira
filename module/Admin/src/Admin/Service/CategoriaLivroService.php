<?php
namespace Admin\Service;

use Doctrine\ORM\EntityManager;

use Admin\Model\CategoriaLivro;

use Admin\Form\CategoriaLivroForm;

class CategoriaLivroService
{
    
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }    
    
    public function getAll($ativos = true)
    {
        return $this->em->getRepository("Admin\Model\CategoriaLivro")
                        ->findBy(array('ativo' => ($ativos) ? 1 : 0));
    }
    
    public function save($request)
    {
        $categoria = new CategoriaLivro();
        
        $categoria->setId($request->getPost("id"));
        $categoria->setTitulo($request->getPost("titulo"));
        
        if($categoria->getId() > 0) {
            $this->em->merge($categoria);
        } else {
            $this->em->persist($categoria);
        }
        
        $this->em->flush();
    }
    
    public function delete($id)
    {
        $categoria = $this->em->find("Admin\Model\CategoriaLivro", $id);
        $categoria->setAtivo(0);
        
        $this->em->merge($categoria);
        
        $this->em->flush();
    }
    
    public function getForm($id = 0)
    {
        $categoria = ($id > 0) ? $this->em->find("Admin\Model\CategoriaLivro", $id) : new CategoriaLivro();
        $form = new CategoriaLivroForm();
        $form->get('titulo')->setValue($categoria->getTitulo());
        $form->get('id')->setValue($categoria->getId());
        return $form;
    }
}