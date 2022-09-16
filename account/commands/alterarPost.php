<?php


ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";



if (isset($_POST["content"]) && isset($_POST["title"])) {

    $tipo_cat = $_POST['id_cat'];

    $username = $_SESSION['id'];
    $name_file = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];

    $PostId=$_POST["post_id"];

    $local_image= "../../postagens/$PostId/";

    //CASO  AO EDITAR O UTILIZADOR ACRESCENTE UMA IMAGEM
    if($_FILES['file']['name']!=null && $_FILES['file']['tmp_name']!=null){

        //APAGAR TODOS OS FICHEIROS QUE ANTES TINHA, PARA NAO ACUMULAR
        array_map('unlink', glob("{$local_image}*.*"));

        $upload = copy ($tmp_name, $local_image.$name_file);  //COPIAR A IMAGEM PARA A PASTA

        //ATUALIZAR OS DADOS NA BASE DE DADOS COM IMAGEM
        $sql2 = $conn->prepare("UPDATE post SET conteudo = ?, titulo = ?, imagem = ? WHERE id_post = ?; ");
        $sql2->bind_param("sssd", $_POST["content"], $_POST["title"], $_FILES['file']['name'], $PostId);
        $sql2->execute();

        //Redirecionar consoante a categoria
        switch ($tipo_cat){
            case 1:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../home.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../home.php?post_alter=true");
                }
                break;
            case 2:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../education_work.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../education_work.php?post_alter=true");
                }
                break;
            case 3:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../games.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../games.php?post_alter=true");
                }
                break;
            case 4:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../memes.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../memes.php?post_alter=true");
                }
                break;
        }


    }else{

        //ATUALIZAR OS DADOS NA BASE DE DADOS SEM IMAGEM
        $sql2 = $conn->prepare("UPDATE post SET conteudo = ?, titulo = ? WHERE id_post = ?;");
        $sql2->bind_param("ssd", $_POST["content"], $_POST["title"], $PostId);
        $sql2->execute();

        //Redirecionar consoante a categoria
        switch ($tipo_cat){
            case 1:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../home.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../home.php?post_alter=true");
                }
                break;
            case 2:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../education_work.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../education_work.php?post_alter=true");
                }
                break;
            case 3:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../games.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../games.php?post_alter=true");
                }
                break;
            case 4:
                //VERIFICAR SE EXISTIU ERROS
                if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                    header("Location: ../memes.php?post_alter=false");
                } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                    header("Location: ../memes.php?post_alter=true");
                }
                break;
        }

    }
}

?>
