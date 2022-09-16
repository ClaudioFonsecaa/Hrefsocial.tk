<?php
ob_start();

$locerror = "../account/login.php?login=block_error";
$locg = "../account/login.php?login=reesend";

session_start();


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


$user = $_SESSION["id"];


$sql = $conn->prepare("SELECT * FROM Utilizador WHERE id_user = ?");
$sql->bind_param("d", $user);
$sql->execute();
$row = $sql->get_result();
$campo = mysqli_fetch_object($row);

//VARIAVEIS PARA O EMAIL«
$email_token = $campo->email;
$token = $campo->token;


//INICIO DO SERVIÇO MAILING ---------------------------------------------------------------------

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
    $mail->addAddress($email_token , '');

//Set the subject line
    $mail->Subject =  "Link de ativação - #HREF";

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    $mail->CharSet = PHPMailer::CHARSET_UTF8;

    //MENSAGEM DO BODY
    $content = '<div style="text-align:center; border-style: solid; border-color: #15cdf1; font-family: Arial, Helvetica, sans-serif">
    <p><h1>#HREF - Link de ativação</h1></p>
    <p><h4>Por favor clique no link abaixo para ativar a conta!</h4></p>
    <p><a href="http://localhost/Rede_Social_Href/account/ativar.php?token='.$token.'&id='.$user.'" style="color:blue;">http://localhost/Rede_Social_Href/account/ativar.php?token='.$token.'&id='.$user.'</a></p>
    <p><i>Equipa HREF</i></p>
    <p><img src="https://hrefsocial.000webhostapp.com/logo_href_short.png" alt="logo"></p>
    </div>>';

    $mail->msgHTML($content);


    //Tentar enviar o email
    if (!$mail->Send()) {
        //Envio falhou então mostrar mensagem de erro
        //session_destroy();
        //header("Location: ../account/forgot_password.php?message_error=Erro ao atualizar password");
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        header("Location: $locerror");
        ob_end_flush();
    }else{
        header("Location: $locg");
        ob_end_flush();
    }

?>
