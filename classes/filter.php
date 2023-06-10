<?php

class Filter{
    private $conn;

    public function __construct($value){
        $this->conn = $value;
    }

    public function sanitizeString($value, $filterType){
        $this->conn = filter_var($value,  $filterType);
        return $this->conn;
    }

    public function regexCheck($value){
        $this->conn = filter_var($value, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^(public|private)$/")));
        return $this->conn;
    }
}
?>