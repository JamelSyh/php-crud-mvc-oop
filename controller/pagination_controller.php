<?php

require_once("../controller/controller.php");


function get_limit_data()
{
  $controller = new Controller();
  return $controller->get_limit_data();
}
