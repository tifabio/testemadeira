<?php

namespace Admin\Model;
   
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categoria_livro")
 */
class CategoriaLivro
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue("AUTO")
    * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
    * @ORM\Column(type="string", length=255)
    */
    private $titulo;
    
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

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}
}
   