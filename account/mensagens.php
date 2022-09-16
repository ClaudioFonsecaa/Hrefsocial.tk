
<?php



if(isset($_GET['success'])){

    $message=$_GET['success'];



    if($message=='true'){



        ?>

        <script>



            alert("Agendamento enviado com sucesso!");



        </script>



        <?php



    }else if($message=='false'){



        ?>

        <script>



            alert("Erro ao enviar o e-mail!");



        </script>



        <?php



    }

}

?>



<?php

//CASO EXISTA A MENSAGEM DE SUCESSO OU ERRO DE REGISTO
if(isset($_GET['login'])){

    $message=$_GET['login'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO
    $_SESSION['id']=$_GET['id'];

    switch ($message) {
        case 'true':
            ?>
            <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
                Login efectuado com sucesso!
            </div>
            <?php
            break;
        case 'false':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Utilizador ou password inválida!
            </div>
            <?php
            break;
        case 'attemp1':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Utilizador ou password inválida, 3 tentativas para bloquear a conta!
            </div>
            <?php
            break;
        case 'attemp2':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Utilizador ou password inválida, 2 tentativas para bloquear a conta!
            </div>
            <?php
            break;
        case 'attemp3':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Utilizador ou password inválida, 1 tentativas para bloquear a conta!
            </div>
            <?php
            break;
        case 'error':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Erro por favor tente mais tarde!
            </div>
            <?php
            break;
        case 'falsetoken':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Erro ao ativar a conta!
            </div>
            <?php
            break;
        case 'truetoken':
            ?>
            <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
                Conta reativada com sucesso! Altere as suas credenciais na página do perfil!
            </div>
            <?php
            break;
        case 'block_error':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                Erro a reencaminhar o email de ativação!
            </div>
            <?php
            break;
        case 'reesend':
            ?>
            <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
                [CONTA BLOQUEADA] Enviado email de reativação da conta, verifique o seu email!
            </div>
            <?php
            break;
        case 'still_block':
            ?>
            <!-- PEDIR SE QUER REENVIAR O EMAIL -->


            <script language="JavaScript" type="text/javascript">

                let confirmAction = confirm("Conta bloqueada, deseja reenviar o email para o desbloqueio ?");
                if (confirmAction) {
                    //Enviar novamente o email
                    
                    
                    window.location.href = 'http://hrefsocial.tk/src/verify.php';
                    
                    
                }

            </script>

            <?php
            break;
    }

}

//CASO EXISTA A MENSAGEM DE SUCESSO OU ERRO DE REGISTO
if(isset($_GET['registo'])){

    $message=$_GET['registo'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message=="true"){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Registo efectuado com sucesso!
        </div>
        <?php
    }else if($message=="exist"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Falha na criação , nome de utilizador ou email já existe!
        </div>
    <?php }else if($message=="false"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Falha na criação da conta!
        </div>
    <?php }

}

//CASO EXISTA A MENSAGEM DO DELETE POST
if(isset($_GET['post_deleted'])){

    $message=$_GET['post_deleted'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Post apagado com sucesso!
        </div>
        <?php
    }else if(!$message){   ?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Erro ao apagar o post!
        </div>
        <?php
    }
}


//CASO EXISTA A MENSAGEM DO DELETE POST
if(isset($_GET['post_add'])){

    $message=$_GET['post_add'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Post inserido com sucesso!
        </div>
        <?php
    }else if(!$message){   ?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Erro ao inserir o post!
        </div>
        <?php
    }
}

//CASO EXISTA A MENSAGEM DO ALTER POST
if(isset($_GET['post_alter'])){

    $message=$_GET['post_alter'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Post alterado com sucesso!
        </div>
        <?php
    }else if(!$message){   ?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Erro ao alterar o post!
        </div>
        <?php
    }
}

//CASO EXISTA A MENSAGEM DO ALTER PASSWORD
if(isset($_GET['alter_psw'])){

    $message=$_GET['alter_psw'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message=="true"){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Password alterada com sucesso!
        </div>
        <?php
    }else if($message=="passwordmismatch"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Password's não coicidem ou password antiga errada!
        </div>
    <?php }

}

//CASO EXISTA A MENSAGEM DA ALTERAÇÃO DE IMAGEM DE PERFIL
if(isset($_GET['img_alter'])){

    $message=$_GET['img_alter'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message=="true"){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Imagem de perfil alterada com sucesso!
        </div>
        <?php
    }else if($message=="false"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Existiu um erro ao atualizar a imagem!
        </div>
    <?php }else if($message=="imagemvazia"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Imagem está vazia, insira uma imagem!
        </div>
        <?php }

}

//CASO EXISTA A MENSAGEM DA ALTERAÇÃO DE EMAIL
if(isset($_GET['alter_email'])){

    $message=$_GET['alter_email'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message=="true"){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Email alterado com sucesso!
        </div>
        <?php
    }else if($message=="false"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Existiu um erro ao atualizar o email!
        </div>
    <?php }else if($message=="fields_empty"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Campos vazios, preencha os campos!
        </div>
    <?php }
}

//CASO EXISTA A MENSAGEM DA ALTERAÇÃO DE EMAIL
if(isset($_GET['desvincular'])){

    $message=$_GET['desvincular'];//PASSAR PARA UMA VARIAVEL O QUE VEM DO OUTRO LADO

    if($message=="true"){
        ?>
        <div class="alert alert-success card-header col-md-12 grid-margin" role="alert">
            Conta desvinculada com sucesso!
        </div>
        <?php
    }else if($message=="false"){?>
        <div class="alert alert-danger card-header col-md-12 grid-margin" role="alert">
            Existiu um erro ao desvincular a conta!
        </div>
    <?php }
}
?>
