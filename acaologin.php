<?php
include("conexao.php");

if ( isset($_POST['submit']) &&
    isset($_POST['txtEmail']) && !empty($_POST['txtEmail']) &&
    isset($_POST['txtSenha']) && !empty($_POST['txtSenha']) ) {
    $textEmail = filter_input(INPUT_POST, 'txtEmail');
    $textSenha = filter_input(INPUT_POST, 'txtSenha');

    $selec = mysqli_query($con, "SELECT id, nome, email, senha FROM usuarios where email = '$textEmail'");

    if ( mysqli_num_rows($selec) > 0 ) {
        $dado = mysqli_fetch_array($selec);

        if ( password_verify($textSenha, $dado['senha']) ) {
            $_SESSION['usuario_logado'] = [
                'id' => $dado['id'],
                'nome' => $dado['nome'],
                'email' => $dado['email']
            ];

            header("Location: index.php");
        } else {
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Senha Inválida';
            
            header("Location: login.php");
        }
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['message'] = 'Usuário Inválido';

        header("Location: login.php");
    }
}  else {
   
   

    header("Location: recuperar.php");
}
