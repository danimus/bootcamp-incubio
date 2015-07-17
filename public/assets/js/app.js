
angular.module('mediatweet', [ 'ngResource','ngRoute' ]);

angular.module('mediatweet').config(function($routeProvider) {
    $routeProvider
        .when('/home', {
            templateUrl: 'templates/home.html',
            controller: 'StudentController'
        })
        .when('/viewStudents', {
            templateUrl: 'templates/viewStudents.html',
            controller: 'StudentController'
        })
        .otherwise({
            redirectTo: '/home'
        });
});

angular.module( 'mediatweet' ).factory(
	'ItemResource',
	[
		'$resource',
		function ( $resource ) {

			var resource = {};

			var item = $resource(  '/item', {}, {

				get : { method : 'GET', isArray : true }
			} );

			resource.items = [];

			resource.getItems = function() {

				item.get().$promise.then( function( data ){

					angular.copy( data, resource.items );

				} );
			};

			return resource;
		}
	]
);

angular.module( 'mediatweet' ).controller(
	'MainController',
	[
		'$scope',
		'ItemResource',
		function ( $scope, ItemResource ) {

			$scope.pulsado = true;

			$scope.fnAlert = function(){

				ItemResource.getItems();
			};


			$scope.items = ItemResource.items;


			ItemResource.getItems();

			//$scope.name = "Guillem";
		}
	]
);

angular.module( 'mediatweet' ).controller(
	'NameController',
	[
		'$scope',
		function ( $scope ) {

			//$scope.name = "Xavier";
		}
	]
);