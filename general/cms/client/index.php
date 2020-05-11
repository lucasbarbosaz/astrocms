<?php
require_once ('../habbo/core.php');
require_once ('../habbo/session.php');
include "../verificar/configuracao.php";

$versao = mysql_query("SELECT * FROM habbo_versao WHERE id='$user_q[id]'");
$vv = mysql_fetch_assoc($versao);


if (isset($_SESSION['id'])) {
$user_l = mysql_query("SELECT * FROM players WHERE id='$_SESSION[id]'");
$user_o = mysql_fetch_assoc($user_l);
}
//if (($user_o['rank'] >= "5") && ($_SESSION['verificado'] != "yes")){
//  header("Location: /verificar");
//}elseif(($_SESSION['verificado'] == "yes")){
//  include ('client-base.php');
//} else{ 
// include ('client-base.php');
//1}
mysql_query("UPDATE players SET auth_ticket = 'HYBBE-".GenerateTicket()."-1' WHERE id = '$user_q[id]'") or die(mysql_error()); 
$ticketsql = mysql_query("SELECT * FROM players WHERE id = '$user_q[id]'") or die(mysql_error());
$ticketrow = mysql_fetch_assoc($ticketsql);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Hybbe - Jogar </title> 


<link rel="shortcut icon" href="<?php echo $site; ?>/favicon.ico" type="image/vnd.microsoft.icon" /> 
<script src="<?php echo $site; ?>/web/flashclient/js/libs2.js" type="text/javascript"></script>
<script src="<?php echo $site; ?>/web/flashclient/js/visual.js" type="text/javascript"></script>
<script src="<?php echo $site; ?>/web/flashclient/js/libs.js" type="text/javascript"></script>
<script src="<?php echo $site; ?>/web/flashclient/js/common.js" type="text/javascript"></script>

<script src="<?php echo $site; ?>/web/flashclient/js/fullcontent.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $site; ?>/web/flashclient/css/style.css?6" type="text/css" />
<link rel="stylesheet" href="<?php echo $site; ?>/web/flashclient/css/tooltips.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $site; ?>/web/flashclient/css/habboflashclient.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $site; ?>/general/assets/css/client.css">
<script src="<?php echo $site; ?>/web/flashclient/js/habboflashclient.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <style>
 body {
    background: url('/general/assets/img/fundo_n.png');
    margin: 0;
    font-family: Ubuntu, "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
    font-size: 16px;
}
#main {
    max-width: 880px;
    margin: auto;
}
.green-button-2-erro {
    position: relative;
    background: rgb(89, 186, 86);
    border-radius: 2px;
    text-decoration: none;
    padding: 5px;
    display: flex;
    flex-direction: column;
}

.green-button-2-erro:hover {
    background: rgb(104, 193, 102);
}

.green-button-2-erro:active {
    background: rgb(89, 186, 86);
}

.green-button-2-erro::before {
    content: "";
    position: relative;
    width: inherit;
    height: 50%;
    background: rgba(128, 255, 107, 0.3);
    border-radius: 3px 3px 0px 0px;
}

.green-button-2-erro::after {
    content: "";
    position: relative;
    width: inherit;
    height: 50%;
}
.green-button-label-2 {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
}


.green-button-2-erro-v {
    position: relative;
    background: rgb(185, 76, 76);
    border-radius: 2px;
    text-decoration: none;
    padding: 5px;
    display: flex;
    flex-direction: column;
}

.green-button-2-erro-v:hover {
    background: rgb(193, 85, 85);
}

.green-button-2-erro-v:active {
    background: rgb(185, 76, 76);
}

.green-button-2-erro-v::before {
    content: "";
    position: relative;
    width: inherit;
    height: 50%;
    background: rgba(255, 107, 107, 0.3);
    border-radius: 3px 3px 0px 0px;
}

.green-button-2-erro-v::after {
    content: "";
    position: relative;
    width: inherit;
    height: 50%;
}
.white {
    color: rgb(255, 255, 255)!important;
}
.margin-auto {
    margin: auto!important;
}
.carrega,
.carrega .carrega-bg {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}


.carrega .carrega-bg {
    background-image: url(/general/client/img/fundo.png);
    position: absolute;
    background-size: cover;
    image-rendering: optimizeSpeed;
    image-rendering: crisp-edges;
    image-rendering: pixelated
}

