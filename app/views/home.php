<?php echo '<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=0.7, user-scalable=no"><div class="container"><style>
element.style {
}
.deslog {
    color: #fff;
    background-color: #d3571b;
    border-color: #7d3613;
}
.logout2 {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 50%;
}

.logout {
   
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}</style>
   <center>
<div class="container">
 
    <img src="https://scvirtual.alphi.media/assets/img/vector.png" width="400" height="180" class=""><br>
        <div class="row">
            <div class="col"><button class="mt-3 btn btn-info btn-block" data-toggle="modal" data-target="#modalconfig"><i class="fa-solid fa-gear"></i> Configurações</button></div>
             <div class="col"><button class="mt-3 btn btn-info btn-block" data-toggle="modal" data-target="#modalsenha"><i class="fa-solid fa-gear"></i> Alterar senha</button></div>
            <div class="col"><a class="mt-3 btn btn-success btn-block" href="update.php?download"><i class="fa-solid fa-download"></i> Baixar JSON</a></div>
              
</div>
        ';
if($_POST['logout']):
session_destroy();
header('location: ./index');
endif;
;
echo '

<br>
        <label for=""><b><i class="fa-solid fa-arrow-right"></i> Selecione a payload</b></label>
        <form action="" id="form_payload" method="post">
            <div class="input-group mb-3">
                <select id="editar_payload" class="form-control" name="editar_payload">
                    <option value="">Selecione</option>
                    ';foreach ($payloadsany as $payload) : ;echo '                        <option value="';echo  $payload['id'] ;echo '">';echo  $payload['Name'] ;echo '</option>
                    ';endforeach;;echo '                </select>
        </form>
        <div class="input-group-prepend">
            <a href="" class="btn btn-light" data-toggle="modal" data-target="#addpayload"><i class="fa fa-plus"></i></a>
        </div>
        </div>
        </form>
        </div>
        </div>


    </center>

    <br>
    <center><p>Projetado e Desenvolvido por: <a href="https://t.me/scvirtual" target="_blank" rel="noopener noreferrer">Security Virtual</a>.</p>
    <div class="logout">
<form action="" method="POST"><button type="submit" value="logout" name="logout" class="logout2 btn deslog btn-block">Logout</button><form></div>
                    </center>
</div>

';
include_once 'modais.php';
if (isset($_POST['editar_payload'])) {
echo "<script>$('#editarpayload').modal('show')</script>";
}else if (isset($_POST['editar_servidor'])) {
echo "<script>$('#editarservidor').modal('show')</script>";
}
;echo '
<script>
    $(\'#editar_payload\').on(\'change\', function() {
        document.getElementById("form_payload").submit();
    })
</script>';;