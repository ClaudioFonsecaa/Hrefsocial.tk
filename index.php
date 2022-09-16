<?php

session_start();

if($_SESSION['userEstado']!='ativo'){

    header("Location: account/login.php");

}else if($_SESSION['userEstado']=='ativo'){

    header("Location: account/home.php");
}

?>