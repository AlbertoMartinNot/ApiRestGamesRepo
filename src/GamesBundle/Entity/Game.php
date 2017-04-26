<?php
	namespace GamesBundle\Entity;

	use Doctrine\ORM\Mapping as ORM;

	/**
	*@ORM\Entity
	*@ORM\Table(name="games")
	*/

	class Game{

	/**
	*@ORM\Id
	*@ORM\Column(type="integer")
	*@ORM\GeneratedValue(strategy="AUTO")
	*/
		protected $id;

	/**
	*@ORM\Column(type="string",length=40)
	*/
		protected $titulo;

	/**
	*@ORM\Column(type="string",length=20)
	*/	
		protected $genero;

	/**
	*@ORM\Column(type="string",length=30)
	*/	
		protected $estudio;


	public function __construct($titulo,$genero,$estudio){

		$this->titulo=$titulo;
		$this->genero=$genero;
		$this->estudio=$estudio;

	}

	public function getId(){

		return $this->id;
	}

	public function setId($id){

		$this->id=$id;
	}

	public function getTitulo(){
		return $this->titulo;

	}

	public function setTitulo($titulo){

		$this->titulo=$titulo;
	}

	public function getGenero(){
		return $this->genero;
	}

	public function setGenero($genero){

		$this->genero=$genero;
	}

	public function getEstudio(){

		return $this->estudio;
	}

	public function setEstudio($estudio){

		$this->estudio=$estudio;
	}
}