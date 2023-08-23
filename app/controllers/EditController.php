<?php
class EditController
{
public function server()
{
$id = $_POST['id'];
$nome = $_POST['nome'];
$Servidor = $_POST['Servidor'];
$tipo = $_POST['tipo'];
$serverip = $_POST['serverip'];
$checkuser = $_POST['checkuser'];
$serverport = $_POST['serverport'];
$sslport = $_POST['sslport'];
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['edt_servidor'])) :
$sql = $conn->query("SELECT * FROM servidores WHERE Name='$nome'")->fetchColumn();
if ($sql >0) :
echo "<script>
            alert('Já existe um servidor com esse nome !');
            window.location='".LINK ."';
            </script>";
elseif (empty($nome)) :
echo "<script>
            alert('Nome não pode ficar vazio !');
            window.location='".LINK ."';
            </script>";
else :
$sql = $conn->prepare("UPDATE servidores SET Name='$nome', Servidor='Servidor', TYPE='$tipo',  ServerIP='$serverip', CheckUser='$checkuser', ServerPort='$serverport', SSLPort='$sslport', USER='', PASS='' WHERE id='$id'");
$sql->execute();
echo "<script>
                alert('Servidor editado com sucesso !');
                window.location='".LINK ."';
                </script>";
endif;
else :
header('location: '.LINK .'');
endif;
}
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
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['edt_payload'])) :
$sql = $conn->query("SELECT * FROM payloadsany WHERE Name='$payload'")->fetchColumn();
if (empty($nome)) :
echo "<script>
                alert('O nome precisa ser alterador!');
                window.location='".LINK ."';
                </script>";
elseif (empty($nome)) :
echo "<script>
                alert('Nome não pode ficar vazio !');
                window.location='".LINK ."';
                </script>";
else :
$sql = $conn->prepare("UPDATE payloadsany SET Name='$nome', Servidor='$Servidor',  SPort='$SPort', Prox='$Prox', Payload='$Payload', Direct='$Direct', Sni='$Sni', Certopen='$Certopen', Dns1='$Dns1', Dns2='$Dns2', UrlPainel='$UrlPainel', VPNMod='$VPNMod',  VPNTunMod='$VPNTunMod', Info='$Info', DefaultProxy='$DefaultProxy', CustomSquid='$CustomSquid' WHERE id='$id'");
$sql->execute();
echo "<script>
                alert('Payload editada com sucesso !');
                window.location='".LINK ."';
                </script>";
endif;
else :
header('location: '.LINK .'');
endif;
}
public function port()
{
$id = $_POST['id'];
$porta = $_POST['porta'];
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['edt_porta'])) :
$sql = $conn->query("SELECT * FROM portas WHERE Porta='$porta'")->fetchColumn();
if ($sql >0) :
echo "<script>
            alert('Essa porta já existe !');
            window.location='".LINK ."';
            </script>";
elseif (empty($porta)) :
echo "<script>
                alert('Porta não pode ficar vazio');
                window.location='".LINK ."';
                </script>";
else :
$sql = $conn->prepare("UPDATE portas SET Porta='$porta' WHERE id='$id'");
$sql->execute();
echo "<script>
                alert('Porta editada com sucesso !');
                window.location='".LINK ."';
                </script>";
endif;
else :
header('location: '.LINK .'');
endif;
}
public function config()
{
$versao = $_POST['versao'];
$notas = $_POST['notas'];
$Saudacao = $_POST['Saudacao'];
$update = $_POST['update'];
$LinkBanner = $_POST['LinkBanner'];
$LinkBackground = $_POST['LinkBackground'];
$servidor = $_POST['servidor'];
$contato = $_POST['contato'];
$termos = $_POST['termos'];
$checkuser = $_POST['checkuser'];
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['config'])) :
if (empty($versao)) :
echo "<script>
                alert('Versão não pode ficar vazio !');
                window.location='".LINK ."';
                </script>";
elseif (empty($update)) :
echo "<script>
                alert('Update não pode ficar vazio !');
                window.location='".LINK ."';
                </script>";
endif;
$sql_v = $conn->query("UPDATE configsany SET valor='$versao' WHERE nome='versao'");
$sql_n = $conn->query("UPDATE configsany SET valor='$notas' WHERE nome='notas'");
$sql_s = $conn->query("UPDATE configsany SET valor='$Saudacao' WHERE nome='Saudacao'");
$sql_u = $conn->query("UPDATE configsany SET valor='$update' WHERE nome='update'");
$sql_u = $conn->query("UPDATE configsany SET valor='$LinkBackground' WHERE nome='LinkBackground'");
$sql_u = $conn->query("UPDATE configsany SET valor='$LinkBanner' WHERE nome='LinkBanner'");
$sql_e = $conn->query("UPDATE configsany SET valor='$servidor' WHERE nome='servidor'");
$sql_c = $conn->query("UPDATE configsany SET valor='$contato' WHERE nome='contato'");
$sql_t = $conn->query("UPDATE configsany SET valor='$termos' WHERE nome='termos'");
$sql_ch = $conn->query("UPDATE configsany SET valor='$checkuser' WHERE nome='checkuser'");
if ($sql_ch) :
echo "<script>
            alert('Configurações editadas com sucesso !');
            window.location='".LINK ."';
            </script>";