.carrega .carrega-image {
    background-image: url(/general/client/img/logo.png);
    background-position: center center;
    background-repeat: no-repeat;
    position: absolute;
    width: 422px;
    height: 320px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    image-rendering: pixelated;
    z-index: 200
}

.carrega-frank {
    background-image: url(/general/client/img/frankvr.png);
    background-position: center center;
    position: relative;
    width: 240px;
    height: 384px;
margin-top: 90px;
margin-left:-790px;
    image-rendering: pixelated;
    z-index: 200
}
.erro-frank {
    background-image: url(/general/client/img/frank-erro.png);
    background-position: center center;
    position: relative;
    width: 181px;
    height: 267px;
margin-top: 190px;
margin-left:-670px;
    image-rendering: pixelated;
    z-index: 200
}
.erro-frank-flash {
    background-image: url(/general/client/img/frank.png);
    background-position: center center;
    position: relative;
    width: 240px;
    height: 384px;
margin-top: 130px;
margin-left:-720px;
    image-rendering: pixelated;
    z-index: 200
}
.escolher {
    height: 184px;
    margin-top:-130px;
        image-rendering: pixelated;
    z-index: 200
}

.escolher-titulo {
    position: absolute;
    color: #999;
    font-size: 19.5pt;
    margin-top:90px;
    margin-left:223px;
    font-weight: 500;
    text-align: center
}

.erro-titulo {
    position: absolute;
    color: #999;
    font-size: 19.5pt;
    margin-top:60px;
    margin-left:223px;
    font-weight: 500;
    text-align: center;
    width: -84px;
}
.erro-titulo-flash {
    position: absolute;
    color: #999;
    font-size: 19.5pt;
    margin-top:100px;
    margin-left:223px;
    font-weight: 500;
    text-align: center;
}

.escolher-info {
    position: absolute;
    color: #999;
    font-size: 11pt;
    margin-top:130px;
    margin-left:223px;
    width: 450px;
    text-align: left
}

.erro-info {
    position: absolute;
    color: #999;
    font-size: 11pt;
    margin-top:100px;
    margin-left:223px;
    width: 450px;
    text-align: left
}
.erro-info-flash {
    position: absolute;
    color: #999;
    font-size: 11pt;
    margin-top:139px;
    margin-left:223px;
    width: 450px;
    text-align: left
}

.carrega .carrega-loading {
    position: absolute;
    width: 450px;
    top: 70%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center
}

.carrega .carrega-loading .carrega-loading-bar {
    background-color: rgb(18, 18, 18);
    border: 0px solid rgb(18, 18, 18);
    border-radius: 2px;
    padding: 3px;
    height: 24px;
    opacity: 0.5;
    margin-bottom: 0px
}

.carrega .carrega-loading .carrega-loading-bar .carrega-loading-bar-inner-bar {

    background: -moz-linear-gradient(top, rgb(104, 60, 136) 50%, rgb(104, 60, 136) 50%, rgb(104, 60, 136) 50%);
    background: linear-gradient(to bottom, rgb(117, 68, 153) 50%, rgb(117, 68, 153) 50%, rgb(117, 68, 153) 50%);
    height: 18px;
    border-radius: 2px;
    transition: width .4s ease-in-out;
    width: 0
}

.carrega .carrega-loading .carrega-loading-heading {
    color: #999;
    font-size: 19.5pt;
    margin-bottom: 10px;
    font-weight: 500
}

.carrega .carrega-loading .carrega-loading-percentage {
    color: #999;
    margin-top: 9px;
    font-weight: 500;
    font-size: 10pt
}

.carrega .erro-img {
    background-image: url(/geral/client/img/erro.png);width:220px;height:197px;opacity: 0.40; background-position:center center;background-repeat:no-repeat;position:absolute;top:35%;left:calc(50%);transform:translate(-50%,-50%);image-rendering:optimizeSpeed;image-rendering:crisp-edges;image-rendering:pixelated;z-index:200}

        .carrega .carrega-error {
        position: absolute;
        width: 450px;
        top: calc(35% + 120px);
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        color: #fff;
        font-size: 12pt;
        max-width: calc(100% - 20px)
    }

    .carrega .carrega-error a {
        color: #fff;
        text-decoration: none !important;
        border-bottom: 1px solid #fff;
        padding-bottom: 2px
    }

    .carrega .carrega-error a:hover {
        color: #e6e6e6
    }

    .carrega .carrega-error a:active {
        border: none
    }

    .carrega .carrega-error .carrega-error-heading {
    }

    .carrega .carrega-error .carrega-error-muted {
        font-size: 10pt;
        margin-top: 10px
    }

