<?php

class Sql extends PDO{

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
    }

    private function setParams($statement, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement,$key, $value){
        $statement->bindParam($key, $value);
    }

    public function add($rawQuerry, $params = array())
    {
      $stmt= $this->conn->prepare($rawQuerry);
      $this->setParams($stmt, $params);
      $stmt->execute();
      return $stmt;
    }

    public function select($rawQuerry, $params = array()):array
    {
      $stmt= $this->add($rawQuerry, $params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>