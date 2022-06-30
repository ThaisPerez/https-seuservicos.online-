<?php
require_once('conexao.php');

if ( isset($_POST['txtNome']) && !empty($_POST['txtNome']) &&
    isset($_POST['telefone']) && !empty($_POST['telefone']) &&
    isset($_POST['txtEmail']) && !empty($_POST['txtEmail']) &&
    isset($_POST['txtSenha']) && !empty($_POST['txtSenha']) ) {

    $nome = filter_input(INPUT_POST, 'txtNome');
	$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$is_whatsapp = filter_input(INPUT_POST, 'is_whatsapp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'txtEmail');
    $senha = trim(password_hash($_POST['txtSenha'], PASSWORD_DEFAULT));

    $selec = mysqli_query($con, "SELECT id FROM usuarios where email = '$email'");

    if ( mysqli_num_rows($selec) > 0 ) {
        $_SESSION['type'] = 'info';
        $_SESSION['message'] = 'E-mail já cadastrado!';

        header("Location: cadastro.php");

        exit;
    }

    $cadastar = mysqli_query($con,"INSERT INTO usuarios (nome, telefone, is_whatsapp, email, senha) VALUES ('$nome', '$telefone', '$is_whatsapp', '$email', '$senha')");

    if ( $cadastar ) {
        $query = 'SELECT id, nome, email FROM usuarios WHERE email = "' . $email . '"';
        $usuario = mysqli_query($con, $query);

        $dado = mysqli_fetch_assoc($usuario);
        
        $_SESSION['usuario_logado'] = [
            'id' => $dado['id'],
            'nome' => $dado['nome'],
            'email' => $dado['email']
        ];

        header("Location: index.php");
        exit;
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['message'] = 'Não foi possível efetuar o cadastro!';

        header("Location: cadastro.php");
        exit;
    }
    
    }