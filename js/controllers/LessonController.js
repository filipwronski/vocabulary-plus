app.controller('LessonController', function ($scope, lessons, $routeParams,  $http) {
        
        
        var vm = this;
            $scope.result = [10, 20];
            $scope.label = ["label","label"];
        lessons.success(function (data) {
            vm.single = data[$routeParams.id];
            vm.wordsList = vm.single.words_list;
            vm.quizObj= {};
            vm.quizArray = [];
            vm.questionNumber = 0;
            vm.setActiveQuestion = setActiveQuestion;
            vm.selectQuestionAnswer = selectQuestionAnswer;
            vm.nextQuestion = nextQuestion;
            vm.previousQuestion = previousQuestion;
            vm.answersArray = [];
            vm.getQuizResult = getQuizResult;
            vm.resetQuiz = resetQuiz;
            vm.result = 0;
            vm.isFinished = false;
            $scope.saveResult = saveResult;
            
            
           
            
            
            function removeCurrElem(index, array){
                array = array.splice( index, 1 );
                return array;
            }
            
            
            function saveResult(id, result, date) {
                
            }
            
            function randomNoRepeats(array) {
                let index = 0;
                let copy = array.slice(0);
                 if (copy.length < 1) { copy = array.slice(0); }
                 index = Math.floor(Math.random() * copy.length);
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
                let index = 0;
                for(let word of vm.wordsList){
                tempArray = vm.wordsList.slice();
                randomArray = [];
                removeCurrElem(index, tempArray); //create copy of array and remove current element
                randomArray = getRandomArrayElements(3, tempArray);
                randomArray.push(word);
                shuffle(randomArray);
                vm.quizObj = {answer: word, randomArray: randomArray};
                vm.quizArray[index]=vm.quizObj;
                index++;
                }
                console.log(vm.quizArray);
                return vm.quizArray;
            }
            
            function setActiveQuestion(index){
                vm.questionNumber = index;
            }
            
            function nextQuestion(){
                 console.log(vm.questionNumber);
                if(vm.questionNumber+1 < vm.quizArray.length){
                    vm.questionNumber++;
                }else{
                    vm.questionNumber=0;
                }
            }
            
            function previousQuestion(){
                console.log(vm.questionNumber);
                if(vm.questionNumber <= vm.quizArray.length && vm.questionNumber > 0){
                    vm.questionNumber--;
                }else{
                    vm.questionNumber = vm.quizArray.length-1;
                }
            }
            
            function selectQuestionAnswer(quizObject, text, index, questionIndex){
                vm.quizArray[vm.questionNumber].selected = questionIndex;
                if(quizObject.answer.word == text.word){
                    vm.answersArray[index] = {value: 1, translation: quizObject.answer.translation, answer: quizObject.answer.word, correctAnswer: text.word};
                }else{
                    vm.answersArray[index] = {value: 0, translation: quizObject.answer.translation, correctAnswer: quizObject.answer.word, answer: text.word};
                }
                console.log(vm.answersArray);
            }
            
            
            function getQuizResult(){
                
                vm.result = 0;
                for(let i= 0; i<vm.answersArray.length; i++){
                    if(vm.answersArray[i] !== undefined){
                        if(vm.answersArray[i].value === 1){
                            vm.result++;
                        }
                    }
                }
                vm.result = (vm.result/vm.quizArray.length)*100;
                data[$routeParams.id].last_score = vm.result;
                data[$routeParams.id].last_trening = getCurrentDate();
                console.log(data[$routeParams.id]);
                vm.isFinished = true;
                saveResult($routeParams.id, vm.result, getCurrentDate());
                return vm.result;
            }
            
            function getCurrentDate(){
                dateTime = new Date();
                return dateTime;
            }
            
            function resetQuiz(){
                vm.answersArray = [];
            }
                        
                        
            vm.quizArray = getQuizArray();
            console.log(vm.quizArray);
            console.log(data[$routeParams.id]);
            
        });
    });