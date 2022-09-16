<?php
ob_start();
session_start();
$_SESSIONS["pagina_atual"]="Perfil";


if($_SESSION['userEstado']!='ativo'){
    header("Location: /account/login.php");
     ob_end_flush();
}

require "../database/connect.php";

?>
<!doctype html>
<html>
<head>

    <script src="https://kit.fontawesome.com/4993c2bd61.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/style.css">
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HREF - PERFIL</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>


    <!-- JQuery Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" href="../src/img/favicon_io/favicon.ico" type="image/ico"> <!--  FAV ICON DO SITE   -->

    <?php include 'navbar.php'; ?>

</head>
<body>


<div class="container" style="margin-top: 210px;">

    <?php require "mensagens.php";//MENSAGENS DE ADICIONAR E APAGAR POST NUM FICHEIRO Á PARTE ?>

                        <!-- ALTERAR PASSWORD INICIO-->
                                <div class="col-md-12 grid-margin">
                                    <div class="card rounded">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h4>ALTERAR PASSWORD</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!--- Mensagens de sucesso e erro de alterar password  -->
                                            <form method="post" action="commands/alterarPassword.php">
                                                <div class="form-group"><label class="form-control-label text-muted">Password Antiga</label>
                                                    <input type="password" id="psw" name="old_psw_login" class="form-control" required>
                                                </div>
                                                <div class="form-group"><label class="form-control-label text-muted">Password Nova</label>
                                                    <input type="password" id="psw" name="new_psw_login" class="form-control" required>
                                                </div>
                                                <div class="form-group"><label class="form-control-label text-muted">Repita Password Nova</label>
                                                    <input type="password" id="psw" name="new2_psw_login" class="form-control" required>
                                                </div>
                                                <div class="row justify-content-center my-3 px-3">
                                                    <button type="submit" class="btn-block btn-color">Alterar Password</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>

                        <!-- ALTERAR PASSWORD FIM -->

                        <!-- ALTERAR IMAGEM INICIO-->
                                <div class="col-md-12 grid-margin">
                                    <div class="card rounded">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h4>ALTERAR IMAGEM DE PERFIL</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data" action="commands/alterarImagem.php">
                                                 <img id='add_img_icon' class="add_img_icon" style="width:200px; height:200px;" src="../src/img/add_img.png" alt='Profile Pic'>
                                                <div class="input-group mb-3">
                                                    <input type="file" accept="image/*"   id="file" name="file">
                                                </div>
                                                 <button type="submit" class="btn-block btn-color">Alterar Foto</button>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>

                        <!-- ALTERAR IMAGEM FIM -->

                        <!-- ALTERAR EMAIL INICIO-->
                                <div class="col-md-12 grid-margin">
                                    <div class="card rounded">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h4>ALTERAR EMAIL</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data" action="commands/alterarEmail.php">
                                                <div class="form-group"><label class="form-control-label text-muted">Password</label>
                                                    <input type="password" id="psw_login" name="psw_login" class="form-control" required>
                                                </div>
                                                <div class="form-group"><label class="form-control-label text-muted">Email Novo</label>
                                                    <input type="email" id="email" name="email" class="form-control" required>
                                                </div>
                                                <div class="row justify-content-center my-3 px-3">
                                                    <button type="submit" class="btn-block btn-color">Alterar Email</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>

                        <!-- ALTERAR EMAIL FIM -->

                        <!-- DESVINCULAR INICIO -->
                                <div class="col-md-12 grid-margin">
                                    <div class="card rounded">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h4>DESVINCULAR CONTA</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                                <div class="justify-content-center px-3">
                                                    <h5 class="text-danger" style="text-align: center;">Excluir definitivamente a conta (Este processo não tem retorno)</h5>
                                                </div>
                                                <div class="d-flex justify-content-center my-4 px-3" style="color:red">
                                                    <i class="fa-solid fa-ban fa-6x"></i>
                                                </div>
                                                <div class="justify-content-center my-3 px-3">
                                                    <button type="submit" data-toggle="modal" data-target="#desvincular-modal" name="desvincular" class="btn-block btn-color">Desvincular</button>
                                                </div>
                                        </div>

                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>

                        <!-- DESVINCULAR FIM -->

                        <!-- DESVINCULAR POST MODAL ------------------------------------------------------------------------------------>
                        <div class="modal fade" id="desvincular-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="modal-content" method="POST" action="commands/desvincular.php">

                                    <div class="modal-header">
                                        <h5 class="modal-title alert-danger" id="exampleModalLabel">Aviso!</h5><p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="justify-content-center px-3">
                                            <h5 class="text-danger" style="text-align: center;">Pretende desvincular a conta ? (Este processo não tem retorno)</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="desvincular" class="btn-danger" style=" color: white">Desvincular</button>
                                    </div>

                                </form>
                            </div>
                        </div>


</div>

<?php

include "rodape.php";

?>

</body>
</html>
