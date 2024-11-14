<?php

class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "Donna*103";
    private $data_base = "dwdemo";
    private $type_database = "mysql";
    private $charset = "utf8mb4";

    public function __construct($host = "localhost", $user = "root", $pass = "Donna*103", $data_base = "dwdemo", $type_database = "mysql", $charset = "utf8mb4") {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->data_base = $data_base;
        $this->type_database = $type_database;
        $this->charset = $charset;
    }

    public function getUrlConnection()
    {
        return $this->type_database . ":host=" . $this->host . ";dbname=" . $this->data_base . ";charset=" . $this->charset;
    }

    public function getUser(){
        return $this->user;
    }

    public function getPass(){
        return $this->pass;
    }

    public function getDatabaseName(){
        return $this->data_base;
    }

    public function getHost(){
        return $this->host;
    }
    
    public function getCharset(){
        return $this->charset;
    }
    public function getType_database(){
        return $this->type_database;
    }
}

?>