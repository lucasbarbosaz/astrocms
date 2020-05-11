<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	$pageid = "index";
	require_once './geral.php';
	if(isset($_POST['username']) && isset($_POST['password'])){
	        if(!empty($_POST['username']) || !empty($_POST['password'])) {
	        try {
	            $password = isset($_POST['password']) ? md5($_POST['password']) : '';
	            $username = isset($_POST['username']) ? safe($_POST['username'],'SQL') : '';
	            $Auth::Login($username, $password, 'false', $table['BanSQL']);
	            } catch(Exception $e){
	        $erros = $e->getMessage() AND $erro = true;
	    }
	        }else{
	            $erros = 'Preencha os campos para logar' AND $erro = true;
	        }  
	}

	//require_once './config/arquivos/registro.php';
	$Auth::Session_Connected($_SESSION);
	$page_desc = "Crie um avatar, construa o seu quarto e divirta-se com os seus amigos";
?>
<!DOCTYPE html!>
<html lang="pt-Br">
	<head>
		<meta charset="utf-8">
		<title><?php echo $hotel['hotelname']; ?>: <?php echo $page_desc; ?></title>
		<link rel="shortcut icon" href="<?php echo $hotel['site']; ?>/favicon.ico?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/style.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/types.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/buttons.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/fonts.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
	</head>
	<body class="grid-template-rows">
		<header>
			<div id="header">
				<div class="webcenter">
					<div id="header-logo"></div>
				</div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div class="border-box no-select" id="index-greeting">
							<div id="index-greeting-icon"></div>
							<div id="index-greeting-label">Seja bem-vindo ou vinda! Atualmente temos <b>0</b> usuários online, que tal se juntar a nós e ver tudo oque temos para lhe oferecer?</div>
						</div>
						<div class="column-separator-left" style="width: 350px;">
						<?php if ($erro == true) { ?>
							<div class="error" id="login-area-header">
								<div class="float-left flex margin-right-md" id="login-area-header-icon">
									<icon icon="warning-blue" class="margin-auto-left-right"></icon>
								</div>
								<label class="white">
									<h3 class="bold">Opps!</h3>
									<h5><?php echo $erros; ?></h5>
								</label>
							</div>
						<?php } else { ?>
							<div id="login-area-header">
								<div class="float-left flex margin-right-md" id="login-area-header-icon">
									<icon icon="warning-blue" class="margin-auto-left-right"></icon>
								</div>
								<label class="white">
									<h3 class="bold">Área de Login</h3>
									<h5>Faça login para jogar conosco!</h5>
								</label>
							</div>
						<?php } ?>
							<form class="flex-column" id="area-login" role="form" method="POST" class="login">
								<div class="margin-top-min flex" id="login-username">
									<icon icon="frank-head" style="position: relative;top: 5px;left: 8px;margin-right: -34px;"></icon>
									<input name="username" type="text" class="padding-md" id="username" placeholder="Usuário">
								</div>
								<div class="flex margin-top-min" id="login-password">
									<icon icon="lockg" style="position: absolute;top: 6px;left: 8px;"></icon>
									<input name="password" type="password" class="padding-md" id="password" placeholder="Senha">
									<button class="green-button float-right margin-left-min uppercase" id="login-submit" name="login" type="submit" style="width: 160px;height: 47px;font-size: 15px;">
										<div class="margin-auto white bold">Entrar</div>
									</button>
								</div>
							</form>
							<div class="margin-top-min" id="register-index-box">
								<a href="<?php echo $hotel['site']; ?>/registro" class="green-button" style="position: absolute;width: 150px;height: 55px;right: 10px;font-size: 13px;">
									<label class="margin-auto white pointer-none">
										<b>Registre-se grátis<br>agora mesmo!</b>
									</label>
								</a>
							</div>
						</div>
						<div class="column-separator-right" style="width: 570px;">
							<div id="index-slides">
								<div id="index-slide">
									<img id="index-slide-image" src="https://images.habbo.com/habbo-web/america/pt/assets/images/app_summary_image-1200x628.85a9f5dc.png" alt="Slide image | Mais do que um jogo" style="width: inherit;"/>
									<div id="index-slide-label">
										<div id="index-slide-label-title">Mais do que um jogo</div>
										<div id="index-slide-label-description">Personagens diferentes, amigos, chats, festas, mascotes virtuais, celebridades, música, shows, decoração, jogos, desafios, atividades de lazer e muito mais...</div>
									</div>
								</div>
							</div>
							<div id="index-hall-of-fame">
								<div id="index-hall-of-fame-divider">
									<div id="index-hall-of-fame-icon"></div>
									<div id="index-hall-of-fame-divider-title">Hall <br>da fama</div>
									<div id="index-hall-of-fame-divider-dacription">Saiba quem são os tops 2 ricos do hotel!</div>
								</div>
								<div>
                                    
                                    <?php $r = mysql_query("SELECT username,figure,vip_points,id FROM players WHERE rank < 4 ORDER BY vip_points DESC LIMIT 1");
                                    while($s = mysql_fetch_assoc($r)){?>
									<div id="index-hall-of-fame-box">
										<div id="index-hall-of-fame-box-avatar">
											<img alt="Username" src="https://hybbe.top/habbo-imaging/avatarimage.php?figure=<?php echo $s['figure'];?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=2&action=std" style="position: relative;left: -3px;top: -16px;z-index: 1;"/>
										</div>
										<div id="index-hall-of-fame-box-label">
											<strong id="index-hall-of-fame-box-label-username"><?php echo $s['username'];?></strong>
											<div id="index-hall-of-fame-box-label-amount">Possui <?php echo $s['vip_points'];?> rubys</div>
										</div>
									</div>
                                    <?php } ?>
									<div id="index-hall-of-fame-box">
                                        <?php $r = mysql_query("SELECT username,figure,activity_points,id FROM players WHERE rank < 4 ORDER BY activity_points DESC LIMIT 1");
                                        while($s = mysql_fetch_assoc($r)){
                                        ?>
										<div id="index-hall-of-fame-box-avatar">
											<img alt="Username" src="https://hybbe.top/habbo-imaging/avatarimage.php?figure=<?php echo $s['figure'];?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=2&action=std" style="position: relative;left: -3px;top: -16px;z-index: 1;"/>
										</div>
										<div id="index-hall-of-fame-box-label">
											<strong id="index-hall-of-fame-box-label-username"><?php echo $s['username'];?></strong>
											<div id="index-hall-of-fame-box-label-amount">Possui <?php echo $s['activity_points'];?> gemas</div>
										</div>
									</div>
                                    <?php } ?>
								</div>
							</div>
						</div>
						<div class="border-box" id="footer">© 2019 Hybbe Hotel. Todos os direitos reservados a seus respectivos donos. <div class="float-right"><b>Hylib</b> 0.0.2</div></div>
					</div>
				</div>
			</div>
		</container>
		<script src="<?php echo $hotel['site']; ?>/general/assets/js/jquery-3.4.1.min.js?<?php echo time(); ?>"></script>
	<script src="<?php echo $hotel['site']; ?>/general/assets/js/hybbe.js?<?php echo time(); ?>"></script>
	<script src='https://www.google.com/recaptcha/api.js?<?php echo time(); ?>'></script>
	</body>	
</html>