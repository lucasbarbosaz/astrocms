<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');
	$pageid = "";
?>
<!DOCTYPE html!>
<html lang="pt-Br">
	<head>
		<meta charset="utf-8">
		<title> - <?php echo $hotel['hotelname']; ?></title>
		<link rel="shortcut icon" href="<?php echo $hotel['site']; ?>/favicon.ico?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/style.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/types.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/buttons.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/fonts.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet"/>
	</head>
	<body class="grid-template-rows">
		<header>
			<div id="header">
				<div class="webcenter" header>
					<div id="notification-area">
						<div id="notification-indicator">
							<text class="margin-auto-top-bottom">Você não tem novas notificações!</text>
						</div>
					</div>
					<div id="header-logo"></div>
					<div class="margin-auto-top-bottom" id="header-interactions">
						<div id="header-onlines">0 hybbe's online</div>
						<a href="" class="green-button-2" style="width: 165px;height: 32px;font-size: 13px;-webkit-filter: drop-shadow(-4px 0 0 rgba(0, 0, 0, 0.15));">
							<div class="green-button-label-2">
								<div class="margin-auto white">Entrar no Hotel</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div id="header-menu">
				<div class="webcenter space-between">
					<nav id="header-menu-area">
						<ul id="header-menu-left">
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/principal" id="header-menu-button">Principal</a>
							</li>
							<?php 
								$menunewsid = $bdd->query("SELECT * FROM habbo_news ORDER BY id LIMIT 1,1");
								$row_count = $menunewsid->rowCount();

								if ($row_count > 0) {
									while ($rownews = $menunewsid->fetch(PDO::FETCH_ASSOC)) {
							?>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/noticia/<?php echo $rownews['id']; ?>" id="header-menu-button">Notícias</a>
							</li>
							<?php } } ?>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/comunidade" id="header-menu-button">Comunidade</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/loja" id="header-menu-button">Loja</a>
							</li>
						</ul>
						<ul id="header-menu-right">
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/perfil/<?php echo $user['username']; ?>" id="header-menu-button">Minha página</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/referencias" id="header-menu-button">Referências</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/configuracoes" id="header-menu-button">Configurações</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/sair" id="header-menu-button">Sair</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div id="header-other-area">
				<div class="webcenter"></div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content"></div>
					<div id="footer"><?php echo $hotel['hotelname']; ?> © <?php echo $hotel['hotel_inauguration']; ?>-<?php echo date("Y"); ?>. Todos os direitos reservados <div class="float-right"><b><?php echo $hotel['cms_name']; ?></b> <?php echo $hotel['cms_version']; ?> | <b>Desenvolvido por</b>: <?php echo $hotel['cms_developers']; ?></div></div>
				</div>
			</div>
		</container>
		<script src="<?php echo $hotel['site']; ?>/general/assets/js/jquery-3.4.1.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo $hotel['site']; ?>/general/assets/js/hybbe.js?<?php echo time(); ?>"></script>
	</body>
</html>