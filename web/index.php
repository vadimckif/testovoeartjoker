<?php
function debug($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

define("ROOT_DIR",dirname(dirname(__FILE__)));
define("VIEW_DIR",ROOT_DIR."/view");
define("MODEL_DIR",ROOT_DIR."/model");
define("VENDOR_DIR",ROOT_DIR."/vendor");
define("CONTROLLER_FILES",ROOT_DIR."/controller");
require(VENDOR_DIR."/setting/setting_connect_db.php");
if(is_file(ROOT_DIR."/vendor/Router.php"))
{
	require(ROOT_DIR."/vendor/Router.php");
}
$router=new Router();
$router->parseRequest();