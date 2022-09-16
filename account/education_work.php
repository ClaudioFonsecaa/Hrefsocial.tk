<?php

ob_start();
session_start();

$_SESSIONS["pagina_atual"]="Educação/Trabalho";

//SE O UTILIZADOR NÃO ESTIVER LIGADO VOLTA PARA O LOGIN
if($_SESSION['userEstado']!='ativo'){
    header("Location: /account/login.php");
    ob_end_flush();
}

require "../database/connect.php"; //IMPORTAR A BASE DE DADOS

?>

<!doctype html>
<html>
<head>

    <script src="https://kit.fontawesome.com/4993c2bd61.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../src/style.css">
    <link rel="stylesheet" href="../src/wave.css">
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HREF - Educação/Trabalho</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>

    <link rel="icon" href="../src/img/favicon_io/favicon.ico" type="image/ico"> <!--  FAV ICON DO SITE   -->


    <!-- JQuery Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--FUNÇÃO PARA VEFICAR O LIMITE MÁXIMO DA IMAGEM -->
    <script type="text/javascript">
        function VerifyUploadSizeIsOK()
        {
            var UploadFieldID = "file";
            var MaxSizeInBytes = 2097152;
            var fld = document.getElementById(UploadFieldID);
            if( fld.files && fld.files.length == 1 && fld.files[0].size > MaxSizeInBytes )
            {
                alert("O valor precisa de ser menor que " + parseInt(MaxSizeInBytes/1024/1024) + "MB");
                return false;
            }
            return true;
        }
    </script>

    <?php include 'navbar.php'; ?>

</head>
<body>

<div class="container" style="margin-top: 210px;">

    <?php require "mensagens.php";//MENSAGENS DE ADICIONAR E APAGAR POST NUM FICHEIRO Á PARTE ?>

    <!-- ESTRUTURA DO BOTÃO DE ADICIONAR ------------------------------------------------------------->
    <div class="col-md-12 grid-margin">
        <div class="card rounded">
            <div class="">
                <section>
                    <div class="form-group">
                        <input class="nova_pub" readonly style="margin-top: 10px" data-toggle="modal" data-target="#adicionarPost" placeholder="Vai uma nova publicação, <?php echo $_SESSION['nome_utilizador'];?> ?" required>
                    </div>
                    <div class="wave wave1"></div>
                    <div class="wave wave2"></div>
                    <div class="wave wave3"></div>
                    <div class="wave wave4"></div>
                </section>
            </div>
        </div>
    </div>

    <?php require "post_education_work.php";//ESTRUTURA DO POST NUM FICHEIRO Á PARTE ?>

    <!-- ADICIONAR POST MODAL ------------------------------------------------------------------------------------>
    <div class="modal fade" id="adicionarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar</h5><p>
                        <img src="../src/img/post.jpg"  width="200" height="200" alt="post_meme">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="commands/inserirPost.php">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="file" accept="image/*"   id="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Conteúdo:</label>
                            <textarea type="textarea" class="form-control" id="message-text" name="content" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="2" name="id_cat"><!-- Mandar em variavel escondida o tipo da categoria do post -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" onclick="return VerifyUploadSizeIsOK()" class="btn " style="background-color: #03d0a4; color: white">Publicar</button>
                        <button type="reset" class="btn  fa-solid fa-eraser fa-2x" style="color:deepskyblue"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <button type="button" data-toggle="modal" data-target="#adicionarPost" class="btn-color fa-solid fa-circle-plus fa-3x botCircle"></button> -->


<?php

include "rodape.php";

?>

</body>
</html>


