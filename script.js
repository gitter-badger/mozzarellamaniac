var app = angular.module('MozzarellaManiac', [ 'ngRoute' ]);
app.config(function($routeProvider) {
    $routeProvider.when('/', {
        templateUrl : '/template/items.html',
    }).when('/items/:id', {
        templateUrl: '/template/item.html',
    }).when('/order', {
        templateUrl: '/template/order.html',
    });
});

app.controller('ItemController', function($scope, $http, $routeParams) {
    $scope.login = function() {
        $http.get('/api/item?id' + $routeParams.id, $scope.credentials).success(
            function(data, status, headers, config) {
            }).error(function (data, status, headers, config) {

            });
    };

});

app.controller('ItemsController', function($scope, $http) {
    $http.get('/api/items').success(function(data, status, headers, config) {
        $scope.pizzaItem = data;
    }).error(function(data, status, headers, config) {
        $scope.grade = {"error":"Hiba történt a kapcsolódás során. Próbálja újra később."};
    });
});

app.controller('OrderController', function($scope, $http) {
    $http.get('/api/order').success(function(data, status, headers, config) {
        $scope.pizzaOrder = data;
        }).error(function(data, status, headers, config) {
            $scope.personal = {"error":"Hiba történt a kapcsolódás során. Próbálja újra később."};
    });

});