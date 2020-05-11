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
				document.getElementById("player2").volume = 0.10;
			}
		</script>
		<audio id="player2" controls="" autoplay="" src="http://<?php echo "".$ipp.":".$portphb."";?>/;stream.mp3"></audio>
		<script>
			var audio = document.getElementById("player2");
			audio.volume = 0.10;
			var stream = document.getElementById("player2");
			setInterval(
				function() {
					if (stream.duration <= 0 || stream.paused) {
						console.log("Recarregando stream...");
						UpdateAudio();
					}
				}, 10000);

			function UpdateInfo(){
				atualiza_dados("locutorver", "locutor"), atualiza_dados("unicosver","unicos");
				setInterval(
					function() {
						atualiza_dados("locutorver", "locutor"), atualiza_dados("unicosver","unicos");
					}, 60000);
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
				var update = document.getElementById("player2"); player2.src="http://<?php echo "".$ipp.":".$portphb."";?>/;stream.mp3"; player2.load();
			}
		</script>
	</div>
	<!-- GalaxyServersVerificacaoPlayerRadioNaoRemova -->
	<div id="area_player">
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
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://www.habblet.in/radio/radiobrl/tipped.js"></script>
<script src="https://www.habblet.in/radio/radiobrl/player1.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $(document).on("click", "#playerButton", function ()
        {
            if ($("#playerButton").attr('data-enable') == 0)
            {
                document.getElementById('player2').muted = false;
                $("#playerButton").attr('data-enable', '1');
            }
            else
            {
                document.getElementById('player2').muted = true;
                $("#playerButton").attr('data-enable', '0');
            }
        });
    });//ezah end
</script>
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
</body>
<script src="/radio/playernormal/js/tipped.js?a" type="text/javascript"></script>
<script src="/radio/playernormal/js/player1.js?a" type="text/javascript"></script>
<script src="/radio/playernormal/js/principal.js?aaasda" type="text/javascript"></script>