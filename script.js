var app = angular.module('MozzarellaManiac', [ 'ngRoute' ]);
app.config(function($routeProvider) {
    $routeProvider.when('/', {
        templateUrl : '/template/items.html',
    }).when('/item/:id', {
        templateUrl: '/template/item.html',
    }).when('/order', {
        templateUrl: '/template/order.html',
    });
});

app.controller('ItemController', function($scope, $http, $routeParams) {
    $scope.pizzaItem = {
        id : 1,
        name : "Sonkás",
        price : 900,
        topping_name : "paradicsom",
        image : "image/pizza.jpg"};
        $http.get('/api/item?id=' + $routeParams.id).success(
            function(data, status, headers, config) {
                //$scope.pizzaItem = data;
                //data;
            }).error(function (data, status, headers, config) {
                $scope.itemError = {
                    error : "Hiba történt a kapcsolódás során. Próbálja újra később."
                };
            });

});

app.controller('ItemsController', function($scope, $http) {
    $scope.pizzaItems = [{
        id : 3,
        name : "Sonkás",
        price : 900,
        topping_name : "pizzaszósz, sonka, sajt",
        image : "/image/pizza.jpg"},
        {
            id : 1,
            name : "Sonkás",
            price : 900,
            topping_name : "pizzaszósz, sonka, sajt",
            image : "/image/pizza.jpg"},
        {
            id : 2,
            name : "Sonkás",
            price : 900,
            topping_name : "pizzaszósz, sonka, sajt",
            image : "/image/pizza.jpg"}];
    $http.get('/api/items').success(function(data, status, headers, config) {
        $scope.pizzaItems = data;
    }).error(function(data, status, headers, config) {
        $scope.itemsError = { error : "Hiba történt a kapcsolódás során. Próbálja újra később." };
    });
});

app.controller('OrderController', function($scope, $http) {
    $http.get('/api/order').success(function(data, status, headers, config) {
        $scope.pizzaOrder = data;
        }).error(function(data, status, headers, config) {
            $scope.orderError = {
                error : "Hiba történt a kapcsolódás során. Próbálja újra később."
            };
    });

});