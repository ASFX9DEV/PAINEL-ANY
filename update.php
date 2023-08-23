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
header('Content-Type: application/json; charset=utf-8');
$servidores = array();
$payloadsany = array();
$sql = $conn->query('SELECT Name, TYPE,   ServerIP, CheckUser, ServerPort, SSLPort, USER, PASS FROM servidores');
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
$servidores[] = $row;
}
$sql = $conn->query('SELECT Name, Servidor, SPort, Prox,  Payload, Direct, Sni,  Payssl, Certopen, Dns1, Dns2, UrlPainel, VPNMod, VPNTunMod, Info, DefaultProxy, CustomSquid  FROM payloadsany');
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
$payloadsany[] = $row;
}
$dados = array(
'Servers'=>[
],
'WarningMsg'=>'',
'SecuredShellPort'=>'22',
'SecuredShellDropbearPort'=>'80',
'SecuredShellSSLPort'=>'443',
'OpenVpnTCPPort'=>'1194',
'OpenVpnUDPPort'=>'7300',
'OpenVpnSSLPort'=>'443',
'SquidPort'=>'8080',
'ConfigCertOvpn'=>'',
'OpenVpnAddLine'=>'ULTRACONEXAO',
'WarnMsg'=>'ED7B68535C996EE1E4D68FA753FA5633',
'ReleaseNotes'=>[config('notas'),
],
'VIP'=>'vip',
'UrlUpdate'=>config('update'),
'Link'=>'true',
'Saudacao'=>'testes sms',
'LinkIcone'=>'',
'LinkBanner'=>config('LinkBanner'),
'LinkBackground'=>config('LinkBackground'),
'LinkVideo'=>'sim',
'Dnspp'=>'nao',
'Hostpp'=>'nao',
'Networks'=>$payloadsany,
'ConfigVersion'=>config('versao'),
);
$dados = json_encode($dados,JSON_UNESCAPED_UNICODE |JSON_PRETTY_PRINT);
$pronto = str_replace('\\','',$dados);
echo $pronto;
if(isset($_GET['download'])){
if(!$_SESSION['login']){
header('location: /');
}
$config = 'config.json';
if(file_exists($config)){
unlink($config);
}
file_put_contents($config,$pronto);
header('Content-disposition: attachment; filename=config.json');
header('Content-type: application/json');
};