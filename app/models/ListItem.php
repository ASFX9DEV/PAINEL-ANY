<?php 
class ListItem
{
public static function getServers()
{
$conn = Connection::getConn();
$sql = $conn->prepare('SELECT * FROM servidores');
$sql->execute();
$serverList = array();
$i = 0;
while ($row = $sql->fetch()) {
$serverList[$i]['id'] = $row['id'];
$serverList[$i]['Name'] = $row['Name'];
$serverList[$i]['TYPE'] = $row['TYPE'];
$serverList[$i]['ServerIP'] = $row['ServerIP'];
$serverList[$i]['CheckUser'] = $row['CheckUser'];
$serverList[$i]['SSLPort'] = $row['SSLPort'];
$serverList[$i]['USER'] = $row['USER'];
$serverList[$i]['PASS'] = $row['PASS'];
$i++;
}
return $serverList;
}
public static function getpayloadsany()
{
$conn = Connection::getConn();
$sql = $conn->prepare('SELECT * FROM payloadsany');
$sql->execute();
$serverList = array();
$i = 0;
while ($row = $sql->fetch()) {
$serverList[$i]['id'] = $row['id'];
$serverList[$i]['Name'] = $row['Name'];
$serverList[$i]['SPort'] = $row['SPort'];
$serverList[$i]['Prox'] = $row['Prox'];
$serverList[$i]['Payload'] = $row['Payload'];
$serverList[$i]['Direct'] = $row['Direct'];
$serverList[$i]['Sni'] = $row['Sni'];
$serverList[$i]['Payssl'] = $row['Payssl'];
$serverList[$i]['Certopen'] = $row['Certopen'];
$serverList[$i]['Dns1'] = $row['Dns1'];
$serverList[$i]['Dns2'] = $row['Dns2'];
$serverList[$i]['UrlPainel'] = $row['UrlPainel'];
$serverList[$i]['VPNMod'] = $row['VPNMod'];
$serverList[$i]['VPNTunMod'] = $row['VPNTunMod'];
$serverList[$i]['Info'] = $row['Info'];
$serverList[$i]['DefaultProxy'] = $row['DefaultProxy'];
$serverList[$i]['CustomSquid'] = $row['CustomSquid'];
$i++;
}
return $serverList;
}
public static function getPorts()
{
$conn = Connection::getConn();
$sql = $conn->prepare('SELECT * FROM portas');
$sql->execute();
$serverList = array();
$i = 0;
while ($row = $sql->fetch()) {
$serverList[$i]['id'] = $row['id'];
$serverList[$i]['Porta'] = $row['Porta'];
$i++;
}
return $serverList;
}
}
;