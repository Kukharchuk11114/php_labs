<?php

$host = 'localhost';
$db   = 'php';
$user = 'Illia';
$pass = 'Php2211.';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new \PDO($dsn, $user, $pass, $opt);
class Pdo_ {
    private $conn;

// get access to db
    public function __construct(\PDO $pdo){
        $this->conn = $pdo;
    }

    public function getUsers($sql){
        return $this->conn->query($sql)->fetchAll();
    }

    
// Dodac wiadomosc
    public function addMessage($name,$type,$content){
        var_dump($name, $type, $content);
        if(!$type)
            return false;
         $sql = "INSERT INTO message (`name`,`type`, `message`,`deleted`)
                VALUES ('" . $name . "','" . $type . "','" . $content . "',0)";
        echo $sql;
        echo "<br>";
        return $this->conn->query($sql);
    }
// Edytowac wiadomosc
     public function editMessage($name,$type,$content, $id){
         if(!$type){
            return false;
         }
        $sql = "UPDATE message SET name='".$name. "', type='" .$type. "', message='" .$content. "' WHERE id=" .$id. "";
        echo $sql;
        echo "<br>";
        return $this->conn->query($sql);
    }

     
}



?>