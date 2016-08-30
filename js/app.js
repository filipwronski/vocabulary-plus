var app = angular.module('EnglishApp', ['ngRoute']);


app.config(function ($routeProvider) {
    $routeProvider
            .when('/', {
                controller: "HomeController",
                templateUrl: "views/home.html"
            })
            .when('/:id', {
                controller: "LessonController",
                templateUrl: "views/lesson.html"
            })
            .otherwise({
                redirectTo: '/'
            });
});


