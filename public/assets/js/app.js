
var app= angular.module('mediatweet', ['ngResource','ngRoute','angular-growl','ngAnimate']);

app.config(['growlProvider', function(growlProvider) {
    growlProvider.globalTimeToLive(2000);
    growlProvider.globalPosition('top-right');
}]);

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
	.when('/remember', {
		templateUrl: 'templates/remember_password.html',
		controller: 'RememberPasswordController'
	})
	.when('/login', {
		templateUrl: 'templates/login.html',
		controller:'LoginController'
	})
	.when('/restore', {
		templateUrl: 'templates/restore_password.html',
		controller:'RestoreController'
	})
    .otherwise({
            redirectTo: '/login'
    });
});


/*    controllers     */

app.controller('HomeController',function(){

});

app.controller('LoginController',['$scope', '$http', 'growl', '$location', '$timeout', function($scope, $http, growl, $location, $timeout){
	$scope.forgetPassword = function(){
		$location.path('/remember').replace();
	}
	$scope.loginSubmit = function(){
		$http.post('api/v1/user/login', $scope.user).
			success(function(data) {
				$success=data.header.success;
				$message=data.header.msg;
				if($success=="yes"){
					growl.success($message,{title: 'Success message'});
					$timeout(function(){$location.path('/home').replace();},2000);
				}else{
					growl.error($message,{title: 'Error message'});

				}
		}).
		error(function(data) {
			alert(data);
		});
	}
}]);

app.controller('RegisterController',function($scope, $http, growl,$location,$timeout){
	$scope.registerSubmit = function (){
		$http.post('api/v1/user/register', $scope.user).
			success(function(data) {
				$success=data.header.success;
				$message=data.header.msg;
				if($success=="yes"){
					growl.success($message,{title: 'Success message'});
					$timeout(function(){$location.path('/login').replace();},2000);	
				}else{
					growl.error($message,{title: 'Error message'});

				}
				console.log(data.header.msg);
		}).
		error(function(data) {
			alert(data);
		});
	}
	});

/*   factory    */
/*
app.factory('Login',function($http){
	return{
		auth:function(credentials){
			var authUser = $http({method:'POST',url:'api/v1/user/login',params:credentials});
			return authUser;
		}
	}
});*/

app.controller('RememberPasswordController',['$scope', '$http', 'growl', function($scope, $http, growl){
	$scope.rememberPassword = function(){
		$http.post('api/v1/user/remember-password', {email:$scope.email}).
			success(function(data) {
				if(data.header.success == "yes"){
					growl.success(data.header.msg,{title: 'Success message!'});
				}else if(data.header.success == "no"){
					growl.error(data.header.msg,{title: 'Error message'});
				}
				growl.error(data.header.msg,{title: 'Error message'});
			}).error(function(data) {
				growl.info('Error connection, please try again',{title: 'Error message'});
			});
	}
}]);


app.controller('RestoreController',['$scope', '$http', 'growl', function($scope, $http, growl){
	$scope.rememberPassword = function(){
		$http.post('api/v1/user/reset-password', {password:$scope.password, confirmPassword: $scope.confirmPassword}).
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
