<?php
	require_once ('../../../geral.php');

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');
	$pageid = "clinet/jogar";

//$versao = mysql_query("SELECT * FROM habbo_versao WHERE id='$user_q[id]'");
//$vv = mysql_fetch_assoc($versao);


	if (isset($_SESSION['id'])) {
		$user_l = $bdd->query("SELECT * FROM players WHERE id='" . $_SESSION['id'] . "'");
		$user_o = $user_l->fetch(PDO::FETCH_ASSOC);
	}
//if (($user_o['rank'] >= "5") && ($_SESSION['verificado'] != "yes")){
//  header("Location: /verificar");
//}elseif(($_SESSION['verificado'] == "yes")){
//  include ('client-base.php');
//} else{ 
// include ('client-base.php');
//1}
	$bdd->query("UPDATE players SET auth_ticket = 'HYBBE-".GenerateTicket()."-1' WHERE id='". $user['id'] ."'") or die(mysql_error()); 
	$ticketsql = $bdd->query("SELECT * FROM players WHERE id='" . $user['id'] . "'") or die(mysql_error());
	$ticketrow = $ticketsql->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Client - <?php echo $hotel['hotelname']; ?></title> 
		<link rel="shortcut icon" href="<?php echo $hotel['site']; ?>/favicon.ico" type="image/vnd.microsoft.icon" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/web/flashclient/css/style.css?6" type="text/css" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/web/flashclient/css/tooltips.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/web/flashclient/css/habboflashclient.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $hotel['site']; ?>/general/assets/css/client.css">

		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/libs2.js" type="text/javascript"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/visual.js" type="text/javascript"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/libs.js" type="text/javascript"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/common.js" type="text/javascript"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/fullcontent.js" type="text/javascript"></script>
		<script src="<?php echo $hotel['site']; ?>/web/flashclient/js/habboflashclient.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<meta name="build" content="0" />
	</head> 
	<body id="client" class="flashclient">
		<script type="text/javascript">
			var flashvars = {
			    "client.allow.cross.domain": "1",
			    "client.notify.cross.domain": "0",
			    "connection.info.host": "localhost",
			    "connection.info.port": "30000",
			    "site.url": "<?php echo $hotel['site']; ?>",
			    "url.prefix": "<?php echo $hotel['site']; ?>",
			    "client.reload.url": "<?php echo $hotel['site']; ?>/client",
			    "client.fatal.error.url": "<?php echo $hotel['site']; ?>/erro-15",
			    "client.connection.failed.url": "<?php echo $hotel['site']; ?>/flash_client_error",
			    "external.variables.txt": "<?php echo $hotel['site']; ?>/swfs/gamedata/external_variables.txt?<?php echo time(); ?>",
			    "external.texts.txt": "<?php echo $hotel['site']; ?>/swfs/gamedata/external_flash_texts.txt?<?php echo time(); ?>",
			    "productdata.load.url": "<?php echo $hotel['site']; ?>/swfs/gamedata/productdata.txt?<?php echo time(); ?>",
			    "furnidata.load.url": "<?php echo $hotel['site']; ?>/swfs/gamedata/furnidatar.xml?<?php echo time(); ?>",
			    "use.sso.ticket": "0",
			    "sso.ticket": "",
			    "processlog.enabled": "0",
			    "client.starting": "Aguarde, o hybbe está carregando...",
			    "flash.client.url": "<?php echo $hotel['site']; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/",
			    "has.identity": "0",
			    /*<?php if($roomask == true){ ?>
			    "forward.type" : "<?php echo $forward_type; ?>",
			    "forward.id" : "<?php echo $roomIdask['id']; ?>",
			    <?php } ?>*/
			    "flash.client.origin": "popup"
			};
			var params = {
			    "base": "<?php echo $hotel['site']; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/",
			    "allowScriptAccess": "always",
			    "menu": "false",
			    "wmode": "opaque"
			};

			if (!(HabbletLoader.needsFlashKbWorkaround())) {
			    params["wmode"] = "opaque";
			}

			FlashExternalInterface.signoutUrl = "<?php echo $hotel['site']; ?>/account/logout";

			swfobject.embedSWF('<?php echo $hotel['site']; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/hybbe30.swf', "flash-container", "100%", "100%", "10.0.0", "<?php echo $hotel['site']; ?>/web/flashclient/flash/expressInstall.swf", flashvars, params);

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
		<div id="overlay"></div> 
		<div id="client-ui" > 
			<div id="flash-wrapper"> 
				<div id="flash-container">
					<div class="index">
						<div id="main">
							<center>
								<div class="erro-titulo-flash">Opps</div>
								<div class="erro-info-flash">Para jogar hybbe requer que você tenha o Adobe flash player.<br> Se você estiver usando um computador, você precisa ativar, instalar ou atualizar o flash para jogar.<br><br><b>Clique no botão abaixo para ativar o flash player</b></div>
								<div class="erro-frank-flash"></div>
								<div class="escolher">
									<a href="https://get.adobe.com/flashplayer/" target="_blank" class="green-button-2-erro" style="margin-left:-260px;margin-top:20px;width: 165px;height: 32px;font-size: 13px;-webkit-filter: drop-shadow(3px 3px 0px rgba(0, 0, 0, 0.1));">
										<div class="green-button-label-2">
											<div class="margin-auto white">Ativar flash player</div>
										</div>
									</a>
									<a href="principal" class="green-button-2-erro-v" style="margin-left:85px;margin-top:-42px;width: 120px;height: 32px;font-size: 13px;-webkit-filter: drop-shadow(3px 3px 0px rgba(0, 0, 0, 0.1));">
										<div class="green-button-label-2">
											<div class="margin-auto white">Voltar ao inicio</div>
										</div>
									</a>
								</div>
								<script type="text/javascript"> 
									$('content').show();
								</script> 
								<noscript> 
									<div style="width: 400px; margin: 20px auto 0 auto; text-align: center"> 
										<p>If you are not automatically redirected, please <a href="/client/nojs">click here</a></p> 
									</div> 
								</noscript> 
							</center>
						</div> 
					</div>
				</div>
			</div>
			<div id="content" class="client-content"></div>
		</div>
	</body> 
</html>