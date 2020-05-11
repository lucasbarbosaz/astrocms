<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = "loja";
	$page_name = "Loja: VIP";

	include('../../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" store></div>
					<a href="<?php echo $hotel['site']; ?>/loja/informacoes" id="header-ohter-area-menu-button">Informações</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/loja/cash" id="header-ohter-area-menu-button">Cash</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/loja/vip" id="header-ohter-area-menu-button" visited>VIP</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/loja/moedas" id="header-ohter-area-menu-button">Moedas</a>
					<div id="cash-store-indicator">
						<amount>Você tem: <b>0</b> de CASH</amount>
					</div>
				</div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div class="column-separator-left margin-right-min">
							<div class="flex-wrap" id="packages-area">
								<div class="margin-right-md" id="package-div" style="background-image: url();">
									<div id="package-div-header">
										<icon>
											<img src="">
										</icon>
										<label class="text-nowrap">12 Meses de VIP</label>
										<amount class="white text-nowrap">499 Cash</amount>
									</div>
									<div id="package-interactions">
										<button class="blue-button" style="width: 110px;height: 40px;margin-right: 10px;float: left;">
											<label class="margin-auto white">
												<h5>Comprar</h5>
											</label>
										</button>
										<div class="green-button-2" style="width: 175px;height: 40px;float: left;">
											<label class="margin-auto">
												<div class="margin-auto white">
													<h5>Veja os benefícios</h5>
												</div>
											</label>
										</div>
									</div>
									<!--<div id="package-div-discount-indicator"></div>-->
								</div>
								<div id="package-div" style="background-image: url();">
									<div id="package-div-header">
										<icon>
											<img src="">
										</icon>
										<label class="text-nowrap">12 Meses de VIP</label>
										<amount class="white text-nowrap">425 Cash</amount>
									</div>
									<div id="package-interactions">
										<button class="blue-button" style="width: 110px;height: 40px;margin-right: 10px;float: left;">
											<label class="margin-auto white">
												<h5>Comprar</h5>
											</label>
										</button>
										<div class="green-button-2" style="width: 175px;height: 40px;float: left;">
											<label class="margin-auto">
												<div class="margin-auto white">
													<h5>Veja os benefícios</h5>
												</div>
											</label>
										</div>
									</div>
									<div id="package-div-discount-indicator">-15%</div>
								</div>
							</div>
						</div>
						<div class="column-separator-right">
							<div class="gray" id="general-warning-store">
								<h5 class="bold uppercase">Você mora em Portugal?</h5>
								<h5 class="margin-top-bottom-min">Caso você seja um jogador português e não tenha como utilizar o MercadoPago como método de compra, a sua única maneira para poder comprar cash é entrando em contato com um membro da equipe pelo <a href="<?php echo $hotel['discord']; ?>" class="bold no-link" target="_blank">discord</a> ou pela <b>ferramenta de ajuda</b></h5>
								<div class="green-button-2" style="width: 234px;height: 40px;font-size: 13px;margin: 15px 0 0 0;">
									<label class="margin-auto bold white pn">
										<icon style="position: absolute;width: 18px;height: 18px;top: -1px;left: -35px;overflow: hidden;">
											<img style="margin-top: -595px; margin-left: -1440px;" src="<?php echo $hotel['site']; ?>/general/assets/img/sprite.png?<?php echo time(); ?>">
										</icon>
										Ferramenta de Ajuda
									</label>
								</div>
							</div>
							<div class="gray margin-top-min" id="general-warning-store">
								<h5 class="bold uppercase margin-bottom-min">LEMBRE-SE SEMPRE!</h5>
								<h5>Sempre peça autorização do seus pais ou responsáveis. Se não a tiver e o pagamento for cancelado ou recusado, você será banido.</h5>
							</div>
						</div>
					</div>
					<?php include('../../../config/includes/footer.php'); ?>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>