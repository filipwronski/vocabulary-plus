<!doctype html>
<html>
    <head>
        <link href="https://s3.amazonaws.com/codecademy-content/projects/bootstrap.min.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300' rel='stylesheet' type='text/css'>
        <link href="css/main.css" rel="stylesheet" />

        <!-- Include the core AngularJS library -->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.2.28/angular-route.min.js"></script>
    </head>
    <body ng-app="EnglishApp">

        <div ng-view></div>

        <!-- Modules -->
        <script src="js/app.js"></script>

        <!-- Controllers -->
        <script src="js/controllers/HomeController.js"></script>
        <script src="js/controllers/LessonController.js"></script>

        <!-- Services -->
        <script src="js/services/lessons.js"></script>
    </body>
</html>
