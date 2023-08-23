<?php echo '<!------------------------------------------------------------------------------------------------------->
<!-- Modal editar payload -->
<div class="modal fade" id="editarpayload" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black;" class="modal-title" id="">Editar payload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                ';
$id_payload = $_POST['editar_payload'];
$sql = $conn->query("SELECT * FROM payloadsany WHERE id='$id_payload'");
$dados = $sql->fetch(PDO::FETCH_ASSOC);;echo '
                    <form action="?page=edit&action=payload" method="post">
                    <input type="hidden" name="id" value="';echo  $dados['id'] ;echo '">

                    <label for=""><span style="color: black;">Nome</span></label>
                    <input type="text" value="';echo  $dados['Name'] ;echo '" name="nome" id="nome" placeholder="Nome da Payload" class="form-control">
                   
                    <label for=""><span style="color: black;">Portas UDP</span></label>
                    <input type="text" name="Servidor" value="';echo  $dados['Servidor'] ;echo '" placeholder=":7200;7300;7400" class="form-control">

                    <label for=""><span style="color: black;">Prox:porta</span></label>
                    <input type="text" name="Prox" value="';echo  $dados['Prox'] ;echo '" placeholder="Proxy+porta | Exemplo: support.jungledisk.com:80 " class="form-control">


                    <label for=""><span style="color: black;">Payload</span></label>
                    <textarea class="form-control" name="Payload" rows="4" placeholder="Sua payload com seu dominio/ip, nao usa [app_host]">';echo  $dados['Payload'] ;echo '</textarea>

                    <label for=""><span style="color: black;">Direct</span></label>
                    <input type="text" name="Direct" value="';echo  $dados['Direct'] ;echo '" placeholder="Se souber usar, use, ou nao mexe" class="form-control">
                    
                    <label for=""><span style="color: black;">Sni</span></label>
                    <input type="text" name="Sni" value="';echo  $dados['Sni'] ;echo '" placeholder="Se souber usar, use, ou nao mexe" class="form-control">

                    <label for=""><span style="color: black;">Payssl</span></label>
                    <input type="text" name="Payssl" value="';echo  $dados['Payssl'] ;echo '" placeholder="Se souber usar, use, ou nao mexe" class="form-control">

                    <label for=""><span style="color: black;">DNS 1 | 2 ▼▼</span></label>
                    <input type="text" name="Dns1" value="';echo  $dados['Dns1'] ;echo '" placeholder="Dns google: 8.8.8.8"class="form-control">
                    <input type="text" name="Dns2" value="';echo  $dados['Dns2'] ;echo '" placeholder="Dns google: 8.8.4.4" class="form-control">

                    <label for=""><span style="color: black;">CheckUser</span></label>
                    <input type="text" name="UrlPainel" value="';echo  $dados['UrlPainel'] ;echo '" placeholder="Seu link Checkuser" class="form-control">
                    
                    <label for=""><span style="color: black;">VPNMod | VPNTunMod </span></label>

                    <input type="text" name="VPNMod" value="';echo  $dados['VPNMod'] ;echo '" placeholder="Numero: 0 = modo proxy ativado" class="form-control">
                    <input type="text" name="VPNTunMod" value="';echo  $dados['VPNTunMod'] ;echo '" placeholder="Numero: 1 = modo proxy ativado" class="form-control">
                    

                    <label for=""><span style="color: black;">Info</span></label>
                    <input type="text" name="Info" value="';echo  $dados['Info'] ;echo '" placeholder="Exemplo> clouflare:vivo" class="form-control">

                    <label for=""><span style="color: black;">DefaultProxy</span></label>
                    <input type="text" name="DefaultProxy" value="';echo  $dados['DefaultProxy'] ;echo '"  placeholder="true"class="form-control">

                

                    
            </div>
            <div class="modal-footer">
                <button type="submit" name="edt_payload" class="btn btn-primary">Salvar mudanças</button></form>
                <form action="?page=del&action=payload" method="post">
                    <input type="hidden" name="id" value="';echo  $dados['id'] ;echo '">
                    <button type="submit" name="del_payload" class="btn btn-danger">Excluir</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------->
