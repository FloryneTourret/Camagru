<?php

require_once ('Database.php');

Class Model{

    public $db;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->openConnection();
    }
}


?>