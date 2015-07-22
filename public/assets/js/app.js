
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
	.when('/user-confirmation', {
		templateUrl: 'templates/confirmation.html',
		controller:'ConfirmationController'
	})
    .otherwise({
            redirectTo: '/login'
    });
});


/*    controllers     */

app.controller('HomeController',function(){
	
});

app.controller('ConfirmationController',['$scope','$http', 'growl', '$routeParams','$location' , function($scope, $http, growl,$routeParams,$location){
	/*$scope.confirmationUser = function(){
		$http.post('api/v1/user/confirmateemail/', {token:$routeParams.token}).
			success(function(data) {
				if(data.header.success == "yes"){
					growl.success(data.header.msg,{title: 'Success message',
						onclose: function(){ 
							$location.path('/login').replace();
						}
					});

				}else if(data.header.success == "no"){
					growl.error(data.header.msg,{title: 'Error message'});
				}
			}).error(function(data) {
				growl.info('Error connection, please try again',{title: 'Error message'});
			});
	}*/
}]);

app.controller('LoginController',['$scope', '$http', 'growl', '$location', function($scope, $http, growl, $location){
	$scope.forgetPassword = function(){
		$location.path('/remember').replace();
	}
	$scope.loginSubmit = function(){
		$http.post('api/v1/user/login', $scope.user).
			success(function(data) {
				$success=data.header.success;
				$message=data.header.msg;
				if($success=="yes"){
					growl.success($message,{
						title:'Success message',onclose: function(){ 
							$location.path('/home').replace();
						}
					});
				}else{
					growl.error($message,{title: 'Error message'});

				}
			}).error(function(data) {
				alert(data);
			});
		}
	}]);

app.controller('RegisterController',function($scope, $http, growl,$location){
	$scope.registerSubmit = function (){
		$http.post('api/v1/user/register', $scope.user).
			success(function(data) {
				$success=data.header.success;
				$message=data.header.msg;
				if($success=="yes"){
					growl.success($message,{title: 'Success message',
						onclose: function(){ 
							$location.path('/login').replace();
						}
					});
				}else{
					growl.error($message,{title: 'Error message'});

				}
				console.log(data.header.msg);
		}).error(function(data) {
			alert(data);
		});
	}
	});

app.controller('RememberPasswordController',['$scope', '$http', 'growl', function($scope, $http, growl){
	$scope.rememberPassword = function(){
		$http.post('api/v1/user/remember-password', {email:$scope.email}).
			success(function(data) {
				if(data.header.success == "yes"){
					growl.success(data.header.msg,{title: 'Success message'});
				}else if(data.header.success == "no"){
					growl.error(data.header.msg,{title: 'Error message'});
				}
			}).error(function(data) {
				growl.info('Error connection, please try again',{title: 'Error message'});
			});
	}
}]);


app.controller('RestoreController',['$scope','$http', 'growl', '$routeParams','$location' , function($scope, $http, growl,$routeParams,$location){
	$scope.resetSumit = function(){
		$http.post('api/v1/user/reset-password', {token:$routeParams.token,password:$scope.password,passwordconfirmation:$scope.confirmPassword}).
			success(function(data) {
				if(data.header.success == "yes"){
					growl.success(data.header.msg,{title: 'Success message',
						onclose: function(){ 
							$location.path('/login').replace();
						}
					});

				}else if(data.header.success == "no"){
					growl.error(data.header.msg,{title: 'Error message'});
				}
			}).error(function(data) {
				growl.info('Error connection, please try again',{title: 'Error message'});
			});
	}
}]);
