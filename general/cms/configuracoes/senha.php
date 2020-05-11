<?php
	session_start();
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$configura = $bdd->query("SELECT * FROM player_settings WHERE player_id='" . $user['id'] . "' LIMIT 1");
	$row = $configura->fetch(PDO::FETCH_ASSOC);

	$page = "configuracoes";
	$page_name = "Configurações: Senha";

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
										<h4 class="bold">Configurações da Senha</h4>
										<h5>Quer mais segurança? Que tal por uma senha dificil?</h5>
									</label>
								</div>
								<div>
									<li class="list-none flex-column padding-max gray">
										<label>
											<h5 class="margin-bottom-minm uppercase bold">Sua senha</h5>
											<h5>Ei <?php echo $user['username']; ?>, você sabia que sua senha, sem sombra de dúvidas, é a coisa é mais obrigatória e importante para sua conta?<br><br>Pois é <?php if($user['gender'] == 'F') { ?>minha amiga<?php } else if ($user['gender'] == 'M') { ?>meu amigo<?php } ?> as senhas garantem um acesso seguro para sua conta impedindo ataque de invasores na mesma e fazer atos ilícitos(não permitidos) como, roubar, se passar por você ou dentre outras coisa citadas nas regras!
												<br>
												<br>
												Lembre-se sempre! Você <b>nunca deve dar acesso a sua conta para outros jogadores</b> mesmo sendo, melhores amigos(as), namorado(a, os, as), irmão(ã, ões, ãs), em hipótese alguma! Pois a sua conta é algo pessoal seu, e só pode conter apenas um dono, isso nos ajuda e te ajuda na prevenção de tais problemas.
											</h5>
										</label>
										<?php
											$puxar_senha_atual = $user['password'];
											$senha_atual = $_POST['password'];
											$nova_senha = $_POST['newpassword'];
											$repetir_nova_senha = $_POST['repeatnewpassword'];

											if (isset($_POST['newpassword']) && isset($_POST['repeatnewpassword']) && isset($_POST['repeatnewpassword'])) {
												if ($senha_atual == '') {
													$senha_atual_vazia = true;
												} else if ($puxar_senha_atual != md5($senha_atual) || md5($senha_atual) != $puxar_senha_atual) {
													$erro_senha_atual = true;
												} else if (strlen($nova_senha) < 8 || strlen($repetir_nova_senha) < 8) {
													$erro_nova_senha = true;
													$erro_nova_senha_text = 'Sua nova senha não pode conter menos que 8 caracteres!';
												} else if (strlen($nova_senha) > 32 || strlen($repetir_nova_senha) > 32) {
													$erro_nova_senha = true;
													$erro_nova_senha_text = 'Sua nova senha não pode conter mais que 32 caracteres!';
												} else if ($repetir_nova_senha != $nova_senha) {
													$erro_repetir_nova_senha = true;
												} else if ($user['time_password'] >= time() - 180) {
													$erro_tempo_senha = true;
												} else {
													$tempo_senha_trocada = time();
													$atualizar = $bdd->query("UPDATE players SET password='" . md5($nova_senha) . "',time_password='" . $tempo_senha_trocada . "' WHERE id='" . $user['id'] . "'");
													$change_password = true;
												}
											}
										?>
										<form action="" method="POST">
										<div class="margin-top-md">
											<div class="margin-bottom-min">
											<?php if ($erro_tempo_senha == true) { ?>
												<label class="general-error-time margin-bottom-minm">
													<h6 class="margin-auto-top-bottom bold">Espera ai <?php if ($user['gender'] == 'F') { ?>amiguinha<?php } else { ?>amiguinho<?php } ?>, você precisa esperar até 3 minutos para alterar sua senha novamente!</h6>
												</label>
											<?php } else if ($erro_senha_atual == true) { ?>
												<label class="general-error margin-bottom-minm">
													<h6 class="margin-auto-top-bottom bold">Sua senha atual esta incorreta!</h6>
												</label>
											<?php } else if ($senha_atual_vazia == true) { ?>
												<label class="general-error margin-bottom-minm">
													<h6 class="margin-auto-top-bottom bold">Você não pode deixar sua senha vazia!</h6>
												</label>
											<?php } ?>
												<div class="flex">
													<icon icon="lock2" style="left: 11px;margin: 9px -15px auto 0;"></icon>
													<input type="password" name="password" placeholder="Digite sua senha atual...">
												</div>
											</div>
											<div class="margin-bottom-min">
											<?php if ($erro_nova_senha == true) { ?>
												<label class="general-error margin-bottom-minm">
													<h6 class="margin-auto-top-bottom bold"><?php echo $erro_nova_senha_text; ?></h6>
												</label>
											<?php } ?>
												<div class="flex">
													<icon icon="lock1" style="left: 11px;margin: 9px -15px auto 0;"></icon>
													<input type="password" name="newpassword" placeholder="Escolha uma nova senha...">
												</div>
											</div>
											<div>
											<?php if ($erro_repetir_nova_senha == true) { ?>
												<label class="general-error margin-bottom-minm">
													<h6 class="margin-auto-top-bottom bold">Esta senha não é igual a de cima!</h6>
												</label>
											<?php } ?>
												<div class="flex">
													<icon icon="lock2" style="left: 11px;margin: 9px -15px auto 0;"></icon>
													<input type="password" name="repeatnewpassword" placeholder="Repita a senha escolhida...">
												</div>
											</div>
										</div>
									</li>
									<li class="list-none flex-column padding-max gray padding-top-none">
										<button type="submit" class="green-button-2 no-link" style="width: 100%;height: 42px;left: -1px;font-size: 14px;">
											<label class="margin-auto white">Alterar minha senha</label>
										</button>
									<?php if ($change_password == true) { ?>
										<label class="general-sucess margin-bottom-minm margin-auto-left-right margin-top-md">
											<h6 class="margin-auto-top-bottom bold">Sua senha foi alterada com sucesso!</h6>
										</label>
									<?php } ?>
									</li>
								</div>
							</div>
							</form>
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
									<a href="<?php echo $hotel['site']; ?>/configuracoes/email" class="no-link gray padding-min" id="config-options"><h5>Configurações do E-mail</h5></a>
									<a href="<?php echo $hotel['site']; ?>/configuracoes/senha" class="no-link gray padding-min" id="config-options" visited><h5>Configurações da Senha</h5></a>
								</div>
							 </div>
						</div>
					</div>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>