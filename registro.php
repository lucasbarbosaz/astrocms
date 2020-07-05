<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	$pageid = "registro";
	require_once './geral.php';
	require_once './config/arquivos/registro.php';
	require_once './config/class.recaptchalib.php';
	$Auth::Session_Connected($_SESSION);
	$pagename = "Registro";
?>
<!DOCTYPE html!>
<html lang="pt-Br">
	<head>
		<meta charset="utf-8">
		<title><?php echo $hotel['hotelname']; ?> - Faça amigos, divirta-se e seja famoso!</title>
		<link rel="shortcut icon" href="<?php echo $hotel['site'];?>/favicon.ico?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo $hotel['site'];?>/general/assets/css/style.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site'];?>/general/assets/css/types.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site'];?>/general/assets/css/buttons.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site'];?>/general/assets/css/fonts.css?<?php echo time(); ?>" type="text/css" media="all" />
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
							<div id="index-greeting-label">Seja bem-vindo ou vinda! Atualmente temos <b>0</b> usuários online, que tal se registrar e se juntar a nós e ver tudo oque temos para lhe oferecer?</div>
						</div>
						<form class="margin-none padding-none login" role="form" method="POST" id="register-form">
							<div class="column-separator-left" style="width: 350px">
							<?php if(isset($erros)) { ?>
								<div class="error" id="register-area-header">
									<div class="float-left flex margin-right-md" id="register-area-header-icon">
										<icon icon="warning-blue" class="margin-auto-left-right"></icon>
									</div>
									<label class="white">
										<h3 class="bold">Opps!</h3>
										<h5><?php echo $erros; ?></h5>
									</label>
								</div>
							<?php } else { ?>
								<div id="register-area-header">
									<div class="float-left flex margin-right-md" id="register-area-header-icon">
										<icon icon="warning-blue" class="margin-auto-left-right"></icon>
									</div>
									<label class="white">
										<h3 class="bold">Área de registro</h3>
										<h5>Faça registro para jogar cosnosco!</h5>
									</label>
								</div>
							<?php } ?>
								<div class="flex-column">
									<div id="area-register">
										<div class="margin-bottom-minm">
											<icon icon="frank-head" class="flex float-left" style="top: 5px;left: 7px;margin-right: -34px;"></icon>
											<input type="text" name="username" placeholder="Usuário" class="padding-top-md padding-bottom-md padding-right-min" id="username" register>
										</div>
										<div class="margin-bottom-minm">
											<icon icon="ballong1" class="flex float-left" style="top: 8px;left: 10px;margin-right: -26px;"></icon>
											<input type="text" name="email" placeholder="Endereço de email" class="padding-top-md padding-bottom-md padding-right-min" id="email" register/>
											<h6 class="gray margin-top-minm">Utilize um endereço de e-mail que você obtenha acesso para, caso, aconteça algo com a sua conta.</h6>
										</div>
										<div class="margin-bottom-minm">
											<icon icon="lockg" class="flex float-left" style="top: 6px;left: 7px;margin-right: -35px;"></icon>
											<input type="password" name="password" placeholder="Senha" class="padding-top-md padding-bottom-md padding-right-min" id="password" register/>
										</div>
										<div class="margin-bottom-minm">
											<icon icon="lockg" class="flex float-left" style="top: 6px;left: 7px;margin-right: -35px;"></icon>
											<input type="password" name="rpassword" placeholder="Confirme sua senha" class="padding-top-md padding-bottom-md padding-right-min" id="password" register/>
										</div>
									</div>
									<div class="margin-top-min padding-min gray" id="register-area-continuation-warning">
										<h6>Além de ser obrigatório, a escolha de sexo é essêncial para que ao você se registrar você possa receber o seu cafofo bem decorado e um presente bem legal, além de também identificar o seu gênero de acordo com a sua escolha.</h6>
									</div>
								</div>
							</div>
							<div class="column-separator-right" style="width: 570px;">
								<div class="margin-bottom-min padding-minm" id="index-slides">
									<div id="index-slide">
										<img id="index-slide-image" src="https://images.habbo.com/habbo-web/america/pt/assets/images/app_summary_image-1200x628.85a9f5dc.png" alt="Slide image | Mais do que um jogo" style="width: inherit;"/>
										<div id="index-slide-label">
											<div id="index-slide-label-title">Mais do que um jogo</div>
											<div id="index-slide-label-description">Personagens diferentes, amigos, chats, festas, mascotes virtuais, celebridades, música, shows, decoração, jogos, desafios, atividades de lazer e muito mais...</div>
										</div>
									</div>
								</div>
								<div class="flex float-left">
									<div class="padding-min flex-wrap" id="register-area-continuation">
										<div class="margin-right-min flex-wrap" id="gender-select">
											<div class="margin-right-minm">
												<input type="radio" name="quarto" class="absolute" id="gender-male" value="masculino">
												<label for="gender-male" class="flex" id="select-male">
													<div class="flex-wrap pointer-none" id="label-male">
														<icon icon="male" class="flex float-left margin-right-minm"></icon>
														<h6 class="margin-auto-top-bottom no-select">Sexo masculino</h6>
													</div>
												</label>
											</div>
											<div class="margin-left-minm">
												<input type="radio" name="quarto" class="absolute" id="gender-female" value="feminino">
												<label for="gender-female" class="flex" id="select-female">
													<div class="flex-wrap pointer-none" id="label-female">
														<icon icon="female" class="flex float-left margin-right-minm"></icon>
														<h6 class="margin-auto-top-bottom no-select">Sexo feminino</h6>
													</div>
												</label>
											</div>
										</div>
										<div class="flex-column">
											<div id="result-register-card">
												<div id="result-register-card-habbo">
													<img id="result-register-card-habbo-image" alt="Username" src="<?php echo $hotel['avatarimage'] ?>figure=ha-1015-62.lg-275-1189.sh-290-62.hd-180-1369.ch-215-82&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=wlk,wav" style="z-index: 1;"/>
												</div>
												<div class="margin-bottom-minm" id="result-register-card-display-username">
													<h4 class="white bold text-nowrap">Seu nome aqui!</h4>
												</div>
												<h6 class="white" id="result-register-card-display-gender">Vamos embarcar?</h6>
											</div>
											<div class="margin-top-min" id="register-captcha">
												<div class="g-recaptcha" data-sitekey="<?php echo hybbe('recaptcha'); ?>"></div>
											</div>
										
											<div class="margin-top-min">
												<button class="green-button" type="submit" style="width: 242px;height: 47px;font-size: 15px;">
													<div class="margin-auto white"><b>Vamos nessa!</b></div>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
						<div id="footer"><?php echo $hotel['hotelname']; ?> © <?php echo $hotel['hotel_inauguration']; ?>-<?php echo date("Y"); ?>. Todos os direitos reservados <div class="float-right"><b><?php echo $hotel['cms_name']; ?></b> <?php echo $hotel['cms_version']; ?> | <b>Desenvolvido por</b>: <?php echo $hotel['cms_developers']; ?></div></div>
						</div>
					</div>
				</div>
			</div>
		</container>
	</body>
	<script src="<?php echo $hotel['site']; ?>/general/assets/js/jquery-3.4.1.min.js?<?php echo time(); ?>"></script>
	<script src="<?php echo $hotel['site']; ?>/general/assets/js/hybbe.js?<?php echo time(); ?>"></script>
	<script src='https://www.google.com/recaptcha/api.js?<?php echo time(); ?>'></script>
</html>
