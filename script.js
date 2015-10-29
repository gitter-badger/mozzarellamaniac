var app = angular.module('MozzarellaManiac', [ 'ngRoute' ]);
app.config(function($routeProvider) {
    $routeProvider.when('/', {
        templateUrl : '/template/items.html',
    }).when('/item/:id', {
        templateUrl: '/template/item.html',
    }).when('/order', {
        templateUrl: '/template/order.html',
    }).when('/login', {
        templateUrl: '/template/login.html',
    }).when('/list', {
        templateUrl: '/template/list.html',
    }).when('/contact', {
        templateUrl: '/template/contact.html',
    });
});

app.controller('ItemController', function($scope, $http, $routeParams, $window) {
    $scope.pizzaItem = 0;
    $http.get('/api/item.php?id=' + $routeParams.id).success(
            function(data, status, headers, config) {
                $scope.pizzaItem = data;
            }).error(function (data, status, headers, config) {
                $scope.itemError = {
                    error : "Hiba történt a kapcsolódás során. Próbálja újra később."
                };
            });

        $scope.prepare = function() {
            $scope.order = {
                pizza_id : $scope.pizzaItem.pizza_id,
                pizza_name : $scope.pizzaItem.pizza_name,
                quantity : $scope.quantity
            };
            $http.post('/api/order.php', $scope.order).success(
                function (data, status, headers, config) {
                    $window.location.reload();
                }).error(function (data, status, headers, config) {
                });
        };

});

app.controller('ItemsController', function($scope, $http) {
    $http.get('/api/items.php').success(function(data, status, headers, config) {
        $scope.pizzaItems = data;
    }).error(function(data, status, headers, config) {
        $scope.itemsError = { error : "Hiba történt a kapcsolódás során. Próbálja újra később." };
    });
});

app.controller('OrderController', function($scope, $http) {
    $http.get('/api/order.php').success(function(data, status, headers, config) {
        $scope.pizzaOrder = data;
        }).error(function(data, status, headers, config) {
            $scope.orderError = {
                error : "Hiba történt a kapcsolódás során. Próbálja újra később."
            };
    });

});

// Admin page
app.controller('LoginController', function($scope, $http, $location) {
    $http.get('/api/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'true') {
            $location.path("/list");
        }
    }).error(function(data, status, headers, config) {

    });

        $scope.login = function () {
            $scope.credentials = {
                loginname: $scope.loginname,
                password: $scope.password
            };
            $http.post('/api/login.php', $scope.credentials).success(
                function (data, status, headers, config) {
                    $location.path("/list");
                }).error(function (data, status, headers, config) {
                    $location.path("/login");
                });
        };

});

app.controller('ListController', function($scope, $http, $location) {
    $http.get('/api/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/login");
        }
    }).error(function(data, status, headers, config) {

    });
    $http.get('/api/list.php').success(function(data, status, headers, config) {
        $scope.pizzaItems = data;
    }).error(function(data, status, headers, config) {
        $scope.itemsError = { error : "Hiba történt a kapcsolódás során. Próbálja újra később." };
    });
});

app.controller('PriceController', function($scope, $http) {
    $http.get('/api/summary.php').success(function(data, status, headers, config) {
        $scope.price = data;
    }).error(function(data, status, headers, config) {

    });
});