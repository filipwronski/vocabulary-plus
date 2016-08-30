<?php

class Database extends PDO {

    private $dbName = "english";
    private $dbUser = "root";
    private $dbPass = "toor";
    private $dbHost = "localhost";

    public function __construct() {
        parent::__construct("mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8", $this->dbUser, $this->dbPass);
    }

}

?>