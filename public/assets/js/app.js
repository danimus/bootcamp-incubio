
angular.module('mediatweet', [ 'ngResource','ngRoute']);

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
	.when('/remember-password', {
		templateUrl: 'templates/remember_password.html',
		controller: 'RememberPasswordController'
	})
	.when('/login', {
		templateUrl: 'templates/login.html',
		controller:'LoginController'
	})
    .otherwise({
            redirectTo: '/login'
    });
});


/*    controllers     */

angular.module( 'mediatweet' ).controller('LoginController',function($scope,Login,$location){
	$scope.loginSubmit = function(){
		var auth = Login.auth($scope.loginData);
		console.log($scope.loginData);
		auth.success(function(response){
			console.log(response);
			$location.path('/register').replace();			
		});
	}
});

angular.module( 'mediatweet' ).controller('RegisterController',function($scope, $http){

	$scope.registerSubmit = function (){
		/*var auth = Login.auth($scope.loginData);
		console.log($scope.loginData);
		auth.success(function(response){
			console.log(response);
		})*/

		$http.post('api/v1/user/register', $scope.user).
			success(function(data) {
				$error_message=data.header.msg
				console.log(data.header.msg);
		}).
		error(function(data) {
			alert(data);
		});
	}
	});

angular.module( 'mediatweet' ).controller('RememberPasswordController',function($scope){
	//
	}
);


/*   factory    */

angular.module('mediatweet').factory('Login',function($http){
	return{
		auth:function(credentials){
			var authUser = $http({method:'POST',url:'api/v1/user/login',params:credentials});
			return authUser;
		}
	}
});


