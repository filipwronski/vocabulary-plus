<!doctype html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/codecademy-content/projects/bootstrap.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400&subset=latin-ext" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.2.28/angular-route.min.js"></script>

        <title>Vocabulary+</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">

    </head>
    <body ng-app="EnglishApp">
        <div class="menuWrapper">
            <div class="container">
                <nav class="navbar navbar-default">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#/">Vocabulary+</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="mailto:filip0822@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                            <li><a href="//www.facebook.com/filip.wu.39" rel="nofollow" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                            <li><a href="//github.com/filipwronski" rel="nofollow" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a></li>
                            <li><a href="//instagram.com/filipwuuu/" rel="nofollow" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></i></a></li>    
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="particleJs">
            
        </div>
        <div class="ngWrapper" ng-view></div>
        <script src="vendor/particles.js/particles.min.js"></script>
        <script src="js/app.js"></script>

        <script src="js/controllers/HomeController.js"></script>
        <script src="js/controllers/LessonController.js"></script>

        <script src="js/services/lessons.js"></script>

    </body>
</html>