</style>
<meta name="build" content="0" /> 

</head> 
<body id="client" class="flashclient"> 
 
<script type="text/javascript"> 

var flashvars = {
"client.allow.cross.domain" : "1", 
"client.notify.cross.domain" : "0", 
"connection.info.host" : "149.56.228.59", 
"connection.info.port" : "30000", 
"site.url" : "<?php echo $site; ?>", 
"url.prefix" : "<?php echo $site; ?>", 
"client.reload.url" : "<?php echo $site; ?>/client", 
"client.fatal.error.url" : "<?php echo $site; ?>/erro-15", 
"client.connection.failed.url" : "<?php echo $site; ?>/flash_client_error", 
"external.variables.txt" : "<?php echo $site; ?>/swfs/gamedata/external_variables.txt?<?php echo time(); ?>",
"external.texts.txt" : "<?php echo $site; ?>/swfs/gamedata/external_flash_texts.txt?<?php echo time(); ?>",
"productdata.load.url" : "<?php echo $site; ?>/swfs/gamedata/productdata.txt?<?php echo time(); ?>",
"furnidata.load.url" : "<?php echo $site; ?>/swfs/gamedata/furnidatar.xml?<?php echo time(); ?>",
"external.figurepartlist.txt": "<?php echo $site; ?>/swfs/gamedata/figuredata.xml?<?php echo time(); ?>",
"use.sso.ticket" : "1",
"sso.ticket" : "<?php echo $ticketrow['auth_ticket']; ?>", 
"processlog.enabled" : "0", 
"client.starting" : "Aguarde, o hybbe está carregando...", 
"flash.client.url" : "<?php echo $site; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/", 
"has.identity" : "0", 
/*<?php if($roomask == true){ ?>
"forward.type" : "<?php echo $forward_type; ?>",
"forward.id" : "<?php echo $roomIdask['id']; ?>",
<?php } ?>*/
"flash.client.origin" : "popup" 
 };
    var params = {
        "base" : "<?php echo $site; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/",
        "allowScriptAccess" : "always",
        "menu": "false",
        "wmode": "opaque"             
    };
 
        if (!(HabbletLoader.needsFlashKbWorkaround())) {
            params["wmode"] = "opaque";
        }
 
    FlashExternalInterface.signoutUrl = "<?php echo $site; ?>/account/logout";
 
    swfobject.embedSWF('<?php echo $site; ?>/swfs/gordon/PRODUCTION-201611291003-338511768/hybbe60.swf', "flash-container", "100%", "100%", "10.0.0", "<?php echo $site; ?>/web/flashclient/flash/expressInstall.swf", flashvars, params);
 
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
<?php 
### Player rádio
include "config.php";

