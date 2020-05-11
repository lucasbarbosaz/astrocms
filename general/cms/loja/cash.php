<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');
	

	$page = "loja";
	$page_name = "Loja: Cash";

	include('../../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" store></div>
					<a href="<?php echo $hotel['site']; ?>/loja/informacoes" id="header-ohter-area-menu-button">Informações</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/loja/cash" id="header-ohter-area-menu-button" visited>Cash</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/loja/vip" id="header-ohter-area-menu-button">VIP</a>
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
						<div class="column-separator-left" style="width: 322px;">
							<div class="margin-top-md margin-bottom-min" id="general-warning-store">
								<div id="header-infomation-payment">
									<icon></icon>
									<h5 class="margin-auto-top-bottom white text-nowrap">Após o pagamento</h5>
								</div>
								<h5 class="gray margin-bottom-minm">A compra de <b>cash</b> é ativada manualmente, ou seja, após a confirmação do pagamento é necessário fazer uma verificação manualmente para que tenhamos a total certeza de que você adquiriu certo pacote. Cada pacote tem um botão para você poder confirmar sua compra!</h5>
							</div>
							<div class="gray" id="general-warning-store">
								<h5 class="bold uppercase">Você mora em Portugal?</h5>
								<h5 class="margin-top-bottom-min">Caso você seja um jogador português e não tenha como utilizar o MercadoPago como método de compra, a sua única maneira para poder comprar cash é entrando em contato com um membro da equipe pelo <a href="<?php echo $hotel['discord']; ?>" class="bold no-link" target="_blank">discord</a> ou pela <b>ferramenta de ajuda</b></h5>
								<div class="green-button-2" style="height: 40px;font-size: 13px;margin: 15px 0 0 0;">
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
								<h5>Sempre peça autorização do seus pais ou responsáveis. Se não a tiver e o pagamento for cancelado ou recusado, você será banido imediatamente.</h5>
							</div>
						</div>
						<div class="column-separator-right">
							<div id="cash-packages-area">
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">50 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">150 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">300 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">500 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">1000 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">2000 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div class="margin-bottom-minm" id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">3000 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
								<div id="cash-package-div">
									<div class="margin-right-min" id="cash-amount">4000 CASH</div>
									<label class="gray flex-column margin-auto-top-bottom text-nowrap">
										<h5 class="bold" style="font-size: 12px">APENAS:</h5>
										<h4 class="margin-top-minm"><b>R$0,00</b> ou <b>€0,00</b></h4>
									</label>
									<button class="blue-button margin-auto-left margin-auto-top-bottom" style="width: 205px;height: 40px;left: -1px;font-size: 13px;">
										<label class="margin-auto white">Aquirir este pacote</label>
									</button>
								</div>
							</div>
						</div>
					</div>
					<?php include('../../../config/includes/footer.php'); ?>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>
