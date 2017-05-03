var juegos=angular.module('juegos', ['ngRoute','ngAnimate']);

juegos.config(function($routeProvider){

	$routeProvider.when('/lista', {
		templateUrl: 'Templates/lista.template.html'
	})
	.when('/add', {
		templateUrl: 'Templates/addform.template.html'
	})
	.when('/edit/:id',{

		templateUrl: 'Templates/editform.template.html',
		controller: 'editController'
	})
	.when('/', {
		templateUrl: 'Templates/home.template.html'
	})



});

juegos.controller('JuegosController', function($http,$scope){
	$scope.juego={};
	$scope.info=false;
	$scope.alerta=false;
	$scope.mostrar=function(){
		$scope.alerta=false;
		$http.get('http://localhost:8000/list').then(function(response){
			$scope.juego=response.data;
		});

		
	}

	$scope.borrar=function($id){
		$scope.alerta=true;
		$http.delete('http://localhost:8000/delete/'+$id).then(location.reload());

	}

	$scope.add=function($juego){
		$game=$juego;
		$http.post('http://localhost:8000/add',$game).then(location.replace('http://localhost:8000/front/index.html#!/lista'));


	}	

	$scope.edit=function($juego,$id){
		$game=$juego;
		$num=$id;
		$http.put('http://localhost:8000/put/'+$num,$game).then(location.replace('http://localhost:8000/front/index.html#!/lista'));

	}
});

juegos.controller('editController', function($scope,$http,$location){

	$scope.get=function(){

		$num=$location.path().split("/edit/ ");
		$n=$num.toString();
		$id=$n.slice(6,8);

		$http.get('http://localhost:8000/get/'+$id).then(function(response){

			$scope.juego=response.data;


		});

	}

});