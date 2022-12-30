<?php

require_once("../controller/controller.php");
require_once("../controller/read_controller.php");
require_once("../controller/search_controller.php");


function get_limit_data()
{
  $controller = new Controller();
  return $controller->get_limit_data();
}
