<?php

class Database
{
    private $_server = 'mysql:host=172.20.0.2;dbname=camagru';
    private $_user = 'root';
    private $_password = 'root';
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    protected $conn;
    public function openConnection()
    {
        try {
            $this->conn = new PDO($this->_server, $this->_user, $this->_password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }
    public function closeConnection()
    {
        $this->conn = null;
    }
}