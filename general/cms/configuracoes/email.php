<?php
	session_start();
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$configura = $bdd->query("SELECT * FROM player_settings WHERE user_id='" . $user['id'] . "' LIMIT 1");
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
										<h4 class="bold">Configurações do E-mail</h4>
										<h5>Você gostaria de alterar seu e-mail?</h5>
									</label>
								</div>
								<div>
									<li class="list-none flex-column padding-max gray">
										<label>
											<h5 class="margin-bottom-minm uppercase bold">Seu e-mail</h5>
											<h5>Seu e-mail é muito importante, mas muitissimo importante!<br><br>Caso você perca algum dado importante de acesso, ou se sua sua conta for banida e você quer recupera-la, você terá essa chance <b>apenas</b> utilizando o seu e-mail verdadeiro.<br><br>Aaah, e também caso a equipe mande um e-mail importante para você sendo ele um comunicado, compras da loja ou coisas do tipo.<br><br>Então nunca se esqueca, use sempre um e-mail veridico e certifique-se de que você tenha acesso ao mesmo para no caso de acontecer algum imprevisto!</h5>
										</label>
									<?php
										$email = $_POST['email'];
										$check_email = preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);
										$consulta_email = $bdd->query("SELECT * FROM users WHERE mail='" . $email . "' LIMIT 1");

										if(isset($_POST['email'])) {
											if ($user['mail'] == $email) {
												$error = true;
												$error_type = 'general-error';
												$error_text = 'Parece que você já usa este e-mail em sua conta! Tente por outro 😀.';
											} else if ($email == '') {
												$error = true;
												$error_type = 'general-error';
												$error_text = 'Ué??!! Mas cadê o e-mail pra ser trocado? Você não pode deixar este campo vazio!';
											} else if ($consulta_email->rowCount() > 0) {
												$error = true;
												$error_type = 'general-error';
												$error_text = 'Opps! Alguém já esta utilizando este e-mail, tente colocar outro 😅.';
											} else if ($check_email != 1) {
												$error = true;
												$error_type = 'general-error';
												$error_text = 'Algo de errado não está certo! Parece que você não inseriu um e-mail válido ☹.';
											} else if ($user['time_email'] >= time() - 180) {
												$error = true;
												$error_type = 'general-error-time';
												$error_text = 'Espera um pouco aí, você tem que esperar até <b>3</b> minutos para trocar o seu e-mail novamente!';
											} else {
												$time_email = time();
												$bdd->query("UPDATE users SET email='" . $email . "',time_email='" . $time_email . "' WHERE id='" . $user['id'] . "'");
												$email_trocado = true;
												$set_email = $email;
											}
										}
									?>
									</li>
									<form method="POST" class="padding-max padding-top-none flex-column">
									<?php if ($error == true) { ?>
										<label class="<?php echo $error_type; ?> margin-bottom-minm">
											<h6 class="bold margin-auto-top-bottom"><?php echo $error_text; ?></h6>
										</label>
									<?php } else if ($email_trocado ==  true) { ?>
										<label class="general-sucess margin-bottom-minm">
											<h6 class="bold">Seu e-mail foi alterado com sucesso!</h6>
										</label>
									<?php } ?>
										<div class="flex">
											<icon icon="email" class="pointer-none" style="position: relative;top: 11px;left: 11px;margin-right: -16px;"></icon>
											<input type="text" name="email" placeholder="Seu email..." value="<?php if ($email_trocado == true) { echo $set_email; } else { echo $user['mail']; } ?>">
										</div>
										<li class="list-none flex gray padding-top-max">
											<button type="submit" class="green-button-2 no-link" style="width: 100%;height: 42px;left: -1px;font-size: 14px;">
												<label class="margin-auto white">Alterar o e-mail</label>
											</button>
										</li>
									</form>
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
									<a href="<?php echo $hotel['site']; ?>/settings/email" class="no-link gray padding-min" id="config-options" visited><h5>Configurações do E-mail</h5></a>
									<a href="<?php echo $hotel['site']; ?>/settings/password" class="no-link gray padding-min" id="config-options"><h5>Configurações da Senha</h5></a>
								</div>
							 </div>
						</div>
					</div>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>
