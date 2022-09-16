<?php
session_start();
$_SESSION = array();
session_destroy();
echo "    <meta charset='utf-8'> <script javalanguage='script' type='text/javascript'> alert('Saiu da área restrita com sucesso.'); window.location.replace('../index.php'); </script>";

?>