<?php


require_once("controller.php");

function get_search_data()
{
  $controller = new Controller();
  return $controller->get_limit_data();
}
