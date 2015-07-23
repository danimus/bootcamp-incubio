var app= angular.module('mediatweet', ['ngResource','ngRoute','angular-growl','ngAnimate','ngTagsInput',
	'n3-charts.linechart'],function($interpolateProvider) {
       $interpolateProvider.startSymbol('<%');
       $interpolateProvider.endSymbol('%>');});

app.config(['growlProvider', function(growlProvider) {
	growlProvider.globalTimeToLive(3000);
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
	.when('/about-us', {
		templateUrl: 'templates/about_us.html',
		controller: 'HomeController'
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

	.when('/tags', {
		templateUrl: 'templates/tags.html',
		controller:'TagsInputController'
	})
	.when('/statistics', {
		templateUrl: 'templates/d3jsexample.html',
		controller:'StatisticsController'
	})
	.otherwise({
		redirectTo: '/login'
	});
});


/*    controllers     */

app.controller('StatisticsController', function($scope){
        /*$http.get('/api/v1/statistics/global-trends').
                success(function(data) {
                        $scope.data = data;
                }
    );  */  
 		$scope.data=[
 
{
 
    "key_as_string": "2015-07-23T10:56:00.000Z",
    "key": 1437648960000,
    "doc_count": 21
 
},
{
 
    "key_as_string": "2015-07-23T10:57:00.000Z",
    "key": 1437649020000,
    "doc_count": 102
 
},
{
 
    "key_as_string": "2015-07-23T10:58:00.000Z",
    "key": 1437649080000,
    "doc_count": 1538
 
},
{
 
    "key_as_string": "2015-07-23T10:59:00.000Z",
    "key": 1437649140000,
    "doc_count": 2750
 
},
{
 
    "key_as_string": "2015-07-23T11:00:00.000Z",
    "key": 1437649200000,
    "doc_count": 2839
 
},
{
 
    "key_as_string": "2015-07-23T11:01:00.000Z",
    "key": 1437649260000,
    "doc_count": 2843
 
},
{
 
    "key_as_string": "2015-07-23T11:02:00.000Z",
    "key": 1437649320000,
    "doc_count": 1227
 
},
{
 
    "key_as_string": "2015-07-23T11:03:00.000Z",
    "key": 1437649380000,
    "doc_count": 538
 
},
{
 
    "key_as_string": "2015-07-23T11:04:00.000Z",
    "key": 1437649440000,
    "doc_count": 2675
 
},
{
 
    "key_as_string": "2015-07-23T11:05:00.000Z",
    "key": 1437649500000,
    "doc_count": 2652
 
},
{
 
    "key_as_string": "2015-07-23T11:06:00.000Z",
    "key": 1437649560000,
    "doc_count": 2624
 
},
{
 
    "key_as_string": "2015-07-23T11:07:00.000Z",
    "key": 1437649620000,
    "doc_count": 2602
 
},
{
 
    "key_as_string": "2015-07-23T11:08:00.000Z",
    "key": 1437649680000,
    "doc_count": 2635
 
},
{
 
    "key_as_string": "2015-07-23T11:09:00.000Z",
    "key": 1437649740000,
    "doc_count": 2668
 
},
{
 
    "key_as_string": "2015-07-23T11:10:00.000Z",
    "key": 1437649800000,
    "doc_count": 2553
 
},
{
 
    "key_as_string": "2015-07-23T11:11:00.000Z",
    "key": 1437649860000,
    "doc_count": 2655
 
},
{
 
    "key_as_string": "2015-07-23T11:12:00.000Z",
    "key": 1437649920000,
    "doc_count": 2640
 
},
{
 
    "key_as_string": "2015-07-23T11:13:00.000Z",
    "key": 1437649980000,
    "doc_count": 2308
 
},
{
 
    "key_as_string": "2015-07-23T11:14:00.000Z",
    "key": 1437650040000,
    "doc_count": 2624
 
},
{
 
    "key_as_string": "2015-07-23T11:15:00.000Z",
    "key": 1437650100000,
    "doc_count": 2646
 
},
{
 
    "key_as_string": "2015-07-23T11:16:00.000Z",
    "key": 1437650160000,
    "doc_count": 2696
 
},
{
 
    "key_as_string": "2015-07-23T11:17:00.000Z",
    "key": 1437650220000,
    "doc_count": 2641
 
},
{
 
    "key_as_string": "2015-07-23T11:18:00.000Z",
    "key": 1437650280000,
    "doc_count": 1989
 
},
{
 
    "key_as_string": "2015-07-23T11:19:00.000Z",
    "key": 1437650340000,
    "doc_count": 88
 
},
{
 
    "key_as_string": "2015-07-23T11:20:00.000Z",
    "key": 1437650400000,
    "doc_count": 39
 
},
{
 
    "key_as_string": "2015-07-23T11:23:00.000Z",
    "key": 1437650580000,
    "doc_count": 441
 
},
{
 
    "key_as_string": "2015-07-23T11:24:00.000Z",
    "key": 1437650640000,
    "doc_count": 2509
 
},
{
 
    "key_as_string": "2015-07-23T11:25:00.000Z",
    "key": 1437650700000,
    "doc_count": 1109
 
},
 
    {
        "key_as_string": "2015-07-23T14:16:00.000Z",
        "key": 1437660960000,
        "doc_count": 28
    }
 
];
        $scope.options = {
                axes: {
                        x: {
                                type: 'date',
                                key: "key"
                        }
        },
        series: [
        {
                y: "doc_count",
                label: "A time series",
                color: "#9467bd"
        }
        ],
        tooltip: {
                mode: "scrubber"
        }
        };
        $scope.data.forEach(function(row) {
                row.x = new Date(row.x);
        });
});




app.controller('HomeController',['$scope', '$http','$location', function($scope, $http, $location){
	$http.get('api/v1/user/nameuser').
	success(function(data) {
		$scope.name=data;
		console.log(data);
	});
	$scope.aboutUs= function(){
		$location.path('/about-us').replace();
	};

}]);

app.controller('ConfirmationController',['$scope','$http', 'growl', '$routeParams','$location' , function($scope, $http, growl,$routeParams,$location){
	$scope.confirmationUser = function(){
		$http.get('api/v1/user/confirmateemail/?token=' + $routeParams.token).
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
						document.location.href = "http://bootcamp.incubio.com:8080/postlogin";
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
				growl.success($message,{title: 'Success message'
			});

				growl.success("Check your mailbox to activate your account " ,{title: 'Success message',
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


app.controller('TagsInputController',function($scope,$http){

	$scope.ApiResultGetTags=[];


	$http.get('/api/v1/tags/get-tags-user').
	success(function(data) {
		for (var i = 0; i < data.body[0].length; i++) {
			$scope.ApiResultGetTags[i]=angular.fromJson(data.body[0][i])[0];

		};

	});
	$scope.AddTagFunction=function($tag){

		$http.post('/api/v1/tags/add', {tagname: $tag.tagname}).
		success(function(data) {

		});    
  };// Finaliza la funcion AddTagFunction


  $scope.RemoveTagFunction=function($tag){

  	$http.post('/api/v1/tags/delete', {tagname: $tag.tagname}).
  	success(function(data) {
  		console.log(data);
  	});    
  };// Finaliza la funcion AddTagFunction

});

