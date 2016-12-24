<?php

namespace Admin\Model;
   
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tipo_usuario")
 */
class TipoUsuario
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue("AUTO")
    * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
    * @ORM\Column(type="string", length=45)
    */
    private $tipo;
    
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

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}
}
   