<!-- Modal adicionar payload -->
<div class="modal fade" id="addpayload" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black;" class="modal-title" id="">Adicionar payload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="?page=add&action=payload" method="post">
                <input type="hidden" name="id" value="';echo  $dados['id'] ;echo '">

<label for=""><span style="color: black;">Nome</span></label>
<input type="text" value="';echo  $dados['Name'] ;echo '" name="nome" id="nome" placeholder="Nome da Payload" class="form-control">

<label for=""><span style="color: black;">Portas UDP</span></label>
<input type="text" name="Servidor" value="';echo  $dados['Servidor'] ;echo '" placeholder=":7200;7300;7400" class="form-control">

<label for=""><span style="color: black;">Prox:porta</span></label>
<input type="text" name="Prox" value="';echo  $dados['Prox'] ;echo '" placeholder="Proxy:porta | Exemplo: support.jungledisk.com:80 " class="form-control">


<label for=""><span style="color: black;">Payload</span></label>
<textarea class="form-control" name="Payload" rows="4" placeholder="Sua payload com seu dominio/ip, nao usa [app_host]">';echo  $dados['Payload'] ;echo '</textarea>

<label for=""><span style="color: black;">Direct</span></label>
<input type="text" name="Direct" value="';echo  $dados['Direct'] ;echo '" placeholder="Se souber usar, use, ou nao mexe" class="form-control">

<label for=""><span style="color: black;">Sni</span></label>
<input type="text" name="Sni" value="';echo  $dados['Sni'] ;echo '" placeholder="Se souber usar, use, ou nao mexe" class="form-control">

<label for=""><span style="color: black;">Payssl</span></label>
<input type="text" name="Payssl" value="';echo  $dados['Payssl'] ;echo '" placeholder="Se souber usar, use, ou nao mexe" class="form-control">

<label for=""><span style="color: black;">DNS 1 | 2 ▼▼</span></label>
<input type="text" name="Dns1" value="';echo  $dados['Dns1'] ;echo '" placeholder="Dns google: 8.8.8.8"class="form-control">
<input type="text" name="Dns2" value="';echo  $dados['Dns2'] ;echo '" placeholder="Dns google: 8.8.4.4" class="form-control">

<label for=""><span style="color: black;">CheckUser</span></label>
<input type="text" name="UrlPainel" value="';echo  $dados['UrlPainel'] ;echo '" placeholder="Seu link Checkuser" class="form-control">

<label for=""><span style="color: black;">VPNMod | VPNTunMod</span></label>

<input type="text" name="VPNMod" value="';echo  $dados['VPNMod'] ;echo '" placeholder="Numero: 0 = modo proxy ativado" class="form-control">
<input type="text" name="VPNTunMod" value="';echo  $dados['VPNTunMod'] ;echo '" placeholder="Numero: 1 = modo proxy ativado" class="form-control">


<label for=""><span style="color: black;">Info</span></label>
<input type="text" name="Info" value="';echo  $dados['Info'] ;echo '" placeholder="Exemplo> clouflare:vivo" class="form-control">

<label for=""><span style="color: black;">DefaultProxy</span></label>
<input type="text" name="DefaultProxy" value="';echo  $dados['DefaultProxy'] ;echo '"  placeholder="true"class="form-control">

</div>
            <div class="modal-footer">
                <button type="submit" name="addpay" class="btn btn-primary">Salvar mudanças</button></form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------->
