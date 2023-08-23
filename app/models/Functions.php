<?php class Functions
{
public static function getConfig($name)
{
$conn = Connection::getConn();
$sql = $conn->query("SELECT valor FROM configsany WHERE nome='$name'")->fetch();
return $sql['valor'];
}
public static function getUser($info,$login)
{
$conn = Connection::getConn();
$sql = $conn->query("SELECT $info FROM login WHERE login='$login'")->fetch();
return $sql[$info];
}
}
;