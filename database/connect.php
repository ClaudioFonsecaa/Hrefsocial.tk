<?php

$server = "";
$database = "";
$user = "";
$pass = "";

$conn = new mysqli($server,$user,$pass,$database) or die ("Não foi possível ligar à base de dados!");

?>