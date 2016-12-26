<?php
namespace Admin\Service;

use Doctrine\ORM\EntityManager;

use Admin\Model\Emprestimo;
use Admin\Model\Livro;

class IndexService
{
    
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }    
    
    public function getQtdLivrosCadastrados()
    {
        $query = $this->em->createQuery('SELECT sum(l.quantidade) as quantidade FROM Admin\Model\Livro l 
                                         WHERE l.ativo = 1');
                
        $result = $query->getSingleResult();
        
        $retorno = (int)$result['quantidade'];
                                         
        return $retorno;
    }
    
    public function getQtdLivrosEmprestados()
    {
        $query = $this->em->createQuery('SELECT count(e.id) as quantidade FROM Admin\Model\Emprestimo e 
                                         WHERE e.datadevolucao IS NULL');
                
        $result = $query->getSingleResult();
        
        $retorno = (int)$result['quantidade'];
                                         
        return $retorno;
    }
    
    public function getQtdLivrosAtrasados()
    {
        $query = $this->em->createQuery('SELECT count(e.id) as quantidade FROM Admin\Model\Emprestimo e 
                                         WHERE e.datadevolucao > e.dataprevista');
                
        $result = $query->getSingleResult();
        
        $retorno = (int)$result['quantidade'];
                                         
        return $retorno;
    }
    
    public function getFaturamento($mes)
    {
        $query = $this->em->createQuery('SELECT sum(e.valorpago) as faturado FROM Admin\Model\Emprestimo e 
                                         WHERE e.datadevolucao BETWEEN :inicio_mes AND :fim_mes');
                                         
        $inicio_mes = str_replace('/', '-', $mes) . '-01';
        $query->setParameter('inicio_mes', $inicio_mes); 
        $fim_mes = date("Y-m-t", strtotime($inicio_mes));
        $query->setParameter('fim_mes', $fim_mes); 
                
        $result = $query->getSingleResult();
        
        $retorno = (float)$result['faturado'];
             
        return $retorno;
    }
    
}