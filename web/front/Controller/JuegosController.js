var juegos=angular.module('juegos', ['ngRoute']);

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



});

juegos.controller('JuegosController', function($http,$scope){
	$scope.juego={};

	$scope.mostrar=function(){
		$http.get('http://localhost:8000/list').then(function(response){

			$scope.juego=response.data;


		});

		
	}

	$scope.borrar=function($id){
		console.log($id);
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
		console.log($num);
		$n=$num.toString();
		console.log($n);
		$id=$n.slice(6,8);

		$http.get('http://localhost:8000/get/'+$id).then(function(response){

			$scope.juego=response.data;


		});

	}

});