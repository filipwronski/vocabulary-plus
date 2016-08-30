<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["className"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["className"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        } else {
            $className = $_POST["className"];
        }
    }
    if (empty($_POST["website"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $name)) {
            $nameErr = "Only letters and white space allowed";
        } else {
            $websiteUrl = $_POST["website"];
        }
    }
    $vocabularyDoc = new Document();
    $document = $vocabularyDoc->getDocument($websiteUrl);
    $elements = $vocabularyDoc->getDocumentElements($document, $className);

    $vocabularyList = new WordsList();
    $vocabularyArray = $vocabularyList->createWordsArray($elements);
    $vocabularyJson = $vocabularyList->createWordsJson($vocabularyArray);

    $vocabularyList = new WordsList();
    $vocabularyList->insertWordsToDb($vocabularyArray);
} 