<!-- Modal configurações-->
<div class="modal fade" id="modalconfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black" class="modal-title" id="exampleModalLabel">Configurações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="?page=edit&action=config" method="post">
                    <span style="color: black">
                        <div class="row">
                            <div class="col">
                                <label for="">Versão</label>
                                <input type="text" name="versao" class="form-control" value="';echo  Functions::getConfig('versao') ;echo '">
                            </div>
                            <div class="col">
                                <label for="">Notas</label>
                                <input type="text" name="notas" class="form-control" value="';echo  Functions::getConfig('notas') ;echo '">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="">Background</label>
                                <input type="text" name="LinkBackground" class="form-control" value="';echo  Functions::getConfig('LinkBackground') ;echo '">
                            </div>
                            <div class="col">
                                <label for="">Logo Marca</label>
                                <input type="text" name="LinkBanner" class="form-control" value="';echo  Functions::getConfig('LinkBanner') ;echo '">
                            </div>
                            <div class="col">
                                <label for="">Update</label>
                                <input type="text" name="update" class="form-control" value="';echo  Functions::getConfig('update') ;echo '">
                            </div>
                        </div>

                        <div class="row mt-2">
                            
                            
                            <div class="col">
                                <label for="">Saudação</label>
                                <input type="text" name="Saudacao" class="form-control" value="';echo  Functions::getConfig('Saudacao') ;echo '">
                            </div>

                            <div class="col">
                                <label for="">Termos</label>
                                <input type="text" name="termos" class="form-control" value="';echo  Functions::getConfig('termos') ;echo '">
                            </div>

                            <div class="col">
                                <label for="">CheckUser</label>
                                <select name="checkuser" class="form-control">
                                    <option value="true">Ativado</option>
                                    <option value="false">Desativado</option>
                                </select>
                            </div>
                        </div>
                    </span>


            </div>
            <div class="modal-footer">
                <button type="submit" name="config" class="btn btn-primary">Salvar mudanças</button></form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------->
<!-- Modal configurações-->
<div class="modal fade" id="modalsenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black" class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="?page=edit&action=edituser" method="post">
                    <span style="color: black">
                        <div class="row">
                            <div class="col">
                                <label for="">Nome de usuario</label>
                                <input type="text" name="login" class="form-control"  readonly="" value="';echo  $_SESSION['login'];echo '">
                            </div>
                            <div class="col">
                                <label for="">Senha Atual</label>
                                <input type="text" name="senha" class="form-control" value="';echo  Functions::getConfig('senha') ;echo '">
                            </div>
                             <div class="col">
                                <label for="">Nova Senha</label>
                                <input type="text" name="senha2" class="form-control" value="';echo  Functions::getConfig('senha') ;echo '">
                            </div>
                        </div>

                      
                    </span>


            </div>
            <div class="modal-footer">
                <button type="submit" name="edit_user" class="btn btn-primary">Salvar mudanças</button></form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------->
<!-- Modal configurações-->
<div class="modal fade" id="modalnewuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black" class="modal-title" id="exampleModalLabel">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="?page=edit&action=newcadastro" method="post">
                    <span style="color: black">
                        <div class="row">
                        <div class="col">
                                <label for="">Nome</label>
                                <input type="text" name="nome" class="form-control"  value="';echo  Functions::getConfig('nome') ;;echo '">
                            </div>
                            <div class="col">
                                <label for="">Login</label>
                                <input type="text" name="login" class="form-control"   value="';echo  Functions::getConfig('login') ;;echo '">
                            </div>
                            <div class="col">
                                <label for="">Nova Senha</label>
                                <input type="text" name="senha" class="form-control" value="';echo  Functions::getConfig('senha') ;echo '">
                            </div>
                             <div class="col">
                                <label for="">Comfirme a Senha</label>
                                <input type="text" name="senha2" class="form-control" value="';echo  Functions::getConfig('senha') ;echo '">
                            </div>
                        </div>

                      
                    </span>


            </div>
            <div class="modal-footer">
                <button type="submit" name="newuser" class="btn btn-primary">Salvar mudanças</button></form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>';;