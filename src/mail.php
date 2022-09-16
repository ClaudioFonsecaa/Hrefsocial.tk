<?php
ob_start();

session_start();

ini_set ("display_errors", "1");
error_reporting(E_ALL);

/**
 * This example shows how to send via Google's Gmail servers using XOAUTH2 authentication
 * using the league/oauth2-client to provide the OAuth2 token.
 * To use a different OAuth2 library create a wrapper class that implements OAuthTokenProvider and
 * pass that wrapper class to PHPMailer::setOAuth().
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//DADOS DA DATABASE
require "../database/connect.php";

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Load dependencies from composer
//If this causes an error, run 'composer install'
require '../PHPMailer/vendor/autoload.php';



//SE EXISTIR A VARIAVEL EMAIL RECOVER INICIAL DE RECUPERAR A PASSWORD
if(isset($_POST["email_form"]) && !isset($_POST["code"])) {


//EMAIL QUE VEM DO FORMULÁRIO DE RECUPERAÇÃO POR NUMA VARIAVEL
    $email_recuperacao = $_POST["email_form"];


//Verificar se o utilizador existe
    $sql = $conn->prepare("SELECT * FROM Utilizador WHERE email  = ?");
    $sql->bind_param("s", $email_recuperacao);
    $sql->execute();


//Se a query retorna 0 resultados é porque o utilizador não existe
    if (mysqli_num_rows($sql->get_result()) == 0) {
        //Apagamos os dados da sessão
        session_destroy();
        //Voltamos para a pagina forgot password e mostramos o erro
        header("Location: ../account/forgot_password.php?message_error=NA");
        return;
    }


//Gerar um código aleatório
    $code = substr(md5(uniqid(mt_rand(), true)), 0, 8);


//Guardar na sessão o email e o código enviado
    $_SESSION["recover_code"] = $code;
    $_SESSION["recover_email"] = $email_recuperacao;


    //INICIO DO SERVIÇO MAILING

//Create a new PHPMailer instance
    $mail = new PHPMailer();

//Tell PHPMailer to use SMTP
    $mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
    $mail->Port = 465;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
    $mail->SMTPAuth = true;

//Set AuthType to use XOAUTH2
    $mail->AuthType = 'XOAUTH2';

//Start Option 1: Use league/oauth2-client as OAuth2 token provider
//Fill in authentication details here
//Either the gmail account owner, or the user that gave consent
    $email = '';
    $clientId = '';
    $clientSecret = '';

//Obtained by configuring and running get_oauth_token.php
//after setting up an app in Google Developer Console.
    $refreshToken = '';

//Create a new OAuth2 provider instance
    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );

//Pass the OAuth provider instance to PHPMailer
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]
        )
    );
//FIM DAS INFOMRAÇÕES DO GOOGLE MAIL API


//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
    $mail->setFrom("", "REDE SOCIAL #HREF - A TUA REDE");

//Set who the message is to be sent to
    $mail->addAddress($email_recuperacao, '');

//Set the subject line
    $mail->Subject =  "Código de recuperação da password - #HREF";

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    $mail->CharSet = PHPMailer::CHARSET_UTF8;

    //MENSAGEM DO BODY

    $content = '<div style="text-align:center; border-style: solid; border-color: #15cdf1; font-family: Arial, Helvetica, sans-serif">
<p><h1>#HREF - Código de recuperção</h1></p>
<p><h4>Introduza o código abaixo no campo referido da aplicaçao e escolha a sua nova password pretendida!</h4></p>
<p><h3 style="color:blue;">'.$code.'</h3></p>
<p><i>Equipa HREF</i></p>
<p><img src="https://hrefsocial.000webhostapp.com/logo_href_short.png" alt="logo"></p>
</div>';


    $mail->msgHTML($content);


    //Tentar enviar o email
    if (!$mail->Send()) {
        //Envio falhou então mostrar mensagem de erro
        //session_destroy();
        //header("Location: ../account/forgot_password.php?message_error=Erro ao atualizar password");
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        ob_end_flush();
    } else {
        //Envio com sucesso ir para Recuperar password novamente e pedir o codigo e a nova password
        header("Location: ../account/forgot_password.php?recover=true");
        ob_end_flush();
    }


    //CASO JÁ TENHA INTRODUZIDO O CÓDIDGO - QUERYS PARA ALTERAR A PASSWORD
}else if(isset($_POST["email_form"]) && isset($_POST["code"]) && isset($_POST["psw"]) && isset($_POST["confpsw"])){

        //VERIFICAR SE A PASSWORD E A REPITA PASSWORD COINCIDEM E O CÓDIGO GERADO COINCIDE TAMBÉM COM O INTRODUZIDO
        if($_POST["psw"] == $_POST["confpsw"] && $_POST["code"] == $_SESSION["recover_code"]){


            $password=password_hash($_POST["psw"], PASSWORD_DEFAULT);

            //Passwords iguais e codigo de recuperacao for igual
            $sql = $conn->prepare("UPDATE Utilizador SET password = ?  WHERE email = ?");
            $sql->bind_param("ss", $password, $_SESSION["recover_email"]);
            $sql->execute();

            if(mysqli_error($conn)){
                //Recuperacao de password falhou por não ser possível executar a query
                session_destroy();
                header("Location: ../account/forgot_password.php?message_error=error");
                ob_end_flush();
            }else{
                //Recuperacao com sucesso
                header("Location: ../account/forgot_password.php?message_error=false");
                ob_end_flush();
            }

        }else{
            //PASSWORD DIFERENTES OU CODIGO DE RECUPERACAO INVÁLIDO.
            session_destroy();
            header("Location: ../account/forgot_password.php?message_error=passwordmismatch");
            ob_end_flush();
        }



}
?>