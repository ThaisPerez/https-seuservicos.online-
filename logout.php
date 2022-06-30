
<?php

ob_start();
if (!isset($_SESSION))
    session_start();
unset($_SESSION['usuario_logado']);
session_destroy();
header("location:index.php");

?>