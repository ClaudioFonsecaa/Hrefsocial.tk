<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";



if (isset($_POST["old_psw_login"]) && isset($_POST["new_psw_login"]) && isset($_POST["new2_psw_login"])) {


        //Query para ir buscar a password antiga
        $sql = "SELECT * FROM Utilizador where id_user = ".$_SESSION["id"]."";
        $result = mysqli_query($conn, $sql);
        $r = mysqli_fetch_object($result);
        $password_old_bd = $r->password;
        $password_old_form = $_POST["old_psw_login"];
        $password_new=password_hash($_POST["new_psw_login"], PASSWORD_DEFAULT);

        //Verificar se as passwords conferem e a antiga confere
        if($_POST["new_psw_login"] == $_POST["new2_psw_login"] && password_verify($password_old_form, $password_old_bd)){

            //ATUALIZAR OS DADOS NA BASE DE DADOS
            $sql2 = $conn->prepare("UPDATE utilizador SET password = ? WHERE id_user = ?; ");
            $sql2->bind_param("sd", $password_new, $_SESSION["id"]);
            $sql2->execute();

            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../perfil.php?alter_psw=false");
            }else{//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../perfil.php?alter_psw=true");
            }

        }else{
            header("Location: ../perfil.php?alter_psw=passwordmismatch");
        }

}

?>
