<?php
require $_SERVER['DOCUMENT_ROOT'] . "/database/connect.php";

$sql = "SELECT * FROM Post WHERE `id_post` = " . $_GET["id"];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Ficheiro não existe.");
}
$row = mysqli_fetch_object($result);

header("Content-type: image/png");
echo $row->foto;


?>