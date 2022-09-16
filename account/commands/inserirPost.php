<?php


ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";

if (isset($_POST["content"]) && isset($_POST["title"])) {


    date_default_timezone_set('Europe/London');
    $data=date('y-m-d h:i:s');

    $tipo_cat = $_POST['id_cat'];

    $sql = $conn->prepare("INSERT INTO Post (id_user,titulo, conteudo, data, id_cat) VALUES  (?,?,?,?,?); ");
    $sql->bind_param("dsssd", $_SESSION["id"], $_POST["title"] , $_POST["content"], $data, $tipo_cat);
    $sql->execute();
    $PostId = $conn -> insert_id;//ultimo id inserido na base de dados

    if(mysqli_error($conn)){
        echo "<script>alert('Não foi possivel inserir o post na bd - erro na query da bd!! :)');</script>";
    }

        $username = $_SESSION['id'];
        $name_file = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];

        $local_image = "../../postagens/$PostId/";

        //CRIAR A PASTA
        mkdir('../../postagens/' . $PostId, 0777, true);


        //CASO INSIRA FICHEIRO
    if($_FILES['file']['name']!=null && $_FILES['file']['tmp_name']!=null) {

        $upload = copy($tmp_name, $local_image . $name_file);  //COPIAR A IMAGEM PARA A PASTA

        //INSERIR NA BASE DE DADOS O CAMINHO DA IMAGEM NO NOSSO PROJETO
        $sql2 = $conn->prepare("UPDATE post SET imagem = ? WHERE id_post = ?; ");
        $sql2->bind_param("sd", $_FILES['file']['name'], $PostId);
        $sql2->execute();

    }

    //Redirecionar consoante a categoria
    switch ($tipo_cat){
        case 1:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../home.php?post_add=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../home.php?post_add=true");
            }
            break;
        case 2:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../education_work.php?post_add=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../education_work.php?post_add=true");
            }
            break;
        case 3:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../games.php?post_add=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../games.php?post_add=true");
            }
            break;
        case 4:
            //VERIFICAR SE EXISTIU ERROS
            if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
                header("Location: ../memes.php?post_add=false");
            } else {//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
                header("Location: ../memes.php?post_add=true");
            }
            break;
    }

}

?>
