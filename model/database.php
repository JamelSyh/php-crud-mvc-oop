<?php

class Database
{

  public $host  = "localhost";
  public $db = "test_crud";
  public $user = "root";
  public $password = "256841";
  public $table = "users";
  public $dsn;
  public $conn;

  function __construct()
  {

    $this->dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=UTF8";
    try {
      $this->conn = new PDO($this->dsn, $this->user, $this->password);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function insert($placeholder)
  {

    try {
      $sql = "INSERT INTO " . $this->table . "(name, number)
        values(:name, :number)";
      $statment = $this->conn->prepare($sql);
      return $statment->execute($placeholder);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function update($placeholder)
  {

    try {
      $sql = "UPDATE " . $this->table . " 
        SET 
        name = :name,
        number = :number 
        WHERE id = :id";
      $statment = $this->conn->prepare($sql);
      $statment->execute($placeholder);
      return $statment;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function query_all()
  {

    try {
      $sql = "SELECT * FROM " . $this->table;
      $statment = $this->conn->query($sql);
      return $statment->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function query_by_id($placeholder)
  {

    try {
      $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";

      $statment = $this->conn->prepare($sql);
      $statment->bindValue(":id", $placeholder["id"]);
      $statment->execute();
      return $statment->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function query_by($placeholder)
  {
    $key = key($placeholder);
    $pattern = "%" . $placeholder[$key] . "%";

    try {
      $sql = "SELECT * FROM " . $this->table . " WHERE CONCAT(name, number) LIKE :$key";

      $statment = $this->conn->prepare($sql);
      $statment->bindValue(":$key", $pattern);
      $statment->execute();
      return $statment->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function query_limit($placeholder)
  {

    try {
      $sql = "SELECT * FROM " . $this->table . " LIMIT :start, :end";

      $statment = $this->conn->prepare($sql);
      $statment->bindValue(":start", $placeholder["start"], PDO::PARAM_INT);
      $statment->bindValue(":end", $placeholder["end"], PDO::PARAM_INT);
      $statment->execute();
      return $statment->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function query_limit_by($placeholder)
  {
    $key = "name";
    $pattern = "%" . $placeholder[$key] . "%";

    try {
      $sql = "SELECT * FROM " . $this->table . " WHERE CONCAT(name, number) LIKE :$key LIMIT :start, :end";

      $statment = $this->conn->prepare($sql);
      $statment->bindValue(":$key", $pattern);
      $statment->bindValue(":start", $placeholder["start"], PDO::PARAM_INT);
      $statment->bindValue(":end", $placeholder["end"], PDO::PARAM_INT);
      $statment->execute();
      return $statment->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }


  function delete($placeholder)
  {

    try {
      $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
      $statment = $this->conn->prepare($sql);
      $statment->execute($placeholder);
      return $statment;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
