<?php class AddController
{
public function payload()
{
$id = $_POST['id'];
$nome = $_POST['nome'];
$Servidor = $_POST['Servidor'];
$SPort = $_POST['SPort'];
$Prox = $_POST['Prox'];
$Payload = $_POST['Payload'];
$Direct = $_POST['Direct'];
$Sni = $_POST['Sni'];
$Certopen = $_POST['Certopen'];
$Dns1 = $_POST['Dns1'];
$Dns2 = $_POST['Dns2'];
$UrlPainel = $_POST['UrlPainel'];
$VPNMod = $_POST['VPNMod'];
$VPNTunMod = $_POST['VPNTunMod'];
$Info = $_POST['Info'];
$DefaultProxy = $_POST['DefaultProxy'];
$CustomSquid = $_POST['CustomSquid'];
$conn = Connection::getConn();
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$sql = $conn->query("SELECT * FROM payloadsany WHERE Name='$nome'")->fetchColumn();
if (isset($_POST['addpay'])) :
if ($sql >0) :
echo "<script>
            alert('Já existe uma payload com esse nome !');
            window.location='".LINK ."';
            </script>";
elseif (empty($nome)) :
echo "<script>
            alert('Nome não pode ficar vazio !');
            window.location='".LINK ."';
            </script>";
else :
$sql = $conn->prepare("INSERT INTO payloadsany SET Name='$nome', Servidor='$Servidor',  SPort='$SPort', Prox='$Prox', Payload='$Payload', Direct='$Direct', Sni='$Sni', Certopen='$Certopen', Dns1='$Dns1', Dns2='$Dns2', UrlPainel='$UrlPainel', VPNMod='$VPNMod',  VPNTunMod='$VPNTunMod', Info='$Info', DefaultProxy='$DefaultProxy', CustomSquid='$CustomSquid'");
$sql->execute();
echo "<script>
            alert('Payload adicionada com sucesso !');
            window.location='".LINK ."';
            </script>";
endif;
else :
header('location: '.LINK .'');
endif;
}
}
;