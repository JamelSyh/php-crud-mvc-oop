<?php

class Database
{

  /*
   
    database name = isil
    table name = etudiants
    table structure = (Id, Nom, Prenom, Email, groupe, photo)

  */

  public $host  = "localhost";
  public $db = "isil";
  public $user = "root"; // user name
  public $password = "256841"; // password
  public $table = "students";
  public $dsn; // mysql connection url
  public $conn; // mysql pdo connection object

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
      $sql = "INSERT INTO " . $this->table . "(nom, prenom, email, groupe, photo)
        values(:lastname, :firstname, :email, :group, :photo)";
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
        nom = :lastname,
        prenom = :firstname,
        email = :email,
        groupe = :group,
        photo = :photo 
        WHERE id = :id";
      $statment = $this->conn->prepare($sql);
      $statment->execute($placeholder);
      return $statment;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // get all data
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

  // get one item by id
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

  // get all items matched (mached by LIKE) by key (search input) 
  function query_by($placeholder)
  {
    $key = key($placeholder); // get the key of the first element of the argument $placeholder
    $pattern = "%" . $placeholder[$key] . "%";

    try {
      $sql = "SELECT * FROM " . $this->table . " WHERE CONCAT(nom, prenom, groupe) LIKE :$key";

      $statment = $this->conn->prepare($sql);
      $statment->bindValue(":$key", $pattern);
      $statment->execute();
      return $statment->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // get all data Limited (used by pagination)
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

  // get all data Limited with with search (used by pagination + search)
  function query_limit_by($placeholder)
  {
    $key = "input"; // the key of the element used by Like operator ($key = "input" is search input)
    $pattern = "%" . $placeholder[$key] . "%";

    try {
      $sql = "SELECT * FROM " . $this->table . " WHERE CONCAT(nom, prenom, groupe) LIKE :$key LIMIT :start, :end";

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
