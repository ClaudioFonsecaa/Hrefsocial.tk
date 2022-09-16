<?php

session_start();

//REQUERER O ACESSO À BASE DE DADOS
require "../../database/connect.php";

if(!empty($_POST["username"])) {

    $sql = $conn->prepare("SELECT * FROM utilizador WHERE username = ?");
    $sql->bind_param("s", $_POST["username"]);
    $sql->execute();
    $result = $sql->get_result();

    if(mysqli_num_rows($result) > 0) {
        echo "<span style='color:red'> Utilizador já existe! :(</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }else{
        echo "<span style='color:green'> Nome de utilizador disponivel! :)</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }

}

if(!empty($_POST["email"])) {

    $sql = $conn->prepare("SELECT * FROM Utilizador WHERE email = ?");
    $sql->bind_param("s", $_POST["email"]);
    $sql->execute();
    $result = $sql->get_result();

    if(mysqli_num_rows($result) > 0) {
        echo "<span style='color:red'> Este email já foi utilizado numa conta! :(</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }

}
?>
