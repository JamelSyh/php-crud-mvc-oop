<?php

// by sayah djamel eddine L3 ISIL G02

require_once("../model/database.php");

class Controller
{
  public $max_page_number = 4; // max number of elements (students) in a page
  private $database; // Database obj (ORM)
  public $static = "../static/images/";

  function __construct()
  {
    if (!isset($_SESSION)) {
      session_start(); // used for warning messages
    }
    $this->database = new Database();
  }


  function get_all_data()
  {
    try {
      return $this->database->query_all();
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }


  // query all limited data (for pagination) from either normal mode or search mode
  function get_limit_data()
  {
    $current_page = isset($_GET["page"]) ? $_GET["page"] : 1; // gets the current page (1 is by default)
    $page_start = ($current_page - 1) * $this->max_page_number; // gets the start number of any page used by limit in the database
    $input["current_page"] = $current_page;
    $input["start"] = $page_start;
    $input["input"] = filter_input(INPUT_GET, "input"); // search input
    $input["end"] = $this->max_page_number; // used by limit in the database
    $input["item_length"] = count($this->search() ?? $this->get_all_data()); // used to calculate the total number of pages
    $input["number_pages"] = ceil($input["item_length"] / $this->max_page_number); // total number of pages

    try {
      $input["data"] = isset($_GET["search"]) ? $this->database->query_limit_by($input) : $this->database->query_limit($input); // query data either normal mode or search mode
      return $input;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }


  function create()
  {
    if (isset($_POST["create"])) {
      try {
        $target_file = $this->static . $_FILES["photo"]["name"]; // the path of the uploaded image

        $input["firstname"] = filter_input(INPUT_POST, "firstname");
        $input["lastname"] = filter_input(INPUT_POST, "lastname");
        $input["email"] = filter_input(INPUT_POST, "email");
        $input["group"] = filter_input(INPUT_POST, "group", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($_FILES["photo"]["name"])) {
          move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
          $input["photo"] = $target_file;
        } else {
          $input["photo"] = "null";
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }


      // validation
      if (empty($input["firstname"]) or empty($input["lastname"]) or empty($input["email"]) or empty($input["group"])) {
        $_SESSION["message"] = "fill the required fields";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/create.php");
        exit;
      } else if ($input["group"] < 0) {
        $_SESSION["message"] = "enter a valid groupe number";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/create.php");
        exit;
      } else {
        try {
          $_SESSION["message"] = "successfully created";
          $_SESSION["message_type"] = "success";
          $this->database->insert($input);
        } catch (PDOException $e) {
          $_SESSION["message"] = "unknown error occurred";
          $_SESSION["message_type"] = "warning";
          echo $e->getMessage();
        }
      }
    }
    header("Location: ../view/index.php");
    exit;
  }


  function delete()
  {
    if (isset($_GET["id"])) {
      $input["id"] = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
      try {
        $this->database->delete($input);
        $_SESSION["message"] = "successfully deleted";
        $_SESSION["message_type"] = "success";
      } catch (PDOException $e) {
        $_SESSION["message"] = "unknown error occurred";
        $_SESSION["message_type"] = "warning";
        die($e->getMessage());
      }
    }
    header("Location: ../view/index.php");
    exit;
  }


  // get data by id (used for update and view)
  function get_data()
  {
    if (isset($_GET["id"])) {
      $input["id"] = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
      try {
        return $this->database->query_by_id($input);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
  }


  function update()
  {
    if (isset($_POST["update"])) {
      $target_file = $this->static . $_FILES["photo"]["name"];;

      $input["id"] = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
      $old_input =  $this->database->query_by_id($input); // get the old data by id
      $input["firstname"] = filter_input(INPUT_POST, "firstname");
      $input["lastname"] = filter_input(INPUT_POST, "lastname");
      $input["email"] = filter_input(INPUT_POST, "email");
      $input["group"] = filter_input(INPUT_POST, "group", FILTER_SANITIZE_NUMBER_INT);
      if (!empty($_FILES["photo"]["name"])) {
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $input["photo"] = $target_file;
      } else {
      echo $old_input["photo"];
        $input["photo"] = $old_input["photo"] != "null" ? "null" : $old_input["photo"];
      }

      // validation
      if (empty($input["firstname"]) && empty($input["lastname"]) && empty($input["email"]) && empty($input["group"])) {
        $_SESSION["message"] = "fill the required fields";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/update.php?id={$input["id"]}");
        exit;
      } else if ($old_input["nom"] == $input["lastname"] && $old_input["prenom"] == $input["firstname"] && $old_input["groupe"] == $input["group"] && $old_input["email"] == $input["email"] && $input["photo"] == "null") {
        $_SESSION["message"] = "data not changed";
        $_SESSION["message_type"] = "warning";
        header("Location: ../view/update.php?id={$input["id"]}");
        exit;
      } else if ($input["group"] < 0) {
        $_SESSION["message"] = "enter a valid groupe number";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/update.php?id={$input["id"]}");
        exit;
      } else {
        try {
          $this->database->update($input);
          $_SESSION["message"] = "successfully updated";
          $_SESSION["message_type"] = "success";
          header("Location: ../view/index.php");
          exit;
        } catch (PDOException $e) {
          $_SESSION["message"] = "unknown error occurred";
          $_SESSION["message_type"] = "warning";
          die($e->getMessage());
        }
      }
    }
  }


  function search()
  {
    if (isset($_GET["search"])) {
      $input["input"] = filter_input(INPUT_GET, "input");
      if (empty($input["input"])) {
        $_SESSION["message"] = "input is required";
        $_SESSION["message_type"] = "warning";
      } else {
        try {
          $result = $this->database->query_by($input);
        } catch (PDOException $e) {
          $_SESSION["message"] = "unknown error occurred";
          $_SESSION["message_type"] = "warning";
          die($e->getMessage());
        }
        if (empty($result)) {
          $_SESSION["message"] = "data not found";
          $_SESSION["message_type"] = "warning";
        } else {
          $_SESSION["message"] = "data found";
          $_SESSION["message_type"] = "success";
          return $result;
        }
      }
    }
  }
}
