<?php 
session_start();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Porto_Velho');

require 'vendor/autoload.php';

$DB_USERNAME="root";
$DB_PASSWORD="";
$DB_NAME="anuncios";
$con = mysqli_connect('localhost', $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (mysqli_connect_errno()) {
    printf("Erro: %s\n", mysqli_connect_error());
    exit();
}