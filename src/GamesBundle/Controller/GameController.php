<?php  
namespace GamesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use GamesBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class GameController extends FOSRestController{

	/**
	*@REST\Get("/list")
	*
	*/
	public function listAction(){
		$juegos=$this->getDoctrine()->getEntityManager();
		$rd = $juegos->getRepository('GamesBundle:Game');
		$rg = $rd->findAll();
		$final = $this->get("serializer")->normalize($rg);
		return new JsonResponse($final);
	}

	/**
	*@REST\Delete("/delete")
	*
	*/
	public function deleteAction($id){
		
		$em=$this->getDoctrine()->getManager();
		$game=$em->getRepository('GamesBundle:Game')->findOneById($id);
		$em->remove($game);
		$em->flush();
		return new Response('Juego borrado con éxito');
	}

	/**
	*@REST\Post("/add")
	*
	*/
	public function addAction(Request $request){
		$titulo=$request->request->get('titulo');
		$genero=$request->request->get('genero');
		$estudio=$request->request->get('estudio');
		$game=new Game($titulo,$genero,$estudio);
		$em=$this->getDoctrine()->getManager();
		$em->persist($game);
		$em->flush();
		if(!empty($game)){
			return new Response('Juego Añadido');
		}
	}	

	/**
	*@REST\Put("/put")
	*
	*/
	public function putAction(Request $request,$id){
		$id=$request->request->get('id');
		$titulo=$request->request->get('titulo');
		$genero=$request->request->get('genero');
		$estudio=$request->request->get('estudio');
		$em=$this->getDoctrine()->getManager();
		$game=$em->getRepository('GamesBundle:Game')->findOneById($id);
		$game->setTitulo($titulo);
		$game->setGenero($genero);
		$game->setEstudio($estudio);
		$em->flush();
		if(!empty($game)){
			return new Response('Juego Editado');
		}

	}	

	/**
	*@REST\Get("/get")
	*
	*/
	public function getAction($id){

		$juegos=$this->getDoctrine()->getEntityManager();
		$rd = $juegos->getRepository('GamesBundle:Game');
		$rg = $rd->findOneById($id);
		$final = $this->get("serializer")->normalize($rg);
		return new JsonResponse($final);

	}

}






?>