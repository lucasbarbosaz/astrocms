<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = "loja";
	$page_name = "Loja: Informações";

	include('../../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" store></div>
					<a href="<?php echo $hotel['site']; ?>/loja/informacoes" id="header-ohter-area-menu-button" visited>Informações</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/loja/cash" id="header-ohter-area-menu-button">Cash</a>
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
						<div class="column-separator-left">
							<div class="gray" id="general-warning-store" style="width: 598px;display: flex;">
								<label class="margin-right-max">
									<h4 class="bold margin-bottom-min">Autorização</h4>
									<h5 class="margin-bottom-max">Sempre peça autorização de seus pais para fazer comprar neste site, o usuário comprador deve estar ciente de que após a confirmação do pagamento não haverá devolução do dinheiro nem do produto após a entrega.</h5>
									<h4 class="bold margin-bottom-min">Compras na loja</h4>
									<h5 class="margin-bottom-max">Aqui você encontra todos os métodos oficiais para adquirir produtos da nossa loja. A aquisição de qualquer produto sem os meios oficiais disponibilizados por nós resultará em banimento imediato de todas as contas envolvidas, e não nós responsabilizamos pela violação destes meios caso seja aplicado um golpe.</h5>
									<h4 class="bold margin-bottom-min">Dúvidas</h4>
									<h5 style="margin-bottom: 7px">Em caso de dúvidas, problemas com pacotes, como comprar e dentre outras, você pode entrar em contato com nossa equipe financeira pela <b>Ferramenta de Ajuda</b> para possivelmente pode ajudar você em problemas relacionados a aquisição dos produtos disponíveis na loja.</h5>
									<h5>Apenas, e somente o nosso setor financeiro (ou a equipe superior) pode ajudar você em relação à aquisição de pacotes e tirar suas dúvidas, caso alguém tente ajudar você quando envolve dados pessoais não caia, denuncie esta pessoa se você achar que está sendo enganado(a)!</h5>
								</label>
								<img class="margin-auto-top-bottom" height="278px" src="<?php echo $hotel['site']; ?>/general/assets/img/shop.png">
							</div>
						</div>
						<div class="column-separator-right">
							<div class="margin-top-md" id="general-warning-store">
								<div id="header-infomation-payment">
									<icon></icon>
									<h5 class="margin-auto-top-bottom white text-nowrap">Após o pagamento</h5>
								</div>
								<h5 class="gray margin-bottom-md">A compra de <b>cash</b> é ativada manualmente, ou seja, após a confirmação do pagamento é necessário fazer uma verificação manualmente para que tenhamos a total certeza de que você adquiriu certo pacote. E então, após tal verificação, uma notificação aparecerá em sua área de notificações confirmando a entrega do pacote adquirido.</h5>
								<h5 class="bold gray uppercase">Ainda não confirmou seu pagamento?</h5>
								<h5 class="gray margin-top-minm">Use esse botão abaixo e complete tudo o que o formulário necessita para confirmar sua compra!</h5>
								<button class="green-button-2 no-link" style="width: 290px;height: 42px;left: -1px;font-size: 13px;margin: 10px 0 0 0;">
									<label class="margin-auto white">Confirmar pagamento</label>
								</button>
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