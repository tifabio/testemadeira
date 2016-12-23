<?php
namespace Admin\Service;

use Doctrine\ORM\EntityManager;

use Admin\Model\Livro;
use Admin\Model\CategoriaLivro;

use Admin\Form\LivroForm;

class LivroService
{
    
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }    
    
    public function getAll($ativos = true)
    {
        return $this->em->getRepository("Admin\Model\Livro")
                        ->findBy(array('ativo' => ($ativos) ? 1 : 0));
                                 
    }
    
    public function getCategoriasValueOptions($ativos = true)
    {
        $result = $this->em->getRepository("Admin\Model\CategoriaLivro")
                           ->findBy(array('ativo' => ($ativos) ? 1 : 0),
                                    array('titulo' => 'ASC'));
        $categorias = array();
        $categorias[''] = 'Selecione';
                                        
        foreach($result as $categoria) {
            $categorias[$categoria->getId()] = $categoria->getTitulo();
        }
        
        return $categorias;
    }
    
    public function save($request)
    {
        $livro = new Livro();
        
        $livro->setId($request->getPost("id"));
        $livro->setNome($request->getPost("nome"));
        $livro->setIdCategoria($request->getPost("categoria"));
        $livro->setQuantidade($request->getPost("quantidade"));
        
        if($livro->getId() > 0) {
            $this->em->merge($livro);
        } else {
            $this->em->persist($livro);
        }
        
        $this->em->flush();
    }
    
    public function delete($id)
    {
        $livro = $this->em->find("Admin\Model\Livro", $id);
        $livro->setId($id);
        $livro->setAtivo(0);
        
        $this->em->merge($livro);
        
        $this->em->flush();
    }
    
    public function getForm($id = 0)
    {
        $livro = ($id > 0) ? $this->em->find("Admin\Model\Livro", $id) : new Livro();
        $form = new LivroForm();
        $form->get('id')->setValue($livro->getId());
        $form->get('nome')->setValue($livro->getNome());
        $form->get('categoria')->setValueOptions($this->getCategoriasValueOptions());
        $form->get('categoria')->setValue($livro->getIdCategoria());
        $form->get('quantidade')->setValue($livro->getQuantidade());
        return $form;
    }
}