app.controller('LessonController', ['$scope', 'lessons', '$routeParams', function ($scope, lessons, $routeParams) {
        lessons.success(function (data) {
            $scope.single = data[$routeParams.id];
            var questionsArray = [];
            var wordsList = $scope.single.words_list;
            var index = 0;
            var quizObj= {};
            var quizArray = [];
            
            function removeCurrElem(index, array){
                array = array.splice( index, 1 );
                return array;
            }
            
            function randomNoRepeats(array) {
                let copy = array.slice(0);
                 if (copy.length < 1) { copy = array.slice(0); }
                 let index = Math.floor(Math.random() * copy.length);
                 let item = copy[index];
                 copy.splice(index, 1);
                 return item;
            }
            
            function shuffle(a) {
                var j, x, i;
                for (i = a.length; i; i--) {
                    j = Math.floor(Math.random() * i);
                    x = a[i - 1];
                    a[i - 1] = a[j];
                    a[j] = x;
                }
            }

            function getRandomArrayElements(numberOfElements, array){
                let randomsArray = [];
                for(let i = 0; i<numberOfElements; i++){
                    randomItem = randomNoRepeats(array)
                    randomsArray.push(randomItem);
                }
                return randomsArray;
            }
            
            function getQuizArray(){
                for(let word of wordsList){
                let tempArray = wordsList.slice();
                let randomArray = [];
                removeCurrElem(index, tempArray); //create copy of array and remove current element
                randomArray = getRandomArrayElements(3, tempArray);
                randomArray.push(word);
                shuffle(randomArray);
                quizObj={answer: word, randomArray: randomArray};
                quizArray[index]=quizObj;
                index++;
                }
                return quizArray;
            }
            $scope.quizArray = getQuizArray();
            console.log($scope.quizArray);
        });
    }]);