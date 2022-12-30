<?php

require("../model/database.php");

class Controller
{
  public $max_page_number = 4;
  public $database;

  function __construct()
  {
    if (!isset($_SESSION)) {
      session_start();
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

  function get_limit_data()
  {
    $current_page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $page_start = ($current_page - 1) * $this->max_page_number;
    $input["current_page"] = $current_page;
    $input["start"] = $page_start;
    $input["name"] = filter_input(INPUT_GET, "input");
    $input["end"] = $this->max_page_number;
    $input["item_length"] = count($this->search() ?? $this->get_all_data());
    $input["number_pages"] = ceil($input["item_length"] / $this->max_page_number);
    try {
      $input["data"] = isset($_GET["search"]) ? $this->database->query_limit_by($input) : $this->database->query_limit($input);
      return $input;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  function create()
  {
    if (isset($_POST["create"])) {
      $input["name"] = filter_input(INPUT_POST, "name");
      $input["number"] = filter_input(INPUT_POST, "number", FILTER_SANITIZE_NUMBER_INT);

      if (empty($input["name"])) {
        $_SESSION["message"] = "Name is required";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/create.php");
        exit;
      } else if (empty($input["number"])) {
        $_SESSION["message"] = "Number is required";
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
          die($e->getMessage());
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
      $input["id"] = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
      $input["name"] = filter_input(INPUT_POST, "name");
      $input["number"] = filter_input(INPUT_POST, "number", FILTER_SANITIZE_NUMBER_INT);
      $old_input =  $this->database->query_by_id($input);

      if (empty($input["name"])) {
        $_SESSION["message"] = "Name is required";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/update.php?id={$input["id"]}");
        exit;
      } else if (empty($input["number"])) {
        $_SESSION["message"] = "Number is required";
        $_SESSION["message_type"] = "danger";
        header("Location: ../view/update.php?id={$input["id"]}");
        exit;
      } else if ($old_input == $input) {
        $_SESSION["message"] = "data not changed";
        $_SESSION["message_type"] = "warning";
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
      $input["name"] = filter_input(INPUT_GET, "input");
      if (empty($input["name"])) {
        $_SESSION["message"] = "input is required";
        $_SESSION["message_type"] = "warning";
      } else {
        try {
          $result = $this->database->query_by(["name" => $input["name"]]);
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
