<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	define('CORE','CORE');
	@session_start();
	include_once(dirname(__FILE__)."/config/config.php");
	require_once(dirname(__FILE__)."/config/classes/class.pdo.php");
	require_once(dirname(__FILE__)."/config/classes/class.mysql.php");
	require_once(dirname(__FILE__)."/config/arquivos/bdd.php");
	require_once(dirname(__FILE__)."/config/functions.php");
	require_once(dirname(__FILE__)."/config/core.php");
	$Config->manutencao($pageid, $page, $User->rank);
	$Auth->BanIP($table['BanSQL'], $Auth::IP(), $pageid);

	// Puxando as configurações do hotel através da tabela hybbe_geral
	$hotel_config = $bdd->query("SELECT * FROM hybbe_geral");
	$hotel = $hotel_config->fetch(PDO::FETCH_ASSOC);

	// Puxando informações do usuários através da tabela players
	$users = $bdd->query("SELECT * FROM players WHERE username = '" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "' LIMIT 1");
	$user = $users->fetch(PDO::FETCH_ASSOC);

	header("Content-Type: text/html; charset=utf-8", true);
	setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
	date_default_timezone_set('America/Sao_paulo');
?>