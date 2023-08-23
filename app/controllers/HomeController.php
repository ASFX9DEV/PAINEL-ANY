<?php class HomeController
{
public function index()
{
if(!$_SESSION['login']):
require (VIEW .'/login.php');
else:
$conn = Connection::getConn();
$servers = array();
$servers = ListItem::getServers();
$payloadsany = array();
$payloadsany = ListItem::getpayloadsany();
$ports = array();
$ports = ListItem::getPorts();
require (VIEW .'/home.php');
endif;
}
}
;