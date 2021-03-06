var app = angular.module('mediatweet', ['ngResource', 'ngRoute', 'angular-growl', 'ngAnimate', 'ngTagsInput'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.config(['growlProvider', function(growlProvider) {
    growlProvider.globalTimeToLive(3000);
    growlProvider.globalPosition('top-right');
}]);

angular.module('mediatweet').config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'templates/index.html',
        })
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
            controller: 'LoginController'
        })
        .when('/restore', {
            templateUrl: 'templates/restore_password.html',
            controller: 'RestoreController'
        })
        .when('/user-confirmation', {
            templateUrl: 'templates/confirmation.html',
            controller: 'ConfirmationController'
        })

   		.when('/tags', {
            templateUrl: 'templates/tags.html',
            controller: 'TagsInputController'
        })
        .when('/statistics', {
            templateUrl: 'templates/graph.html',
            controller: 'StatisticsController'
        })
        .otherwise({
            redirectTo: '/'
        });
});


/*    controllers     */
app.controller('StatisticsController', ['$scope', '$http', '$location', function($scope, $http, $location) {


}]);


app.controller('HomeController', ['$scope', '$http', '$location', function($scope, $http, $location) {
    $http.get('api/v1/user/nameuser').
    success(function(data) {
        $scope.name = data;
        console.log(data);
    });
    $scope.aboutUs = function() {
        $location.path('/about-us').replace();
    };

}]);

app.controller('ConfirmationController', ['$scope', '$http', 'growl', '$routeParams', '$location', function($scope, $http, growl, $routeParams, $location) {
    $scope.confirmationUser = function() {
        $http.get('api/v1/user/confirmateemail/?token=' + $routeParams.token).
        success(function(data) {
            if (data.header.success == "yes") {
                growl.success(data.header.msg, {
                    title: 'Success message',
                    onclose: function() {
                        $location.path('/login').replace();
                    }
                });

            } else if (data.header.success == "no") {
                growl.error(data.header.msg, {
                    title: 'Error message'
                });
            }
        }).error(function(data) {
            growl.info('Error connection, please try again', {
                title: 'Error message'
            });
        });
    }
}]);

app.controller('LoginController', ['$scope', '$http', 'growl', '$location', function($scope, $http, growl, $location) {

    $scope.forgetPassword = function() {
        $location.path('/remember').replace();
    }
    $scope.loginSubmit = function() {
        $http.post('api/v1/user/login', $scope.user).
        success(function(data) {
            $success = data.header.success;
            $message = data.header.msg;
            if ($success == "yes") {
                growl.success($message, {
                    title: 'Success message',
                    onclose: function() {
                        document.location.href = "http://bootcamp.incubio.com:8080/postlogin";
                    }
                });
            } else {
                growl.error($message, {
                    title: 'Error message'
                });

            }
        }).error(function(data) {
            alert(data);
        });
    }
}]);

app.controller('RegisterController', function($scope, $http, growl, $location) {
    $scope.registerSubmit = function() {
        $http.post('api/v1/user/register', $scope.user).
        success(function(data) {
            $success = data.header.success;
            $message = data.header.msg;
            if ($success == "yes") {
                growl.success($message, {
                    title: 'Success message'
                });

                growl.success("Check your mailbox to activate your account ", {
                    title: 'Success message',
                    onclose: function() {
                        $location.path('/login').replace();
                    }
                });
            } else {
                growl.error($message, {
                    title: 'Error message'
                });

            }
            console.log(data.header.msg);
        }).error(function(data) {
            alert(data);
        });
    }
});

app.controller('RememberPasswordController', ['$scope', '$http', 'growl', function($scope, $http, growl) {
    $scope.rememberPassword = function() {
        $http.post('api/v1/user/remember-password', {
            email: $scope.email
        }).
        success(function(data) {
            if (data.header.success == "yes") {
                growl.success(data.header.msg, {
                    title: 'Success message'
                });
            } else if (data.header.success == "no") {
                growl.error(data.header.msg, {
                    title: 'Error message'
                });
            }
        }).error(function(data) {
            growl.info('Error connection, please try again', {
                title: 'Error message'
            });
        });
    }
}]);


app.controller('RestoreController', ['$scope', '$http', 'growl', '$routeParams', '$location', function($scope, $http, growl, $routeParams, $location) {
    $scope.resetSumit = function() {
        $http.post('api/v1/user/reset-password', {
            token: $routeParams.token,
            password: $scope.password,
            passwordconfirmation: $scope.confirmPassword
        }).
        success(function(data) {
            if (data.header.success == "yes") {
                growl.success(data.header.msg, {
                    title: 'Success message',
                    onclose: function() {
                        $location.path('/login').replace();
                    }
                });

            } else if (data.header.success == "no") {
                growl.error(data.header.msg, {
                    title: 'Error message'
                });
            }
        }).error(function(data) {
            growl.info('Error connection, please try again', {
                title: 'Error message'
            });
        });
    }
}]);


app.controller('TagsInputController', function($scope, $http) {

    $scope.ApiResultGetTags = [];


    $http.get('/api/v1/tags/get-tags-user').
    success(function(data) {
        for (var i = 0; i < data.body[0].length; i++) {
            $scope.ApiResultGetTags[i] = angular.fromJson(data.body[0][i])[0];

        };

    });
    $scope.AddTagFunction = function($tag) {

        $http.post('/api/v1/tags/add', {
            tagname: $tag.tagname
        }).
        success(function(data) {

        });
    }; // Finaliza la funcion AddTagFunction


    $scope.RemoveTagFunction = function($tag) {

        $http.post('/api/v1/tags/delete', {
            tagname: $tag.tagname
        }).
        success(function(data) {
            console.log(data);
        });
    }; // Finaliza la funcion AddTagFunction

});