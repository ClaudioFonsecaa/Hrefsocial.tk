<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";

if (isset($_POST["apagar"])) {

    //ID DO POST
    $post_id=$_POST["id_post"];

    $tipo_cat = $_POST['id_cat'];

    //APAGAR DA BASE DE DADOS
    $sql = $conn->prepare("DELETE FROM post WHERE id_post = ?");
    $sql->bind_param("d", $post_id);
    $sql->execute();

    //NOTA - COMO O DIRETORIO SO É APAGADO CASO ESTEJA VAZIO TEMOS QUE FAZER UNLINK A TODOS OS FICHEIROS LA DENTRO
    $files = glob('../../postagens/'.$post_id.'/*');
    foreach($files as $file){
        if(is_file($file))
            unlink($file);
    }

    //APAGAR O DIRETORIO
    rmdir('../../postagens/'.$post_id.'');


    //Redirecionar consoante a categoria
    switch ($tipo_cat){
        case 1:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../home.php?post_deleted=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../home.php?post_deleted=true");
            }
            break;
        case 2:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../education_work.php?post_deleted=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../education_work.php?post_deleted=true");
            }
            break;
        case 3:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../games.php?post_deleted=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../games.php?post_deleted=true");
            }
            break;
        case 4:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../memes.php?post_deleted=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../memes.php?post_deleted=true");
            }
            break;
    }

}

?>
