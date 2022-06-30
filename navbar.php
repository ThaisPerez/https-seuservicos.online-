<?php
    if ( isset($_SESSION['usuario_logado']) && !empty($_SESSION['usuario_logado']) &&
        isset($_SESSION['usuario_logado']['id']) && !empty($_SESSION['usuario_logado']['id']) && 
        isset($_SESSION['usuario_logado']['nome']) && !empty($_SESSION['usuario_logado']['nome']) &&
        isset($_SESSION['usuario_logado']['email']) && !empty($_SESSION['usuario_logado']['email']) ) {
          $link_login_cadastro = 'anunciar.php';
          $texto_login_anunciar = 'Anunciar';
            } else {
          $link_login_cadastro = 'login.php';
          $texto_login_anunciar = 'Login';
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Serviço Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />

<style>
    
</style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container">
          <a class="navbar-brand" href="./index.php">
          <img src="img/logo.png" width="100" height="100" alt="Logo" href="./index.php">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="<?php echo $link_login_cadastro; ?>"><?php echo $texto_login_anunciar; ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Início </a>

                <li class="nav-item">
                <a class="nav-link" href="logout.php">Sair </a>

                </li>
            </ul>
          </div>
      
        </div>
      </nav>
