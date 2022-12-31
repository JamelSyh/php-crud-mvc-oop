<?php
require_once("controller.php");

function get_all_data()
{
  $controller = new Controller();
  return $controller->get_all_data();
}
