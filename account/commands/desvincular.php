<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

require "../../database/connect.php";

if (isset($_POST["desvincular"])) {

            echo $_SESSION["id"];

            //APAGAR TODOS OS POST DO UTILIZADOR-----------------------------------------------------------------------------------------------
            //verificar os post que o utilizador possui
            $sql = $conn->prepare("SELECT * from post WHERE id_user = ?");
            $sql->bind_param("d", $_SESSION["id"]);
            $sql->execute();
            $row = $sql->get_result();

            if(mysqli_num_rows($row) > 0){
                while($r = mysqli_fetch_assoc($row)) {

                    $posts_user=$r['id_post'];//VARIAVEL QUE TEM O ID DOS POSTS QUE PERTECE AO USER QUE VAI DESVINCULAR

                    $sql2 = $conn->prepare("DELETE FROM post WHERE id_post = ?");
                    $sql2->bind_param("d", $posts_user);
                    $sql2->execute();

                    //APAGAR O DIRETORIO DO POST DO UTILIZADOR
                    //NOTA - COMO O DIRETORIO SO É APAGADO CASO ESTEJA VAZIO TEMOS QUE FAZER UNLINK A TODOS OS FICHEIROS LA DENTRO
                    $files = glob('../../postagens/'.$posts_user.'/*');
                    foreach($files as $file){
                        if(is_file($file))
                            unlink($file);
                    }
                    //APAGAR O DIRETORIO
                    $diretorio = '../../postagens/'.$posts_user.'';
                    rmdir($diretorio);
                    echo $diretorio;
                }
            }

            //APAGAR UTILIZADOR-----------------------------------------------------------------------------------------------
            $sql = $conn->prepare("DELETE FROM utilizador WHERE id_user = ?");
            $sql->bind_param("d", $_SESSION["id"]);
            $sql->execute();

            //NOTA - COMO O DIRETORIO SO É APAGADO CASO ESTEJA VAZIO TEMOS QUE FAZER UNLINK A TODOS OS FICHEIROS LA DENTRO
            $files = glob('../../utilizadores/'.$_SESSION["nome_utilizador"].'/pictures/*');
            foreach($files as $file){
                if(is_file($file))
                    unlink($file);
            }

            //APAGAR O DIRETORIO DO UTILIZADOR
            rmdir('../../utilizadores/'.$_SESSION["nome_utilizador"].'/files');
            rmdir('../../utilizadores/'.$_SESSION["nome_utilizador"].'/pictures');
            rmdir('../../utilizadores/'.$_SESSION["nome_utilizador"].'');


    if (mysqli_error($conn)) {//CASO DE ERRO ENVIAR A INFORMAÇÃO DE ERRO
        header("Location: ../login.php?desvincular=false");
    }else{//CASO DE NÃO ERRO ENVIAR A INFORMAÇÃO DE SUCESSO
        //DESTRUIR AS VARIAVEIS DE SESSSÃO
        session_destroy();
        header("Location: ../login.php?desvincular=true");
    }
}
?>
