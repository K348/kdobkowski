<?php
include("../router/Router.class.php");
$router = new RouterConfig;
//$router->test();
$router->addAddress(array(" "), "index", "HelloWorld");
$router->addAddress(array("home"), "index", "HelloWorld");
//$router->addAddress(array("lol", "lol", "+tysionc", "bb"), "metoda", "akcja");
//$router->addAddress(array("+lol", "lol"), "metoda", "akcja");
$router->addAddress(array("test", "bbb"), "metoda", "akcja"); // 3
$router->addAddress(array("test", "+aaa"), "metoda", "akcja"); // 4
$router->addAddress(array("+error"), "metoda", "akcja"); // 5
$router->startController();
?>