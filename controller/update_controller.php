<?php

require_once("controller.php");

function get_data()
{
  $controller = new Controller();
  return $controller->get_data();
}

if (isset($_POST["update"])) {
  $controller = new Controller();
  $controller->update();
}
