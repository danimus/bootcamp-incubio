
var app= angular.module('mediatweet', ['ngResource','ngRoute','angular-growl','ngAnimate']);

app.config(['growlProvider', function(growlProvider) {
    growlProvider.globalTimeToLive(5000);
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

angular.module( 'mediatweet' ).controller('RegisterController',function($scope, $http, growl){

	$scope.registerSubmit = function (){
		$http.post('api/v1/user/register', $scope.user).
			success(function(data) {
				$success=data.header.success
				$message=data.header.msg
				if($success=="yes"){
					growl.success($message,{title: 'Success message'});
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

angular.module('mediatweet').factory('Login',function($http){
	return{
		auth:function(credentials){
			var authUser = $http({method:'POST',url:'api/v1/user/login',params:credentials});
			return authUser;
		}
	}
});



// Recoger peticion API (prueba Ruben)
angular.module( 'mediatweet' ).controller('RememberPasswordController',['$scope', '$http', 'growl', 
	function($scope, $http, growl){
	$scope.rememberPassword = function(){
		$http.post('api/v1/user/remember-password', $scope.email).
			success(function(data) {
				console.log(data);
				growl.error(data.header.msg,{title: 'Error message'});
			}).
			error(function(data) {
				alert(data);
			});
		
	}
}]);
