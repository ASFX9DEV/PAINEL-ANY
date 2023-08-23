<?php 
include_once 'config.php';
include_once 'lib/Database/Connection.php';
$conn = Connection::getConn();
function config($name)
{
global $conn;
$sql = $conn->query("SELECT valor FROM configsany WHERE nome='$name'")->fetch();
return $sql['valor'];
}
;echo '
{"SendMessage":"04","MyMessage":"';echo configsany('msg');echo '"}';;