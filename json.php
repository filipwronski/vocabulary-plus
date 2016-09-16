<?php
require 'requires.php';
?>
<?php
$wordsList = new Lesson();
header('Content-Type: application/json');
echo $wordsList->getLessonsJson();
?>