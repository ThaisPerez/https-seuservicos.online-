<?php
require_once('./conexao.php');
require_once('./navbar.php');
  include './footer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ( isset($_POST['email']) && !empty($_POST['email']) ) {
    $email = filter_input(INPUT_POST, 'email');

    $selec = mysqli_query($con, "SELECT id, nome, email, senha FROM usuarios where email = '$email'");

    if ( mysqli_num_rows($selec) > 0 ) {
        $dado = mysqli_fetch_array($selec);

        $usuario_id = $dado['id'];

        $mail = new PHPMailer();
        $mail->setLanguage('br');                             
        $mail->CharSet='UTF-8';                              
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "seusservicosonline@gmail.com";
        $mail->Password = 'iguytpzpczzpjdjt';
        $mail->SMTPDebug = false;


        $mail->IsHTML(true);
        $mail->AddAddress($dado['email'], $dado['nome']);
        $mail->SetFrom($dado['email'], 'Suporte');

        $mail->Subject = "Recuperação de senha";

        $data_hora = date('Y-m-d H:i:s');
        $data_hora_final = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime($data_hora)));
        $token = crypt($data_hora . $data_hora_final, mt_rand());

        $content = '<b><a href="//seuservicos.online//recuperar.php?token=' . $token . '" title="Recuperar Senha">Clique Aqui</a> para recuperar senha </b>';

        $mail->MsgHTML($content);

        if( !$mail->Send() )
          var_dump($mail);
        else
     echo "<center>E-mail enviado com sucesso!</center>";

          $sql = "insert into token (usuario_id, token, usado, data_hora_inicial, data_hora_final) values ('$usuario_id', '$token', '0', '$data_hora', '$data_hora_final')";
          mysqli_query($con, $sql);
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['message'] = 'E-mail não cadastrado!';

        header("Location: login.php");
    }
}  else {
  $_SESSION['type'] = 'info';
  $_SESSION['message'] = 'Campos obrigatórios não foram preenchidos!';

  header("Location: login.php");
}

   