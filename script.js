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
    $scope.pizzaItem = [{
            pizza : "Sonkás",
            imageSource : "image/pizza.jpg"},
        {
            pizza : "Sonkás",
            imageSource : "image/pizza.jpg"},
        {
            pizza : "Sonkás",
            imageSource : "image/pizza.jpg"}];//data;
        $http.get('/api/item?id' + $routeParams.id, $scope.credentials).success(
            function(data, status, headers, config) {
                //$scope.pizzaItem = data;
            }).error(function (data, status, headers, config) {
                $scope.itemError = {
                    error : "Hiba történt a kapcsolódás során. Próbálja újra később."
                };
            });

});

app.controller('ItemsController', function($scope, $http) {
    $scope.pizzaItems = [{
        name : "Sonkás",
        ingredients : "pizzaszósz, sonka, sajt",
        image : "/image/pizza.jpg"},
        {
            name : "Sonkás",
            ingredients : "pizzaszósz, sonka, sajt",
            image : "/image/pizza.jpg"},
        {
            name : "Sonkás",
            ingredients : "pizzaszósz, sonka, sajt",
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