<?php

namespace Admin\Model;
   
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="livro")
 */
class Livro
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue("AUTO")
    * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
    * @ORM\Column(type="integer")
    */
    private $idcategoria;
    
    /**
    * @ORM\Column(type="string", length=255)
    */
    private $nome;
    
    /**
    * @ORM\Column(type="integer")
    */
    private $quantidade;
    
    /**
    * @ORM\Column(type="integer")
    */
    private $ativo = 1;
    
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getIdcategoria(){
		return $this->idcategoria;
	}

	public function setIdcategoria($idcategoria){
		$this->idcategoria = $idcategoria;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getQuantidade(){
		return $this->quantidade;
	}

	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}
}
   