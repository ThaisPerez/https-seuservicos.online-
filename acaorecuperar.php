<?php
require_once('./conexao.php');

if ( isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['token']) && !empty($_POST['token']) ) {
    $senha = trim(password_hash($_POST['senha'], PASSWORD_DEFAULT));
    $token = filter_input(INPUT_POST, 'token');
    $data_hora = date('Y-m-d H:i:s');

    $data_hora = date('Y-m-d H:i:s');
    $data_hora_final = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime($data_hora)));

    $selec = mysqli_query($con, "SELECT * FROM token where token = '$token' AND usado = 0 AND '$data_hora' BETWEEN data_hora_inicial AND data_hora_final");

    if ( mysqli_num_rows($selec) > 0 ) {
        $dado = mysqli_fetch_array($selec);
        $id = $dado['usuario_id'];

        $selec = mysqli_query($con, "UPDATE usuarios SET senha = '$senha' where id = '$id'");
        mysqli_query($con, "UPDATE token SET usado = '$senha' where id = " . $dado['id']);
     
        $_SESSION['type'] = 'success';
        $_SESSION['message'] = 'Senha redefinida com sucesso!';

        header("Location: login.php");
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['message'] = 'Token inválido!';

        header("Location: login.php");
    }
}  else {
    $_SESSION['type'] = 'info';
    $_SESSION['message'] = 'Campos obrigatórios não foram preenchidos!';

    header("Location: login.php");
}