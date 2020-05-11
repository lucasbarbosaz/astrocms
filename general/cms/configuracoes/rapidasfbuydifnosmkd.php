<?php
	session_start();
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$users = $bdd->query("SELECT * FROM players WHERE username='" . $_SESSION['username'] ."'");
	$user = $users->fetch(PDO::FETCH_ASSOC);

	$configura = $bdd->query("SELECT * FROM player_settings WHERE player_id='" . $user['id'] . "' LIMIT 1");
	$row = $configura->fetch(PDO::FETCH_ASSOC);

	$page = "configuracoes";
	$page_name = "Configurações: Email";

	include('../../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter"></div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div class="column-separator-left" style="width: 690px;">
							<div class="general-white-box padding-none">
								<div id="general-white-box-header2">
									<div id="general-white-box-header2-icon">
										<icon type="config"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Configurações Rápidas</h4>
										<h5>Aqui estão algumas configurações rápidas e essênciais que você pode alterar</h5>
									</label>
								</div>
								<div>
									<li class="list-none flex-column padding-max gray">
										<label class="margin-bottom-min">
											<h5 class="bold uppercase">Sua missão</h5>
											<h5>No que você está pensando hoje <?php echo $_SESSION['username']; ?>?</h5>
										</label>
										<div>
										<?php if ($user['motto'] == '') { ?>
										<icon type="motto" style="top: 11px;left: 11px;"></icon>
										<input type="text" name="motto" placeholder="Sua missão aqui...">
										<?php } else { ?>
										<icon type="motto" style="top: 11px;left: 11px;"></icon>
										<input type="text" name="motto" placeholder="Sua missão aqui..." value="<?php echo $user['motto']; ?>">
										<?php } ?>
										</div>
									</li>
										<hr>
									<?php if ($setting['client'] != 0) { ?>
									<li class="list-none flex padding-max gray">
										<label style="">
											<h5 class="bold">Versão da client melhorada</h5>
											<h5 id="settings1">Está versão deixa a sua jogabilidade fluída e rápida com o melhor desempenho.</h5>
										</label>
										<div class="margin-auto-left margin-auto-top-bottom" configurations>
											<?php if ($setting['client'] == 24) { ?>
											<input id="client-version" type="checkbox" name="client_version">
											<label for="client-version"></label>
											<?php } else if ($setting['client'] == 60) { ?>
											<input id="client-version" type="checkbox" name="client_version" checked>
											<label for="client-version"></label>
											<?php } ?>
										</div>
									</li>
									<?php } ?>
									<li class="list-none flex padding-max gray">
										<label style="">
											<h5 class="bold">Pedidos de amizade</h5>
											<h5>Eu desejo receber pedidos de amizade de todos.</h5>
										</label>
										<div class="margin-auto-left margin-auto-top-bottom" configurations>
											<input id="friends-requests" type="checkbox" name="friends_requests">
											<label for="friends-requests"></label>
										</div>
									</li>
									<li class="list-none flex padding-max gray padding-top-none">
										<label style="">
											<h5 class="bold">Recados</h5>
											<h5>Os recados podem ser deixados em seu perfil por todos que acessarem a sua página de perfil.</h5>
										</label>
										<div class="margin-auto-left margin-auto-top-bottom" configurations>
											<input id="profile-message" type="checkbox" name="profile_message">
											<label for="profile-message"></label>
										</div>
									</li>
									<li class="list-none flex padding-max gray padding-top-none">
										<label style="">
											<h5 class="bold">Visibilidade no Hall da Fama</h5>
											<h5>As pessoas podem ver o quão você é famoso e rico no hall da fama.</h5>
										</label>
										<div class="margin-auto-left margin-auto-top-bottom" configurations>
											<input id="halloffame" type="checkbox" name="halloffame">
											<label for="halloffame"></label>
										</div>
									</li>
									<li class="list-none flex padding-max gray padding-top-none">
										<label style="">
											<h5 class="bold">Referências</h5>
											<h5>Os usuários podem te referênciar ao se registrar no hotel e assim você ganhar pontos.</h5>
										</label>
										<div class="margin-auto-left margin-auto-top-bottom" configurations>
											<input id="references" type="checkbox" name="references">
											<label for="references"></label>
										</div>
									</li>
									<li class="list-none flex padding-max gray padding-top-none">
										<button type="submit" class="green-button-2 no-link" style="width: 100%;height: 42px;left: -1px;font-size: 14px;">
											<label class="margin-auto white">Salvar alterações</label>
										</button>
									</li>
								</div>
							</div>
							<?php include('../../../config/includes/footer.php'); ?>
						</div>
						<div class="column-separator-right">
							 <div class="general-white-box padding-none" style="width: 230px;">
							 	<div id="general-white-box-header2">
									<div id="general-white-box-header2-icon">
										<icon type="config"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Todas as opções</h4>
										<h5>Mais opções da conta</h5>
									</label>
								</div>
								<div class="flex-column">
									<a href="<?php echo $hotel['site']; ?>/configuracoes/rapidas" class="no-link gray padding-min" id="config-options" visited><h5>Configurações Rápidas</h5></a>
									<a href="<?php echo $hotel['site']; ?>/configuracoes/email" class="no-link gray padding-min" id="config-options"><h5>Configurações do E-mail</h5></a>
									<a href="<?php echo $hotel['site']; ?>/configuracoes/senha" class="no-link gray padding-min" id="config-options"><h5>Configurações da Senha</h5></a>
								</div>
							 </div>
						</div>
					</div>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>