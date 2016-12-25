<?php

namespace Admin\Model;
   
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario
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
    private $idtipo;
    
    /**
    * @ORM\Column(type="string", length=255)
    */
    private $nome;
    
    /**
    * @ORM\Column(type="string", length=11)
    */
    private $cpf;
    
    /**
    * @ORM\Column(type="string", length=10)
    */
    private $datanascimento;
    
    /**
    * @ORM\Column(type="string", length=255)
    */
    private $email;
    
    /**
    * @ORM\Column(type="string", length=45)
    */
    private $senha;
    
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

	public function getIdtipo(){
		return $this->idtipo;
	}

	public function setIdtipo($idtipo){
		$this->idtipo = $idtipo;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getDatanascimento(){
		return $this->datanascimento;
	}

	public function setDatanascimento($datanascimento){
		$this->datanascimento = $datanascimento;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}
}
   