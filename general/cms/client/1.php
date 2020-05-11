<?php
require_once ('../habbo/core.php');
require_once ('../habbo/session.php');



include "../verificar/configuracao.php";

if (isset($_SESSION['id'])) {
$user_l = mysql_query("SELECT * FROM users WHERE id='$_SESSION[id]'");
$user_o = mysql_fetch_assoc($user_l);
}

if (($user_o['rank'] >= "4") && ($_SESSION['verificado'] != "yes")){
  header("Location: /verificar");
}elseif(($_SESSION['verificado'] == "yes")){
  include ('client-base.php');
} else{ 
 include ('client-base.php');
}


mysql_query("UPDATE users SET auth_ticket = 'HAIBBO-".GenerateTicket()."-1' WHERE id = '$user_q[id]'") or die(mysql_error());
mysql_query("UPDATE users SET client = '24' WHERE id = '$user_q[id]'") or die(mysql_error());

$ticketsql = mysql_query("SELECT * FROM users WHERE id = '$user_q[id]'") or die(mysql_error());
$ticketrow = mysql_fetch_assoc($ticketsql);



?>

<?php
if (isset($_POST))
{
	setcookie('fps', '60', time() + 365*24*3600, null, null, false, true);
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Haibbo - Client</title>
    <script type="text/javascript">
        if (window.name == "")
            window.name = "habboClient";

        var username = "Claush";

    </script>
    <link href="http://localhost/geral/client/css/client.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="http://localhost/geral/client/css/carrega-client.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="http://localhost/geral/client/css/client_battleball.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="http://localhost/geral/client/css/client_battleships.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <script src="http://localhost/geral/client/js/flash_detect_min.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="http://localhost/geral/client/js/jquery-1.11.0.min.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="http://localhost/geral/client/js/swfobject.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="http://localhost/geral/client/js/lazarus.js?<?php echo time(); ?>"></script>
	<script src="http://localhost/hotel-client/core.min.js?<?php echo time(); ?>"></script>
	<script src="http://localhost/hotel-client/script.min.js?<?php echo time(); ?>"></script>
    <link href="http://localhost/hotel-client/core.min.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="http://localhost/hotel-client/app.min.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="http://localhost/hotel-client/style.min.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="http://localhost/hotel-client/client.addons.css?<?php echo time(); ?>" rel="stylesheet">
    <?php
	$client_web = './principal';
	?>
    <script type="text/javascript">
        var flashvars = {
            "connection.info.host": "localhost",
            "connection.info.port": "30000",
            "client.reload.url": "http://localhost/client/disconectado",
            "client.fatal.error.url": "http://localhost/client/erro",
            "client.connection.failed.url": "http://localhost/client/erro",
            "logout.url": "http://localhost/principal",
            "logout.disconnect.url": "http://localhost/principal",
            "url.prefix": "http://localhost",
            "has.identity": "1",
            "client.starting.revolving": "Aguarde...",
            "spaweb": "1",
            "client.notify.cross.domain": "1",
            "unique_habbo_id": "hhus-1265578",
            "nux.lobbies.enabled": "true",
            "flash.client.origin": "popup",
            "processlog.enabled": "0",
            "sso.ticket": "<?php echo $ticketrow['auth_ticket']; ?>",
            "productdata.load.url": "http://localhost/swf/gamedata/productdata.txt",
            "furnidata.load.url": "http://localhost/swf/gamedata/furnidata.xml",
            "external.texts.txt": "http://localhost/swf/gamedata/external_flash_texts.txt",
            "external.variables.txt": "http://localhost/swf/gamedata/external_variables.txt",
            "external.figurepartlist.txt": "http://localhost/swf/gamedata/figuredata.xml",
            "external.override.texts.txt": "http://localhost/swf/gamedata/override/external_flash_override_texts.txt",
            "external.override.variables.txt": "http://localhost/swf/gamedata/override/external_override_variables.txt",
            "flash.client.url": "http://localhost/swf/gordon/PRODUCTION-201611291003-338511768/",
        };

    </script>
    <script src="http://localhost/geral/client/js/carrega-client.js"></script>

    <script type="text/javascript">
        window.FlashExternalInterface = window.FlashExternalInterface || {}
        window.FlashExternalInterface.disconnect = function() {
            window.location.href = "http://localhost/client/erro";
        };

        window.FlashExternalInterface.logout = function() {
            window.location.href = "http://localhost/session/destroy";
        };

        var params = {
            "base": "http://localhost/swf/gordon/PRODUCTION-201611291003-338511768/",
            "allowScriptAccess": "always",
            "menu": "false",
            "wmode": "opaque"
        };
        swfobject.embedSWF('http://localhost/swf/gordon/PRODUCTION-201611291003-338511768/haibbo18-r8-24.swf', 'flash-container', '100%', '100%', '11.1.0', '//habboo-a.akamaihd.net/habboweb/63_1d5d8853040f30be0cc82355679bba7c/10404/web-gallery/flash/expressInstall.swf', flashvars, params, null, null);

    </script>
	<script>
flashvars = "nulled";
(function() {
var abc = document.getElementsByTagName("script"), index;
for (index = abc.length - 1; index >= 0; index--) {
    abc[index].parentNode.removeChild(abc[index]);
}
setTimeout(
    function() {
      document.getElementsByName("flashvars")[0].setAttribute("value", "hidden");
    }, 800);
})();
</script>

</head>
<script>
	function resizeClient(){
    var theClient = document.getElementById('client');
    var theWidth = theClient.clientWidth;
    theClient.style.width = "10px";
    theClient.style.width = theWidth + "px";
   }
   function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
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
</script>

<body class="flashclient" id="client">
    <div id="client-ui">
        <div id="flash-wrapper">
            <div id="flash-container">
                <div id="content" style="width: 420px; margin: 20px auto 0 auto;display: none">
<div class="client-error">
                    <div class="carrega-error-color">
                    <div class="client-error carrega-error-color carrega">
                        <div>
                            <div class="carrega-error-image"></div><div class="carrega-error"><div class="carrega-error-heading">Opps!</div>Para jogar Haibbo requer que tenha o Adobe flash player. Se você estiver usando um computador, você precisa <a href="https://get.adobe.com/flashplayer/" target="_blank">ativar, instalar ou atualizar o flash</a> para jogar. </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
                
                <SCRIPT LANGUAGE="JavaScript">   
<!-- Disable   
function disableselect(e){   
return false   
}   

function reEnable(){   
return true   
}   

//if IE4+   
document.oncontextmenu=new Function ("return false")   
//if NS6   
if (window.sidebar){   
document.onmousedown=disableselect   
document.onclick=reEnable   
}   
//-->   
</script>

<script type="text/javascript">
function toggleFullScreen() {
if ((document.fullScreenElement && document.fullScreenElement !== null) ||
(!document.mozFullScreen && !document.webkitIsFullScreen)) {
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
</script>
<script type="text/javascript">
function resizeClient(){
var theClient = document.getElementById('client');
var theWidth = theClient.clientWidth;
theClient.style.width = "10px";
theClient.style.width = theWidth + "px";
}
</script>
      


      
<script type="text/javascript">
            $('#content').show();

        </script>

        <div class="client-content">

        </div>
    </div>

    <div class="client__buttons"> 
        <button ng-click="ClientController.close()" habbo-client-close-expander="" data-toggle="modal" id="client-voltar" data-target="#modal-fill" >
            Inicio
        </button>
        
            <div onclick="setHotelVersion('60')" id="flashx4">
<button ng-click="ClientController.close()" habbo-client-close-expander="" data-toggle="modal" id="client-voltar" data-target="#modal-fill" >
            fps
        </button>
</div>
            
    <button onclick="resizeClient()" habbo-client-close-expander="" >
            Descongelar
        </button>

        <div class="modal modal-fill fade" data-backdrop="false" id="modal-fill" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="client__buttons">
                    <button ng-click="ClientController.close()" data-dismiss="modal" habbo-client-close-expander="" class="client__close">
                        Voltar ao hotel
                    </button></div>
                <iframe src="./principal" height="100%" width="100%" frameborder="0"></iframe>
            </div>
        </div>
        
        
        
            <?php
require_once ('includes/publicidade.php');
?>
       
   
        

</body>
</html>
