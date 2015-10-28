var app = angular.module('MozzarellaManiac', [ 'ngRoute' ]);
app.config(function($routeProvider) {
    $routeProvider.when('/', {
        templateUrl : '/template/admin/login.html',
    }).when('/listpizza/:id', {
        templateUrl: '/template/admin/listpizza.html',
    }).when('/listpizzas', {
        templateUrl: '/template/admin/listpizzas.html',
    }).when('/listtopping/:id', {
        templateUrl: '/template/admin/listtopping.html',
    }).when('/listtoppings', {
        templateUrl: '/template/admin/listtoppings.html',
    }).when('/newtopping', {
        templateUrl: '/template/admin/newtopping.html',
    }).when('/newpizza', {
        templateUrl: '/template/admin/newpizza.html',
    });
});


app.controller('LoginController', function($scope, $http, $location) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'true') {
            $location.path("/listpizzas");
        }
    }).error(function(data, status, headers, config) {});

    $scope.login = function () {
            $scope.credentials = {
                loginname: $scope.loginname,
                password: $scope.password
            };
            $http.post('/api/admin/login.php', $scope.credentials).success(
                function (data, status, headers, config) {
                    $location.path("/listpizzas");
                }).error(function (data, status, headers, config) {
                    $location.path("/");
                });
        };

});

app.controller('ListPizzasController', function($scope, $http, $location) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/");
        }
    }).error(function(data, status, headers, config) {

    });
    $http.get('/api/admin/listpizzas.php').success(function(data, status, headers, config) {
        $scope.pizzaItems = data;
    }).error(function(data, status, headers, config) {
        $scope.itemsError = { error : "Hiba történt a kapcsolódás során. Próbálja újra később." };
    });
});

app.controller('ListToppingsController', function($scope, $http, $location) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/");
        }
    }).error(function(data, status, headers, config) {

    });
    $http.get('/api/admin/listtoppings.php').success(function(data, status, headers, config) {
        $scope.toppingItems = data;
    }).error(function(data, status, headers, config) {
        $scope.itemsError = { error : "Hiba történt a kapcsolódás során. Próbálja újra később." };
    });
});

app.controller('ListPizzaController', function($scope, $http, $location, $routeParams) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/");
        }
    }).error(function(data, status, headers, config) {

    });
    $http.get('/api/admin/listpizza.php?id='+ $routeParams.id).success(function(data, status, headers, config) {
        //$scope.pizzaItem = data;
        $scope.pizza_id = data.pizza_id;
        $scope.pizza_name = data.pizza_name;
        $scope.price = data.price;
        $scope.image = data.image;
        $scope.visible = data.visible;
    }).error(function(data, status, headers, config) {
    });

    $scope.modifyPizza = function() {
        $scope.pizza = {
            pizza_id : $scope.pizza_id,
            pizza_name : $scope.pizza_name,
            price : $scope.price,
            image : $scope.image,
            visible : $scope.visible
        };
        $http.post('/api/admin/listpizza.php', $scope.pizza).success(
            function (data, status, headers, config) {

            }).error(function (data, status, headers, config) {

            });
    };
});

app.controller('ListToppingController', function($scope, $http, $location, $routeParams) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/");
        }
    }).error(function(data, status, headers, config) {

    });
    $http.get('/api/admin/listtopping.php?id=' + $routeParams.id).success(function(data, status, headers, config) {
        $scope.topping_id = data.topping_id;
        $scope.topping_name = data.topping_name;
    }).error(function(data, status, headers, config) {
        $scope.itemsError = { error : "Hiba történt a kapcsolódás során. Próbálja újra később." };
    });
});

app.controller('NewToppingController', function($scope, $http, $location) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/");
        }
    }).error(function(data, status, headers, config) {

    });
    $scope.saveTopping = function() {
        $scope.topping = {
            topping_name : $scope.topping_name
        };
        $http.post('/api/admin/newtopping.php', $scope.topping).success(
            function (data, status, headers, config) {
                //$location.path("/listpizza");
                alert('Sikeres mentés!');
                $scope.topping_name = "";
            }).error(function (data, status, headers, config) {
                $location.path("/");
            });
    };
});

app.controller('NewPizzaController', function($scope, $http, $location) {
    $http.get('/api/admin/logincheck.php').success(function(data, status, headers, config) {
        $scope.loginCheck = data;
        if ($scope.loginCheck.valid == 'false') {
            $location.path("/");
        }
    }).error(function(data, status, headers, config) {

    });

    $scope.savePizza = function() {
        $scope.pizza = {
            pizza_name : $scope.pizza_name,
            price : $scope.price
        };
        $http.post('/api/admin/newpizza.php', $scope.pizza).success(
            function (data, status, headers, config) {
                alert('Sikeres mentés!');
                $scope.pizza_name = "";
                $scope.price = "";
            }).error(function (data, status, headers, config) {

            });
    };
});