endif;
else :
header('location: '.LINK .'');
endif;
}
public function user()
{
$id = $_POST['id'];
$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$senhamd = md5($senha2);
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['edit_user'])) :
if (empty($nome)) :
echo "<script>
                alert('Nome não pode ficar vazio');
                window.location='".LINK ."';
                </script>";
elseif (empty($login)) :
echo "<script>
                alert('Login não pode ficar vazio');
                window.location='".LINK ."';
                </script>";
endif;
$vpass = $conn->prepare("SELECT * FROM login WHERE id='$id'");
$vpass->execute();
$vpass = $vpass->fetch(PDO::FETCH_ASSOC);
if(empty($senha) &&empty($senha2)):
$sql = $conn->prepare("UPDATE login SET nome='$nome', login='$login' WHERE id='$id'");
$sql->execute();
$_SESSION['login'] = $login;
echo "<script>
                alert('Perfil atualizado !');
                window.location='".LINK ."';
                </script>";
elseif(empty($senha) OR empty($senha2)):
echo "<script>
                alert('Preencha o campo senha atual e nova senha !');
                window.location='".LINK ."';
                </script>";
elseif(md5($senha) == $vpass['senha']):
$sql = $conn->prepare("UPDATE login SET nome='$nome', login='$login', senha='$senhamd' WHERE id='$id'");
$sql->execute();
$_SESSION['login'] = $login;
echo "<script>
                alert('Senha atualizada !');
                window.location='".LINK ."';
                </script>";
else:
echo "<script>
                alert('Não foi possivel atender a solicitação !');
                window.location='".LINK ."';
                </script>";
endif;
endif;
}
public function edituser()
{

$login = $_SESSION['login'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$senhamd = md5($senha2);
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['edit_user'])) :
if (empty($nome)) :
$esc = $_SESSION['login'];
elseif (empty($login)) :
echo "<script>
                alert('Login não pode ficar vazio');
                window.location='".LINK ."';
                </script>";
endif;
$vpass = $conn->prepare("SELECT * FROM login WHERE login='$esc'");
$vpass->execute();
$vpass = $vpass->fetch(PDO::FETCH_ASSOC);
if(empty($senha) &&empty($senha2)):
$sql = $conn->prepare("UPDATE login SET  login='$login' WHERE login='$esc'");
$sql->execute();
$_SESSION['login'] = $login;
echo "<script>
                alert('Perfil atualizado !');
                window.location='".LINK ."';
                </script>";
elseif(empty($senha) OR empty($senha2)):
echo "<script>
                alert('Preencha o campo senha atual e nova senha !');
                window.location='".LINK ."';
                </script>";
elseif(md5($senha) == $vpass['senha']):
$sql = $conn->prepare("UPDATE login SET  login='$login', senha='$senhamd' WHERE login='$esc'");
$sql->execute();
$_SESSION['login'] = $login;
echo "<script>
                alert('Senha atualizada !');
                window.location='".LINK ."';
                </script>";
else:
echo "<script>
                alert('Senha atual incorreta!');
                window.location='".LINK ."';
                </script>";
endif;
endif;
}

public function newcadastro()
{
$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$senhamd = md5($senha2);
if (!$_SESSION['login']) :
header('location: '.LINK .'');
endif;
$conn = Connection::getConn();
if (isset($_POST['newuser'])) :
if (empty($nome)) :
$esc = $_SESSION['login'];
elseif (empty($nome)) :
echo "<script>
                alert('Login não pode ficar vazio');
                window.location='".LINK ."';
                </script>";
                
elseif (empty($login)) :
echo "<script>
                alert('Login não pode ficar vazio');
                window.location='".LINK ."';
                </script>";
endif;
$esc = $_SESSION['login'];
$gg = $conn->prepare("SELECT * FROM login WHERE login='$esc'");
$gg->execute();
$gg = $gg->fetch(PDO::FETCH_ASSOC);

if($gg['acesso'] !== "1"):
echo "<script>
                alert('Usuario sem permissão!');
                window.location='".LINK ."';
                </script>";
                else:
                    $vpass = $conn->prepare("SELECT * FROM login WHERE login='$login'");
$vpass->execute();
$vpass = $vpass->fetch(PDO::FETCH_ASSOC);
if($vpass['login'] == $login):

echo "<script>
                alert('Usuario ja existe!');
                window.location='".LINK ."';
                </script>";
                else:
if(empty($senha) OR empty($senha2)):
echo "<script>
                alert('Preencha o campo senha atual e nova senha !');
                window.location='".LINK ."';
                </script>";
elseif(md5($senha) == $senhamd):
$sql = $conn->prepare("INSERT INTO login SET nome='$nome', login='$login', senha='$senhamd', senha2='$senha2'"); 
$sql->execute();
$_SESSION['login'] = $login;
echo "<script>
                alert('cadastro realizado');
                window.location='".LINK ."';
                </script>";
else:
echo "<script>
                alert('Senha atual incorreta!');
                window.location='".LINK ."';
                </script>";
endif;
endif;

endif;
endif;
}

}

;
