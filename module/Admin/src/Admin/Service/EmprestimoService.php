<?php
namespace Admin\Service;

use Doctrine\ORM\EntityManager;

use Admin\Model\Emprestimo;
use Admin\Model\Usuario;
use Admin\Model\Livro;

use Admin\Form\EmprestimoForm;

class EmprestimoService
{
    
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }    
    
    public function getAll($id_usuario = 0, $ativos = true)
    {
        $sql = "SELECT 
                    e, l, u FROM 
                Admin\Model\Emprestimo e 
                JOIN e.livro l
                JOIN e.usuario u";
                                         
        if($id_usuario > 0) {
            $sql .= " WHERE e.idusuario = " . $id_usuario;
        }
        
        $sql .= " ORDER BY e.dataprevista, e.id";
        
        $query = $this->em->createQuery($sql);
        return $query->getResult();                                 
    }
    
    public function getUsuarioValueOptions(array $id_tipo = [], $ativos = true)
    {
        // se não for definido (por parâmetro) o tipo de usuário, 
        // traz o tipo 3 por padrão
        $id_tipo = (count($id_tipo) == 0) ? array(3) : $id_tipo;
        
        $result = $this->em->getRepository("Admin\Model\Usuario")
                           ->findBy(array('ativo' => ($ativos) ? 1 : 0,
                                          'idtipo' => $id_tipo),
                                    array('nome' => 'ASC'));
        $usuarios = array();
        $usuarios[''] = 'Selecione';
                                        
        foreach($result as $usuario) {
            $usuarios[$usuario->getId()] = $usuario->getNome();
        }
        
        return $usuarios;
    }
    
    public function getLivroValueOptions($ativos = true)
    {
        $query = $this->em->createQuery('SELECT l FROM Admin\Model\Livro l
                                         WHERE l.quantidade > (SELECT count(e.id) FROM Admin\Model\Emprestimo e WHERE e.livro = l.id AND e.datadevolucao IS NULL)
                                         AND l.ativo = :ativo');
                                         
        $query->setParameter('ativo', ($ativos) ? 1 : 0);                                         

        $result = $query->getResult();  
    
        $livros = array();
        $livros[''] = 'Selecione';
                                        
        foreach($result as $livro) {
            $livros[$livro->getId()] = $livro->getNome();
        }
        
        return $livros;
    }
    
    public function save($request)
    {
        $emprestimo = new Emprestimo();
        
        $usuario = $this->em->find("Admin\Model\Usuario", $request->getPost("usuario"));
        $livro = $this->em->find("Admin\Model\Livro", $request->getPost("livro"));
        
        $emprestimo->setDataretirada(date("Y-m-d"));
        $data = (!empty($request->getPost("dataprevista"))) ? implode('-', array_reverse(explode('/', $request->getPost("dataprevista")))) : null;
        $emprestimo->setDataprevista($data);
        $emprestimo->setUsuario($usuario);
        $emprestimo->setLivro($livro);
        
        if($emprestimo->getId() > 0) {
            $this->em->merge($emprestimo);
        } else {
            $this->em->persist($emprestimo);
        }
        
        $this->em->flush();
    }
    
    public function devolver($id)
    {
        $emprestimo = $this->em->find("Admin\Model\Emprestimo", $id);
        $emprestimo->setDatadevolucao(date("Y-m-d"));
        
        $diasEmprestimo = strtotime($emprestimo->getDatadevolucao()) - strtotime($emprestimo->getDataretirada());
        $diasEmprestimo = intval($diasEmprestimo/86400);
        $diasEmprestimo = ($diasEmprestimo == 0) ? 1 : $diasEmprestimo;
        $valorEmprestimo = $emprestimo->getValoremprestimo() * $diasEmprestimo;
        
        $diasMulta = strtotime($emprestimo->getDatadevolucao()) - strtotime($emprestimo->getDataprevista());
        $diasMulta = intval($diasMulta/86400);
        $valorMulta = ($diasMulta > 0) ? $emprestimo->getValoremprestimo() * 2 * $diasMulta : 0;
        
        $valorPago = $valorEmprestimo + $valorMulta;
        $emprestimo->setValorpago($valorPago);
        
        $this->em->persist($emprestimo);
        
        $this->em->flush();
    }
    
    public function getForm($id_usuario = 0)
    {
        $form = new EmprestimoForm();
        if($id_usuario == 0) {
            $form->get('usuario')->setValueOptions($this->getUsuarioValueOptions());
        } else {
            $form->add(array(
                'name' => 'usuario',
                'type' => 'Hidden',
                'attributes' => array(
                    'value' => $id_usuario
                )
            ));
        }
        $form->get('livro')->setValueOptions($this->getLivroValueOptions());
        return $form;
    }
}