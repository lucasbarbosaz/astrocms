<?php
	require_once '../../geral.php';

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');
	$pageid = "client/jogando";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Client: Jogando - <?php echo $hotel['hotelname']; ?></title>
		<link rel="shortcut icon" href="<?php echo $hotel['site']; ?>/favicon.ico?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/style.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/types.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/buttons.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/fonts.css?<?php echo time(); ?>" type="text/css" media="all" />
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet"/>
	</head>
	<body>
		<div id="client-container">
			<div class="flex-wrap absolute z-index margin-top-min margin-left-min" id="client-ui">
				<div class="flex-wrap" id="client-back">
					<label class="flex margin-right-md margin-left-min">
						<icon icon="hotel1" class="margin-right-min margin-auto-top-bottom"></icon>
						<h5 class="white margin-auto-top-bottom">Inicio</h5>
					</label>
				</div>
				<div class="flex margin-left-minm" id="client-expand" onclick="toggleFullScreen();">
					<icon icon="expand" class="margin-auto"></icon>
				</div>
				<div class="flex margin-left-minm" id="client-refresh" onclick="resizeClient();">
					<icon icon="refresh" class="margin-auto"></icon>
				</div>
			</div>
			<div class="flex" id="flash-container">
				<div class="flex-wrap center-container" id="flashplayer-container">
					<div class="flex-column margin-left-max margin-auto-top-bottom" id="label-flashplayer-container">
						<label class="gray">
							<h1 class="bold margin-bottom-min uppercase">Você esta quase lá!</h1>
							<h5 class="margin-bottom-min">Para jogar no <text class="lowercase"><?php echo $hotel['hotelname']; ?></text> você pecisa ter o <b>Adobe Flash Player</b> instalado, atualizado ou ativado.</h5>
							<h5 class="margin-bottom-min">Se você estiver usando um computador, você precisa ativar, instalar ou atualizar o flash player manualmente nas configurações do seu navegador.</h5>
							<h5>O flash player é um componete muito importante para que você possa jogar, por mais que seja triste o fim deste componente o <text class="lowercase"><?php echo $hotel['hotelname']; ?></text> em um possível futuro voltará sem precisar utilizar o mesmo para você poder jogar.</h5>
						</label>
						<div class="margin-auto-top flex-column">
							<h5 class="margin-bottom-min bold gray">Clique no botão abaixo para ativar o flash player</h5>
							<div class="flex-wrap">
								<a href="https://get.adobe.com/flashplayer/" target="_blank" class="green-button-2 no-link margin-right-min" style="width: 165px;height: 45px;font-size: 13px;">
									<label class="margin-auto white">Ativar o flash player</label>
								</a>
								<a href="<?php echo $hotel['site']; ?>/principal" class="red-button no-link" style="width: 150px;height: 45px;font-size: 13px;">
									<label class="margin-auto white">Voltar ao inicio</label>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/libs2.js?<?php echo time(); ?>"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/visual.js?<?php echo time(); ?>"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/libs.js?<?php echo time(); ?>"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/common.js?<?php echo time(); ?>"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/fullcontent.js?<?php echo time(); ?>"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/habboflashclient.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">
			function resizeClient(){
				var theClient = document.getElementById('flash-container');
				var theWidth = theClient.clientWidth;
				theClient.style.width = "10px";
				theClient.style.width = theWidth + "px";
			}

			function toggleFullScreen() {
				if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
					if (document.documentElement.requestFullScreen) {
						document.documentElement.requestFullScreen();
					} else if (document.documentElement.mozRequestFullScreen) {
						document.documentElement.mozRequestFullScreen();
					} else if (document.documentElement.webkitRequestFullScreen) {
						document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
					}
				} else {
					if (document.cancelFullScreen) {
						document.cancelFullScreen();
					} else if (document.mozCancelFullScreen) {
						document.mozCancelFullScreen();
					} else if (document.webkitCancelFullScreen) {
						document.webkitCancelFullScreen();
					}
				}
			}

			var flashvars = {
				"client.allow.cross.domain" : "1",
				"client.notify.cross.domain" : "0",
				"connection.info.host" : "localhost",
				"connection.info.port" : "30000",
				"site.url" : "<?php echo $hotel['site']; ?>",
				"url.prefix" : "<?php echo $hotel['site']; ?>",
				"client.reload.url" : "<?php echo $hotel['site']; ?>/client",
				"client.fatal.error.url" : "<?php echo $hotel['site']; ?>/erro-15",
				"client.connection.failed.url" : "<?php echo $hotel['site']; ?>/flash_client_error", 
				"external.variables.txt" : "<?php echo $hotel['site']; ?>/swfs/gamedata/external_variables.txt?<?php echo time(); ?>",
				"external.texts.txt" : "<?php echo $hotel['site']; ?>/swfs/gamedata/external_flash_texts.txt?<?php echo time(); ?>",
				"productdata.load.url" : "<?php echo $hotel['site']; ?>/swfs/gamedata/productdata.txt?<?php echo time(); ?>",
				"furnidata.load.url" : "<?php echo $hotel['site']; ?>/swfs/gamedata/furnidata.xml?<?php echo time(); ?>",
				"use.sso.ticket" : "1",
				"sso.ticket" : "<?php echo UpdateSSO($User->id); ?>",
				"processlog.enabled" : "0",
				"client.starting" : "Aguarde, o hybbe está carregando...",
				"client.starting.revolving": "Quando você menos esperar...terminaremos de carregar.../Carregando mensagem divertida! Por favor espere./Você quer batatas fritas para acompanhar?/Siga o pato amarelo./O tempo é apenas uma ilusão./Já chegamos?!/Eu gosto da sua camiseta./Olhe para um lado. Olhe para o outro. Pisque duas vezes. Pronto!/Não é você, sou eu./Shhh! Estou tentando pensar aqui./Carregando o universo de pixels.",
				"flash.client.url" : "<?php echo $hotel['site']; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/",
				"has.identity" : "0",
				"flash.client.origin" : "popup"
			};

			var params = {
				"base" : "<?php echo $hotel['site']; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/",
				"allowScriptAccess" : "always",
				"menu": "false",
				"wmode": "opaque"             
			};

			if (!(HabbletLoader.needsFlashKbWorkaround())) {
				params["wmode"] = "opaque";
			}
			
			FlashExternalInterface.signoutUrl = "<?php echo $hotel['site']; ?>/sair";
			swfobject.embedSWF('<?php echo $hotel['site']; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/habbo.swf?<?php echo time(); ?>', "flash-container", "100%", "100%", "10.0.0", "expressInstall.swf", flashvars, params);

			window.onbeforeunload = unloading;
			function unloading() {
				var clientObject;
				if (navigator.appName.indexOf("Microsoft") != -1) {
					clientObject = window["flash-container"];
				} else {
					clientObject = document["flash-container"];
				}

				try {
					clientObject.unloading();
				} catch (e) {}
			}
		</script>
	</body>
</html>
