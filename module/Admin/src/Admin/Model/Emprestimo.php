<?php

namespace Admin\Model;
   
use Doctrine\ORM\Mapping as ORM;

use Admin\Model\Livro;

/**
 * @ORM\Entity
 * @ORM\Table(name="emprestimo")
 */
class Emprestimo
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue("AUTO")
    * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
    * @ORM\OneToOne(targetEntity="Livro")
	* @ORM\JoinColumn(name="idlivro", referencedColumnName="id")
    */
    private $livro;
    
    /**
    * @ORM\OneToOne(targetEntity="Usuario")
	* @ORM\JoinColumn(name="idusuario", referencedColumnName="id")
    */
    private $usuario;
    
    /**
    * @ORM\Column(type="integer")
    */
    private $idusuario;
    
    /**
    * @ORM\Column(type="string", length=10)
    */
    private $dataretirada;
    
    /**
    * @ORM\Column(type="string", length=10)
    */
    private $dataprevista;
    
    /**
    * @ORM\Column(type="string", length=10)
    */
    private $datadevolucao;
    
    /**
    * @ORM\Column(type="float")
    */
    private $valoremprestimo = 0.2;
    
    /**
    * @ORM\Column(type="float")
    */
    private $valorpago;
    
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getLivro(){
		return $this->livro;
	}

	public function setLivro($livro){
		$this->livro = $livro;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getDataretirada(){
		return $this->dataretirada;
	}

	public function setDataretirada($dataretirada){
		$this->dataretirada = $dataretirada;
	}

	public function getDataprevista(){
		return $this->dataprevista;
	}

	public function setDataprevista($dataprevista){
		$this->dataprevista = $dataprevista;
	}

	public function getDatadevolucao(){
		return $this->datadevolucao;
	}

	public function setDatadevolucao($datadevolucao){
		$this->datadevolucao = $datadevolucao;
	}

	public function getValoremprestimo(){
		return $this->valoremprestimo;
	}

	public function setValoremprestimo($valoremprestimo){
		$this->valoremprestimo = $valoremprestimo;
	}

	public function getValorpago(){
		return $this->valorpago;
	}

	public function setValorpago($valorpago){
		$this->valorpago = $valorpago;
	}
}
   