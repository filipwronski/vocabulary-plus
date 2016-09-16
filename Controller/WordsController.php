<?php

require 'vendor/autoload.php';

use Stichoza\GoogleTranslate\TranslateClient;

class Document {

    public function getDocument($filePath) {

        $doc = new DOMDocument();
        @$doc->loadHTMLFile($filePath);
        return $doc;
    }

    public function getDocumentElements($doc, $className) {
        $xpath = new DOMXPath($doc);
        $elements = $xpath->query("//*[@class='" . $className . "']");
        return $elements;
    }

}

class WordsList {

    private $wordsArray;

    public function createWordsArray($elements) {
        $tr = new TranslateClient('en', 'pl');
        $elementsArray = [];
        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            foreach ($nodes as $node) {
                $elementsArray[] = ['english' => $node->nodeValue, 'polish' => $tr->translate($node->nodeValue)];
            }
        }
        return $elementsArray;
    }

    public function insertWordsToDb($vocabularyArray) {
        $conn = new Database();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {

            $values = [];
            foreach ($vocabularyArray as $rowValues) {
                foreach ($rowValues as $key => $rowValue) {
                    $rowValues[$key] = $rowValues[$key];
                }
                $values[] = "(null,'" . implode('\', \'', $rowValues) . "')";
            }
            $sql = "INSERT INTO words (id, word, translation)
            VALUES " . implode(', ', $values);

            $conn->exec($sql);
            echo "New recor"
            . ""
            . "d created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function fetchWordsArrayFromDb() {
        $this->wordsArray = [];
        $conn = new Database();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $conn->prepare("SELECT id, word, translation FROM words");
        $statement->execute();


        if ($statement->rowCount() > 0) {
            $this->wordsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->wordsArray;
        } else {
            return "No results.";
        }
    }

    public function displayAllWordsList() {
        $wordsArray = $this->fetchWordsArrayFromDb();
        foreach ($wordsArray as $words) {
            echo $words['id'] . '| ' . $words['word'] . ' - ' . $words['translation'] . '<br>';
        }
    }

    function getShuffledWordsList() {
        $list = $this->fetchWordsArrayFromDb();
        if (!is_array($list))
            return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $shuffledWordsList = array();
        foreach ($keys as $key) {
            $shuffledWordsList[$key] = $list[$key];
        }
        return $shuffledWordsList;
    }

    public function createWordsJson($vocabularyArray) {
        try {
            $vocabularyJson = json_encode($vocabularyArray, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $vocabularyJson;
    }

}

class Lesson {

    private $lessonsArray;

    public function splitVocabulary($wordsArray) {
        $splitedVocabulary = array_chunk($wordsArray, 30);

        return $splitedVocabulary;
    }

    public function prepareVocabulary() {
        $wordsList = new WordsList();
        $wordsArray = $wordsList->getShuffledWordsList();
        $splitedVocabulary = $this->splitVocabulary($wordsArray);

        return $splitedVocabulary;
    }

    public function insertLessonToDb() {
        $currentDate = getdate();
        $splitedVocabulary = $this->prepareVocabulary();
        $values = [];

        foreach ($splitedVocabulary as $worsdList) {
            $values[] = "(null, '" . serialize($worsdList) . "', Mon Sep 05 2016 16:05:31 GMT+0200 (CEST), 0)";
        }

        $conn = new Database();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO lessons (id, words_list, last_trening, last_score) VALUES " . implode(', ', $values);
        $statement = $conn->prepare($sql);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            echo 'Dodano: ' . $count . ' rekordow';
        } else {
            echo 'Wystapil blad podczas dodawania rekordow!';
        }
    }

    public function fetchLessonsFromDb() {
        $conn = new Database();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id, words_list, last_trening, last_score FROM lessons";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $lessonArray = [];
        if ($statement->rowCount() > 0) {
            while ($row = $statement->fetch()) {
                $lessonArray[]= [
                    'id' => $row['id'],
                    'words_list' => unserialize($row['words_list']),
                    'last_trening' => $row['last_trening'],
                    'last_score' => $row['last_score']
                ];
            }
            return $lessonArray;
        } else {
            return "No results.";
        }
    }

    public function getLessonsJson() {
        $lessonsArray = $this->fetchLessonsFromDb();
        $lessonsJson = json_encode($lessonsArray);
        return $lessonsJson;
    }

}

//https://www.vocabulary.com/lists/187041
//word dynamictext

