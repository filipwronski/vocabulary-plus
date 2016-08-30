app.factory('lessons', ['$http', function($http){
   return $http.get('json.php')
           .success(function(data){
               return data;
       
           })
           .error(function(data){
               return data;
           });
}]);
