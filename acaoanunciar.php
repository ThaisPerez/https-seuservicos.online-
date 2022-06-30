<?php
include('./conexao.php');
include('./functions.php');

if ( isset($_POST['submit']) &&
    isset($_FILES['file']['name']) && !empty($_FILES['file']['name']) &&
    isset($_POST['descricao']) && !empty($_POST['descricao']) &&
    isset($_POST['preco']) && !empty($_POST['preco']) ) {
    $usuario_id = $_SESSION['usuario_logado']['id'];
	$preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$descricao = addslashes(filter_input(INPUT_POST, 'descricao'));
    $preco = str_replace(['.', ','], ['', '.'], $preco);

    $diretorio = 'uploads/anuncios/';
    $imagem = $_FILES['file']['tmp_name'];
    $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    $extensoes_permitidas =array('jpeg', 'jpg','png');
    if ( in_array($extensao, $extensoes_permitidas) ) {
        $upload_imagem = uploadImagens($diretorio, $imagem, $extensao, 1300, 800);

        $sql = "insert into anuncios (usuario_id, imagem, preco, descricao) values ('$usuario_id', '$upload_imagem', '$preco', '$descricao')";

        if (!mysqli_query($con, $sql)) {
            $_SESSION['type'] = 'danger';
            $_SESSION['message'] = 'Erro ao inserir anuncio!';
            
            header("Location: anunciar.php");
        }

        $_SESSION['type'] = 'success';
        $_SESSION['message'] = 'Anuncio inserido com sucesso!';
        
        header("Location: index.php");
    } else {
        $_SESSION['type'] = 'info';
        $_SESSION['message'] = 'Tipo de arquivo não permitido!';

        header("Location: anunciar.php");
    }
} else {
    $_SESSION['type'] = 'info';
    $_SESSION['message'] = 'Campos obrigatórios não foram preenchidos!';

    header("Location: anunciar.php");
}