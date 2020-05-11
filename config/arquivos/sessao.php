<?php
if(isset($_SESSION['username'])) {
$username = safe($_SESSION['username'],'SQL');
$password = safe($_SESSION['password'],'SQL');
$req = $bdd->prepare("SELECT * FROM players WHERE username = :username AND password = :password LIMIT 1");
$req->execute(Array(":username" => $username, ":password" => $password));
if($req->rowCount() < 0) {
session_destroy();
Redirect(URL);
}
}
?>