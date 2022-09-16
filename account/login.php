<?php

//CODIGO PARA OCULTAR OS WARNING DO XAMPP
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();

//CASO O UTILIZADOR ESTEJA LOGADO ENTRA LOGO
if($_SESSION['userEstado']=='ativo'){
    header("Location: ../index.php");
}

?>

<!doctype html>
<html lang="pt">

<head>

    <script src="https://kit.fontawesome.com/4993c2bd61.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../src/style.css">
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>

    <title>HREF - A TUA REDE!</title>
    <link rel="icon" href="../src/img/favicon_io/favicon.ico" type="image/ico"> <!--  FAV ICON DO SITE   -->

</head>

<body>

<?php

//REQUERER O ACESSO À BASE DE DADOS
require "../database/connect.php";

if (isset($_GET['registo'])) {
    //CHAMAR FUNÇÃO CHECK E FUNÇÃO MUDAR A COR
    echo '<BODY onLoad="alterarCor(), check()">';
} ?>


<div class="background_effect">

<?php
// Mensagens login e registo e desvincular conta
require "mensagens.php"; ?>


    <div class="bubbles">
        <span style="--i:11;"></span>
        <span style="--i:12;"></span>
        <span style="--i:14;"></span>
        <span style="--i:10;"></span>
        <span style="--i:14;"></span>
        <span style="--i:23;"></span>
        <span style="--i:18;"></span>
        <span style="--i:16;"></span>
        <span style="--i:19"></span>
        <span style="--i:20;"></span>
        <span style="--i:22;"></span>
        <span style="--i:25;"></span>
        <span style="--i:18;"></span>
        <span style="--i:21;"></span>
        <span style="--i:15;"></span>
        <span style="--i:13;"></span>
        <span style="--i:26;"></span>
        <span style="--i:17;"></span>
        <span style="--i:13;"></span>
        <span style="--i:28;"></span>
        <span style="--i:11;"></span>
        <span style="--i:12;"></span>
        <span style="--i:14;"></span>
        <span style="--i:10;"></span>
        <span style="--i:14;"></span>
        <span style="--i:23;"></span>
        <span style="--i:18;"></span>
        <span style="--i:16;"></span>
        <span style="--i:19"></span>
        <span style="--i:20;"></span>
        <span style="--i:22;"></span>
        <span style="--i:25;"></span>
        <span style="--i:18;"></span>
        <span style="--i:21;"></span>
        <span style="--i:15;"></span>
        <span style="--i:13;"></span>
        <span style="--i:26;"></span>
        <span style="--i:17;"></span>
        <span style="--i:13;"></span>
        <span style="--i:28;"></span>
        <span style="--i:18;"></span>
        <span style="--i:16;"></span>
        <span style="--i:19"></span>
        <span style="--i:20;"></span>
        <span style="--i:22;"></span>
        <span style="--i:25;"></span>
        <span style="--i:18;"></span>
        <span style="--i:21;"></span>
        <span style="--i:15;"></span>
        <span style="--i:13;"></span>
        <span style="--i:26;"></span>
        <span style="--i:17;"></span>
        <span style="--i:13;"></span>
        <span style="--i:28;"></span>
        <span style="--i:11;"></span>
        <span style="--i:12;"></span>
        <span style="--i:14;"></span>
        <span style="--i:10;"></span>
        <span style="--i:14;"></span>
        <span style="--i:23;"></span>
        <span style="--i:18;"></span>
        <span style="--i:16;"></span>
        <span style="--i:19"></span>
        <span style="--i:20;"></span>
        <span style="--i:22;"></span>
        <span style="--i:25;"></span>
        <span style="--i:18;"></span>
        <span style="--i:21;"></span>
    </div>
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-10 text-center align-self-center">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <div class="div_central">
                        <img src="../src/img/logo_href_short.png" alt="href_logo" class="img_responsive">
                        <h6 class="mb-0 pb-1 style_toogle" id="textoEntrar"><span>Entrar</span></h6>
                        <h6 class="mb-0 pb-1" id="textoRegistar"><span>Registar</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" onclick="alterarCor()"/>
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">

                                            <!-- LOGIN ------------------------------------------------------------------------------------------>

                                            <i class="fa-solid fa-hashtag fa-7x fa-spin"></i>
                                            <p>

                                            <h6 class="mb-5 text-center heading">Olá, bem-vindo!</h6>

                                            <form method="post" action="commands/verifica_regista_Utilizador.php">
                                                <div class="form-group"><label class="form-control-label text-muted">Nome
                                                        de Utilizador ou Email</label>
                                                    <input type="text" id="email" name="email_login"
                                                           class="form-control" required>
                                                </div>

                                                <div class="form-group"><label class="form-control-label text-muted">Password</label>
                                                    <input type="password" id="psw" name="psw_login"
                                                           class="form-control" required>
                                                </div>

                                                <div class="row justify-content-center my-3 px-3">
                                                    <button type="submit" class="btn-block btn-color">ENTRAR</button>
                                                </div>
                                            </form>

                                            <div class="row justify-content-center my-2"><a
                                                        href="../account/forgot_password.php"><small class="text-muted">Esqueceu-se
                                                        da password?</small></a></div>


                                        </div>
                                    </div>
                                </div>


                                <!-- REGISTO ------------------------------------------------------------------------------------------>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">

                                            <h6 class="msg-info">Faça já o registo!</h6>

                                            <form method="post" action="commands/verifica_regista_Utilizador.php">
                                                <span id="check-username"></span>
                                                <div class="form-group"><label class="form-control-label text-muted">Nome de Utilizador</label>
                                                    <input type="text" id="username" name="username"
                                                           class="form-control" onInput="checkUsername()" required
                                                           pattern="[A-Za-z]{5,}"
                                                           title="Deve conter no mínimo 5 letras, sem caracters especiais!">
                                                </div>

                                                <span id="check-email"></span>
                                                <div class="form-group"><label class="form-control-label text-muted">Email</label>
                                                    <input type="text" id="reg_email" name="email"
                                                           onInput="checkEmail()" class="form-control" required
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                           title="exemplo@exemplo.com">
                                                </div>

                                                <div class="form-group"><label class="form-control-label text-muted">Password</label>
                                                    <input type="password" id="regist_psw" name="psw"
                                                           class="form-control" required=""/>
                                                </div>

                                                <div class="form-group"><label class="form-control-label text-muted">Confirmar
                                                        Password</label>
                                                    <input type="password" id="regist_confpsw" name="confpsw"
                                                           class="form-control" required=""/>
                                                </div>

                                                <div class="row justify-content-center my-3 px-3">
                                                    <button type="submit" class="btn-block btn-color">REGISTAR</button>
                                                </div>
                                            </form>

                                            <div class="row justify-content-center my-2"><a
                                                        href="../account/forgot_password.php"><small class="text-muted">Esqueceu-se
                                                        da password?</small></a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    <!-- LIVE CHECK DO USERNAME  -->
    function checkUsername() {

        jQuery.ajax({
            url: "commands/liveCheck.php",
            data: 'username=' + $("#username").val(),
            type: "POST",
            success: function (data) {
                $("#check-username").html(data);
            },
            error: function () {
            }
        });
    }

    <!-- LIVE CHECK DO EMAIL  -->
    function checkEmail() {

        jQuery.ajax({
            url: "commands/liveCheck.php",
            data: 'email=' + $("#reg_email").val(),
            type: "POST",
            success: function (data) {
                $("#check-email").html(data);
            },
            error: function () {
            }
        });
    }

    <!-- SCRIPT PARA VERIFICAR SE AS PASSOWORDS SAO IGUAIS  -->
    var password = document.getElementById("regist_psw"), confirm_password = document.getElementById("regist_confpsw");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("As passwords não são iguais!");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    <!-- SCRIPT QUE DESTACA A COR DO ENTRAR E REGISTAR-->
    function alterarCor() {
        var element1 = document.getElementById("textoRegistar");
        element1.classList.toggle("style_toogle");

        var element2 = document.getElementById("textoEntrar");
        element2.classList.toggle("style_toogle2");
    }

    <!-- SCRIPT QUE VIRA PARA O REGISTO-->
    function check() {
        document.getElementById("reg-log").checked = true;
    }

</script>

<?php include "rodape.php"; ?>

</body>
</html>