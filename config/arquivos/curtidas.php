<?php
session_start();
require_once '../../geral.php';
$idPost = $_GET['id'];

$adiciona = "INSERT INTO hybbe_curtidas (id_post) VALUES('$idPost')";

if(mysql_query($adiciona)){
    echo "<script>window.history.back();</script>";
}else{
    echo "Erro ao curtir";
}
?>