var app= angular.module('mediatweet', ['ngResource','ngRoute','angular-growl','ngAnimate','ngTagsInput']);

app.config(['growlProvider', function(growlProvider) {
    growlProvider.globalTimeToLive(2000);
    growlProvider.globalPosition('top-right');
}]); 

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
  .when('/remember', {
    templateUrl: 'templates/remember_password.html',
    controller: 'RememberPasswordController'
  })
  .when('/login', {
    templateUrl: 'templates/login.html',
    controller:'LoginController'
  })
  .when('/tags', {
    templateUrl: 'templates/tags.html',
    controller:'TagsInputController'
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

app.controller('RegisterController',function($scope, $http, growl,$location,$timeout){

  $scope.registerSubmit = function (){
    $http.post('api/v1/user/register', $scope.user).
      success(function(data) {
        $success=data.header.success
        $message=data.header.msg
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

app.factory('Login',function($http){
  return{
    auth:function(credentials){
      var authUser = $http({method:'POST',url:'api/v1/user/login',params:credentials});
      return authUser;
    }
  }
});

app.controller('RememberPasswordController',['$scope', '$http', 'growl', function($scope, $http, growl){
  $scope.rememberPassword = function(){
    $http.post('api/v1/user/remember-password', {email:$scope.email}).
      success(function(data) {
        if(data.header.success == "yes"){
          growl.success(data.header.msg,{title: 'Success message!'});
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