?>
<link href="/radio/playernormal/css/reset.css" rel="stylesheet" type="text/css"/>
<link href="/radio/playernormal/css/style.css" rel="stylesheet" type="text/css"/>
<link href="/radio/playernormal/css/tipped.css" rel="stylesheet" type="text/css"/>
<body style="background-color: rgba(255, 255, 255, 0);">
	<style type="text/css">a:link,a:visited{text-decoration:none;color:#FFF;}</style>
	<div style="display: none">
		<script>
			function auto(){
				document.getElementById("player2").volume = 0.20;
			}
		</script>
		<audio id="player2" controls="" autoplay="" src="http://167.114.53.24:9958/;stream.mp3"></audio>
		<script>
			var audio = document.getElementById("player2");
			audio.volume = 0.20;
			var stream = document.getElementById("player2");
			setInterval(
				function() {
					if (stream.duration <= 0 || stream.paused) {
						console.log("Recarregando stream...");
						UpdateAudio();
					}
				}, 900);

			function UpdateInfo(){
				atualiza_dados("locutorver", "locutor"), atualiza_dados("unicosver","unicos");
				setInterval(
					function() {
						atualiza_dados("locutorver", "locutor"), atualiza_dados("unicosver","unicos");
					}, 900);
			}
			function getVolume() {
				alert(stream.volume);
			}
			function SetVolumeLower() {
				stream.volume -= 0.05;
			}
			function SetVolumeHigher() {
				stream.volume += 0.05;
			}
			function UpdateAudio(){
				var update = document.getElementById("player2"); player2.src="http://167.114.53.24:9958/;stream.mp3"; player2.load();
			}
		</script>
	</div>
	<!-- GalaxyServersVerificacaoPlayerRadioNaoRemova -->
	<div id="area_player" style="text-align:left;">
		<div id="player" class="draggable ui-widget-content ui-draggable minimize" style="left: 25%; position: relative;">
			<div class="player_min">
				<div class="guy"></div>
				<div class="txt">R&aacute;dio</div>
				<div class="handle tip ui-draggable-handle" title="Mover"></div>
				<div class="open o-c tip" title="Abrir"></div>
			</div>
			<div class="player">
				<div class="plus tip" title="Aumentar" style="cursor:pointer" onclick="SetVolumeHigher()"></div>
				<div class="min tip" title="Diminuir" style="cursor:pointer" onclick="SetVolumeLower()"></div>
				<a target="_blank" href="http://radio.<?php echo $_SERVER["HTTP_HOST"];?>/pedidoclient.php" onclick="window.open(this.href,'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=450, height=450]'); return false;">
					<div class="orders tip" title="Fazer Pedido" style="cursor:pointer"></div> 
				</a>
				<a onclick="UpdateAudio()">
					<div class="update tip" title="Atualizar Rádio" style="cursor:pointer"></div>
				</a>
				<a id="playerButton" data-enable="1">
					<div class="play pause tip" title="Play/Pause" style="cursor:pointer"></div>
				</a>
				<div class="separa"></div>
				<div class="info locutor tip" title="Locutor">
					<a style="color:#FFF;text-decoration: none;"><span class="locutorver">...</span></a>
				</div>
				<div class="info room tip" title="Programação">
					<a style="color:#FFF;text-decoration: none;"><span class="musicaver">...</span></a>
				</div>
				<div class="info listeners tip" title="Ouvintes">
					<a style="color:#FFF;text-decoration: none;"><span class="unicosver">...</a> Ouvintes</span></a>
				</div>
				<div class="close o-c tip" title="Fechar"></div>
				<div class="handle tip ui-draggable-handle" title="Mover"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function ()
		{
			$(document).on("click", "#playerButton", function ()
			{
				if ($("#playerButton").attr("data-enable") == 0)
				{
					document.getElementById("player2").muted = false;
					$("#playerButton").attr("data-enable", "1");
				}
				else
				{
					document.getElementById("player2").muted = true;
					$("#playerButton").attr("data-enable", "0");
				}
			});
		});
	</script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://www.habblet.in/radio/radiobrl/tipped.js"></script>
<script src="https://www.habblet.in/radio/radiobrl/player1.js"></script>

</body>
<script src="/radio/playernormal/js/tipped.js?a" type="text/javascript"></script>
<script src="/radio/playernormal/js/player1.js?a" type="text/javascript"></script>
<script src="/radio/playernormal/js/principal.js?aaasda" type="text/javascript"></script>
<div id="flash-container">
    <body class="index">
<div id="main">
<center>
    
       <div class="erro-titulo-flash">Opps</div>
       <div class="erro-info-flash">Para jogar hybbe requer que você tenha o Adobe flash player.<br> Se você estiver usando um computador, você precisa ativar, instalar ou atualizar o flash para jogar.<br><br>
           
           <b>Clique no botão abaixo para ativar o flash player</b></div>
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
   
    


<noscript> 
<div style="width: 400px; margin: 20px auto 0 auto; text-align: center"> 
<p>If you are not automatically redirected, please <a href="/client/nojs">click here</a></p> 
</div> 
</noscript> 
</div> 
</div>

</div>
</div>

<div id="content" class="client-content"></div>


</div>
<div style="display: none"> 


</body> 

</html>