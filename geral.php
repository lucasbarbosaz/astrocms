<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 0);
	ini_set('error_reporting', E_ALL);
	ini_set('display_startup_errors', 0);
	define('CORE','CORE');
	
	if (!isset($_SESSION)) {
		session_start();
	}
	
	include_once("/config/config.php");
	require_once("/config/classes/class.pdo.php");
	require_once("/config/classes/class.mysql.php");
	require_once("/config/arquivos/bdd.php");
	require_once("/config/functions.php");
	require_once("/config/core.php");

	
	
	$Config->manutencao($pageid, $page, $User->rank);
	$Auth->BanIP($table['BanSQL'], $Auth::IP(), $pageid);

	// Puxando as configurações do hotel através da tabela hybbe_geral
	try{
		$hotel_config = $bdd->query("SELECT * FROM hybbe_geral");
		$hotel = $hotel_config->fetch(PDO::FETCH_ASSOC);
	}catch(Exception $e){
		return FALSE;
	}

	//DEFINICOES

	//define('AVATARIMAGE', $Hotel::Settings('avatarimage');
	define('TIME', time());
	//define('HOTELNAME', $Hotel::Settings('hotelname'));
	define('USERS', Onlines());
	define('URL', $_SERVER['HTTP_HOST']);
	define('CDN', URL . '/general');
	// rank minimo
	define('RANK_MIN', '5');

	// Puxando informações do usuários através da tabela players
	if(!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
		$users = $bdd->prepare("SELECT * FROM players WHERE username = ? AND password = ? LIMIT 1");
		$users->bindValue(1, $_SESSION['username']);
		$users->bindValue(2, $_SESSION['password']);
		$users->execute();

		if($users->rowCount() > 0){
			$user = $users->fetch(PDO::FETCH_ASSOC);

			define('USERNAME', $user['username']);
		}
	}

	header("Content-Type: text/html; charset=utf-8", true);
	setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
	date_default_timezone_set('America/Sao_paulo');
?>
