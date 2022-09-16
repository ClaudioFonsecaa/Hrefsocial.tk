<?php

session_start();

ini_set ("display_errors", "1");
error_reporting(E_ALL);

//REQUERER O ACESSO À BASE DE DADOS
require "../../database/connect.php";

if (isset($_POST["email_login"]) && isset($_POST["psw_login"])) {

    $sql = $conn->prepare("SELECT * FROM Utilizador WHERE username = ? OR email = ?");
    $sql->bind_param("ss", $_POST["email_login"], $_POST["email_login"]);
    $sql->execute();
    $row = $sql->get_result();
    $campo = mysqli_fetch_object($row);

    //PASSWORD QUE VEM DO FORM
    $form_psw = $_POST["psw_login"];

    $_SESSION["id"] = $campo->id_user;//INICIALIZAR O ID

    //SE O NOME DE UTILIZADOR ESTIVER ERRADO
    if (mysqli_error($conn)) {

        session_destroy();
        //header error
        header("Location: ../login.php?login=error");


    }else{//SE O NOME DE UTILIZADOR ESTIVER CORRETO E EXISTIR ALGUM RESULTADO
            if (mysqli_num_rows($row) > 0) {


                if($campo->verificada==1) {//CONTA ATIVA

                    //INICIALIZAR AS VARIAVEIS DE SESSÃO----------------------
                    $_SESSION["nome_utilizador"] = $campo->username;;

                    //PASSWORD QUE ESTÁ NA BD
                    $password_db = $campo->password;

                    //USAR A FUNÇÃO PASSWORD VERIFY PARA COMPARAR A FROM_PSW COM A DB_PSW
                    if (password_verify($form_psw, $password_db)) {//SE A PASSWORD ESTIVER CORRETA

                        $_SESSION['userEstado'] = 'ativo';//ALTERAR O ESTADO PARA ATIVO

                        //LIMPAR AS TENTATIVAS DE LOGIN! -------------------------------------------------------------------------------------
                        $sql2 = $conn->prepare("DELETE FROM loginattempts WHERE id_user = ?");
                        $sql2->bind_param("d", $_SESSION["id"]);
                        $sql2->execute();

                        //header sucesso
                        header("Location: ../home.php");

                    } else {//SE A PASSWORD NAO ESTIVER CORRETA E EXISTIR UTILIZADOR

                        $t = time();

                        //ADICIONAR NA TABELA DAS TENTATIVAS DE LOGINS
                        $sql3 = $conn->prepare("Insert into loginattempts (id_user, ip, timestamp) values (?,?,?)");
                        $sql3->bind_param("dss", $_SESSION["id"], $_SERVER['REMOTE_ADDR'], $t);
                        $sql3->execute();

                        //BRUTEFORCE PROTECTION
                        $sql2 = $conn->prepare("SELECT * FROM loginattempts where id_user = ?");
                        $sql2->bind_param("d", $_SESSION["id"]);
                        $sql2->execute();
                        $row2 = $sql2->get_result();

                        //ATINGIU X TENTATIVAS BLOQUEAR DURANTE X TEMPO
                        switch (mysqli_num_rows($row2)) {
                            case 1:
                                session_destroy();
                                //header error
                                header("Location: ../login.php?login=false");
                                break;
                            case 2:
                                session_destroy();
                                //header error
                                header("Location: ../login.php?login=attemp1");
                                break;
                            case 3:
                                session_destroy();
                                //header error
                                header("Location: ../login.php?login=attemp2");
                                break;
                            case 4:
                                session_destroy();
                                //header error
                                header("Location: ../login.php?login=attemp3");
                                break;
                            case 5:
                                $temp = 0;

                                //Gerar um código aleatório
                                $code = substr(md5(uniqid(mt_rand(), true)), 0, 8);

                                //PASSAR O ESTADO DA CONTA PARA BLOQUEADA
                                $sql2 = $conn->prepare("UPDATE utilizador SET verificada = ?, token = ? WHERE id_user = ?");
                                $sql2->bind_param("dsd", $temp, $code, $_SESSION["id"]);
                                $sql2->execute();


                                if (mysqli_error($conn)) {
                                    session_destroy();
                                    echo "Existiu um erro a bloquear o utilizador";
                                } else {
                                    //MANDAR EMAIL COM O TOKEN-----------------------------------------------------------
                                    header("Location: ../../src/verify.php");
                                    break;
                                }
                            case (mysqli_num_rows($row2) > 5):
                                //header error
                                header('Location: ../login.php?login=still_block&id=' . $_SESSION["id"]);
                        }

                    }


                }else if($campo->verificada==0){//CONTA BLOQUEADA
                    //header error
                    header('Location: ../login.php?login=still_block&id=' . $_SESSION["id"]);
                }



            }else{//SE NAO EXISTIREM UTILIZADORES

                session_destroy();
                //header error
                header("Location: ../login.php?login=false");

            }

        }
}
?>


<?php
 //PARTE RELATIVA AO REGISTO -------------------------------------------------------------------------------------------------
if( isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["confpsw"])){

        //VERIFICAR SE JÁ EXISTE O MESMO EMAIL OU MESMO USER
        $sql = $conn->prepare("SELECT * FROM Utilizador WHERE username = ? OR email = ?");
        $sql->bind_param("ss", $_POST["username"], $_POST["email"]);
        $sql->execute();
        $result = $sql->get_result();

        //SE EXISITIR ALGUEM COM A MESMO EMAIL OU USER
        if(mysqli_num_rows($result) > 0){
            //header error - redirecionar para cover back registo-------------------------
            header("Location: ../login.php?registo=exist");

        //SENAO REGISTAR
        }else{

            //bcrypt algorithm , desenhado para mudar de x em x tempo
            $password=password_hash($_POST["psw"], PASSWORD_DEFAULT);

            $sql = $conn->prepare("INSERT INTO Utilizador(username,password,email) VALUES (?,?,?);");
            $sql->bind_param("sss", $_POST["username"], $password, $_POST["email"]);
            $sql->execute();

            mkdir('../../utilizadores/'.$_POST["username"].'', 0777, true);
            mkdir('../../utilizadores/'.$_POST["username"].'/files', 0777, true);
            mkdir('../../utilizadores/'.$_POST["username"].'/pictures', 0777, true);


            if (mysqli_error($conn)) {
                //header error - redirecionar para cover back registo----------------------------
                header("Location: ../login.php?registo=false");
            }else{
                //header sucesso
                header("Location: ../login.php?registo=true");
            }

        }


}
?>
