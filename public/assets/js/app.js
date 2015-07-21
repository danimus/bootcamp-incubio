
angular.module('mediatweet', ['ngResource','ngRoute','angular-growl','ngAnimate']);

angular.module('mediatweet').config(function($routeProvider) {
	$routeProvider
	.when('/home', {
		templateUrl: 'templates/home.html',
		controller: 'HomeController'
	})
	.when('/register', {
		templateUrl: 'templates/register.html',
		controller: 'RegisterController'
	})
	.when('/login', {
		templateUrl: 'templates/login.html',
		controller:'LoginController'
	})
	.when('/remember', {
		templateUrl: 'templates/remember.html',
		controller:'RememberController'
	})
    .otherwise({
            redirectTo: '/login'
    });
});

angular.module( 'mediatweet' ).controller('LoginController',function($scope,Login){
	$scope.loginSubmit = function(){
		var auth = Login.auth($scope.loginData);
		console.log($scope.loginData);
		auth.success(function(response){
			console.log(response);			
		});
	}
});

angular.module( 'mediatweet' ).controller('RegisterController',function($scope,Login){
	$scope.loginSubmit = function(){
		var auth = Login.auth($scope.loginData);
		console.log($scope.loginData);
		auth.success(function(response){
			console.log(response);
		});
	}
});

angular.module('mediatweet').factory('Login',function($http){
	return{
		auth:function(credentials){
			var authUser = $http({method:'POST',url:'api/v1/user/login',params:credentials});
			return authUser;
		}
	}
});


// Recoger peticion API (prueba Ruben)
angular.module( 'mediatweet' ).controller('RememberController',['$scope', 'growl', function($scope,$http,growl){
	$scope.rememberPassword = function(){
		/*$http.post('api/v1/user/remember-password', {msg:'hello word!'}).
			success(function(data) {
				console.log(data);
			}).
			error(function(data) {
				alert(data);
			});*/
		growl.error('This is a warning mesage.',{title: 'Warning!'});
	}
}]);

