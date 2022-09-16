<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";

if (isset($_POST["psw_login"]) && isset($_POST["email"])) {

    //Query para ir buscar a password
    $sql = "SELECT * FROM Utilizador where id_user = ".$_SESSION["id"]."";
    $result = mysqli_query($conn, $sql);
    $r = mysqli_fetch_object($result);
    $password = $r->password;

    //Verificar se a password confere com a da bd
    if(password_verify($_POST["psw_login"], $password)){

        //ATUALIZAR OS DADOS NA BASE DE DADOS
        $sql2 = $conn->prepare("UPDATE utilizador SET email = ? WHERE id_user = ?; ");
        $sql2->bind_param("sd", $_POST["email"], $_SESSION["id"]);
        $sql2->execute();

        //VERIFICAR SE EXISTIU ERROS
        if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
            header("Location: ../perfil.php?alter_email=false");
        }else{//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
            header("Location: ../perfil.php?alter_email=true");
        }

    }else{
        header("Location: ../perfil.php?alter_email=false");
    }

}else{
    header("Location: ../perfil.php?alter_email=fields_empty");
}


?>
