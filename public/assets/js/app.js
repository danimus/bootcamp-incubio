
var app = angular.module('mediatweet', ['ngResource','ngRoute','angular-growl','ngAnimate']);

app.config(function($routeProvider) {
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
	.when('/remember', {
		templateUrl: 'templates/remember_password.html',
		controller:'RememberController'
	})
    .otherwise({
            redirectTo: '/login'
    });
});


/*    controllers     */

app.controller('LoginController',function($scope,Login,$location){
	$scope.loginSubmit = function(){
		var auth = Login.auth($scope.loginData);
		console.log($scope.loginData);
		auth.success(function(response){
			console.log(response);
			$location.path('/register').replace();			
		});
	}
});

app.controller('RegisterController',function($scope, $http){

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

app.controller('RememberPasswordController',function($scope){
	//
	}
);


/*   factory    */

app.factory('Login',function($http){
	return{
		auth:function(credentials){
			var authUser = $http({method:'POST',url:'api/v1/user/login',params:credentials});
			return authUser;
		}
	}
});

app.controller('RememberController',['$scope', '$http', 'growl', function($scope, $http, growl){
	$scope.rememberPassword = function(){
		$http.post('api/v1/user/remember-password', {email:$scope.email}).
			success(function(data) {
				if(data.header.success == "yes"){
					growl.success(data.header.msg,{title: 'Success message!'});
				}else if(data.header.success == "no"){
					growl.error(data.header.msg,{title: 'Error message'});
				}
			}).
			error(function(data) {
				growl.info('Error connection, please try again',{title: 'Error message'});
			});
	}
}]);

