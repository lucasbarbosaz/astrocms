<?php
$onlines = $bdd->query("SELECT id FROM players WHERE online = '1'");
$online = $onlines->rowCount();

$bans = $bdd->query("SELECT id FROM bans");
$bans = $bans->rowCount();
?>
