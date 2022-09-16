<?php

session_start();

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>
<!doctype html>
<html>
<head>

    <script src="https://kit.fontawesome.com/4993c2bd61.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../src/style.css">
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>HREF - RECUPERAR PASSWORD</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>

    <link rel="icon" href="../src/img/favicon_io/favicon.ico" type="image/ico"> <!--  FAV ICON DO SITE   -->

</head>

<body>


<div class="background_effect">

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
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">

                                            <!--IMPRIMIR MENSAGEM DE ERRO ! -->
                                            <?php
                                            $mensagem=$_GET["message_error"];

                                            if ($mensagem=="error"){ ?>

                                                <div class="alert alert-warning" role="alert">
                                                    Erro na recuperação de password!
                                                </div>

                                            <?php }else if($mensagem=="Erro ao atualizar password"){?>

                                            <div class="alert alert-warning" role="alert">
                                                Erro no sistema de mailing!
                                            </div>

                                            <?php }else if($mensagem=="passwordmismatch"){?>

                                                <div class="alert alert-warning" role="alert">
                                                    Password diferentes ou código inválido!
                                                </div>

                                            <?php }else if($mensagem=="NA"){?>

                                                <div class="alert alert-warning" role="alert">
                                                    Email não existe na nossa plataforma!
                                                </div>

                                           <?php }else if($mensagem=="false"){ ?>

                                                <div class="alert alert-success" role="alert">
                                                    Password alterada com sucesso!
                                                </div>

                                            <?php }?>

                                            <!--RECUPERAR ------------------------------------------>
                                            <h6 class="">Vamos recuperar a sua conta, sem problemas!</h6>

                                            <!--TUDO NO MESMO FORM ----->

                                            <form method="post" action="../src/mail.php">

                                                <!--PRIMEIRO FORM A PEDIR SOMENTE O EMAIL-->

                                                <div class="form-group"><label class="form-control-label text-muted">Email</label>
                                                    <input type="text" id="email_form" name="email_form" placeholder="Email"
                                                            class="form-control" required <?php if (isset($_SESSION["recover_email"])) {
                                                        ?> value="<?php echo $_SESSION["recover_email"] ?>"<?php
                                                    } ?>></div>


                                                <!--SEGUNDO FORM A PEDIR O RESTO -->
                                                <?php if (isset($_GET["recover"])) {?>

                                                    <p class="text-danger">Foi enviado um código para o seu email!</p>

                                                    <div class="form-group"><label class="form-control-label text-muted">Código</label> <input
                                                                type="password" id="code" name="code" class="form-control" placeholder="Código do Email"
                                                                required>
                                                    </div>
                                                    <div class="form-group"><label class="form-control-label text-muted">Nova Password</label> <input
                                                                type="password" id="psw" name="psw"  placeholder="Nova Password" class="form-control"
                                                                required>
                                                    </div>
                                                    <div class="form-group"><label class="form-control-label text-muted">Repetir Password</label> <input
                                                                type="password" id="confpsw" name="confpsw" placeholder="Repetir" class="form-control"
                                                                required>
                                                    </div>

                                                <?php } ?>

                                                <div class="row justify-content-center my-3 px-3">
                                                    <button type="submit" name="recuperar" class="btn-block btn-color">RECUPERAR</button>
                                                </div>

                                            </form>

                                            <div class="row justify-content-center my-2"><a href="../index.php"><small class="text-muted">Iniciar a sessão?</small></a></div>


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


<?php

include "rodape.php";

?>

</body>
</html>