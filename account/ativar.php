<?php

ob_start();

ini_set ("display_errors", "1");
error_reporting(E_ALL);

//REQUERER O ACESSO À BASE DE DADOS
require "../database/connect.php";

$token=$_GET['token'];//RECEBER O TOKEN DO LINK
$user=$_GET['id'];//RECEBER O USER DO LINK

$sql = $conn->prepare("SELECT * FROM utilizador WHERE id_user = ? and token = ?");
$sql->bind_param("dd", $user, $token);
$sql->execute();
$row = $sql->get_result();
$campo = mysqli_fetch_object($row);

//SE O NOME DE UTILIZADOR ESTIVER ERRADO
        if (mysqli_error($conn)) {

            session_destroy();
            //header error
            header("Location: login.php?login=falsetoken");

        }else{//SE O NOME DE UTILIZADOR ESTIVER CORRETO E TOKEN
            if (mysqli_num_rows($row) > 0) {
                //SEGUNDA VERIFICAÇÃO AO TOKEN--------------
                $id_user_token = $campo->id_user;
                $token_bd = $campo->token;

                if($id_user_token==$user && $token_bd==$token){

                    $temp=1;

                    //DESBLOQUEAR A CONTA
                    $sql2 = $conn->prepare("UPDATE utilizador SET verificada = ? WHERE id_user = ?; ");
                    $sql2->bind_param("dd", $temp, $user);
                    $sql2->execute();

                    if(mysqli_error($conn)){
                        
                        //header error
                        header("Location: login.php?login=falsetoken");
                         ob_end_flush();
                    }else{
                       

                        //LIMPAR A TABELA DOS ATEMPETS
                        $sql3 = $conn->prepare("DELETE FROM loginattempts WHERE id_user = ?");
                        $sql3->bind_param("d", $user);
                        $sql3->execute();

                        //header error
                        header("Location: login.php?login=truetoken");
                         ob_end_flush();
                    }

                }else{
                   
                    //header error
                    header("Location: login.php?login=falsetoken");
                     ob_end_flush();

                }
            }
        }
?>