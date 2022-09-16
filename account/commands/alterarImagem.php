<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";


//SE A IMAGEM NÃO ESTIVER VAZIA
if($_FILES['file']['name']!=null && $_FILES['file']['tmp_name']!=null){

    $username = $_SESSION['id'];
    $name_file = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $utilizadorID=$_SESSION["id"];
    $utilizadorNOME=$_SESSION["nome_utilizador"];
    $local_image= "../../utilizadores/$utilizadorNOME/pictures/";

    //APAGAR TODOS OS FICHEIROS QUE ANTES TINHA, PARA NAO ACUMULAR
    array_map('unlink', glob("{$local_image}*.*"));

    $upload = copy ($tmp_name, $local_image.$name_file);  //COPIAR A IMAGEM PARA A PASTA

    //ATUALIZAR OS DADOS NA BASE DE DADOS
    $sql2 = $conn->prepare("UPDATE utilizador SET imagem = ? WHERE id_user = ?; ");
    $sql2->bind_param("sd",$_FILES['file']['name'], $utilizadorID);
    $sql2->execute();

    //VERIFICAR SE EXISTIU ERROS
    if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
        header("Location: ../perfil.php?img_alter=false");
    }else{//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
        header("Location: ../perfil.php?img_alter=true");
    }

}else{
    header("Location: ../perfil.php?img_alter=imagemvazia");
}

?>