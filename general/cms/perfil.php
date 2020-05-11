<?php
	require_once '../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	// Declarando o nome pra poder acessar o link que foi declarado no .htacess
	$nome = safe($_GET['user'], 'SQL');

	// Se o nome que foi declarado uma varivável acima estiver vazia a condição abaixo sera realizada
	if (empty($nome)) {
		// Fazendo uma consulta na database por ordem do id
		$consulta = $bdd->query("SELECT * FROM players ORDER BY id DESC LIMIT 1");
		// Associando a consulta e uma nova variável chamada $perfil
		$perfil = $consulta->fetch(PDO::FETCH_ASSOC);
	} else {
		$consulta = $bdd->query("SELECT * FROM players WHERE username='" . $nome . "' LIMIT 1");
		$perfil = $consulta->fetch(PDO::FETCH_ASSOC);
	}

	if ($perfil['online'] == '1') {
		if ($perfil['gender'] == 'F') {
			$status = 'Conectada';
		} else if ($perfil['gender'] == 'M') {
			$status = 'Conectado';
		}
	} elseif ($perfil['online'] == '0') {
		if ($perfil['gender'] == 'F') {
			$status = 'Desconectada';
		} else if ($perfil['gender'] == 'M') {
			$status = 'Desconectado';
		}
	}

	$ranks = $bdd->query("SELECT * FROM server_permissions_ranks WHERE id='" . $perfil['rank'] . "'");
	$rank = $ranks->fetch(PDO::FETCH_ASSOC);

	$emblemas = $bdd->query("SELECT * FROM player_badges WHERE player_id='" . $perfil['id'] . "'");
	$emblemas_count = $emblemas->rowCount();

	$badge = $bdd->query("SELECT * FROM player_badges WHERE player_id='" . $perfil['id'] . "' LIMIT 7");
	$badge_count = $badge->rowCount(); 


	$quartos = $bdd->query("SELECT * FROM rooms WHERE owner_id='" . $perfil['id'] . "'");
	$quartos_count = $quartos->rowCount();

	$room =  $bdd->query("SELECT * FROM rooms WHERE owner_id='" . $perfil['id'] . "' LIMIT 5");
	$room_count = $room->rowCount();


	$grupos = $bdd->query("SELECT * FROM group_memberships WHERE player_id='" . $perfil['id'] . "'");
	$grupos_count = $grupos->rowCount();

	$group = $bdd->query("SELECT * FROM group_memberships WHERE player_id='" . $perfil['id'] . "' LIMIT 7");
	$group_count = $group->rowCount();

	// Criando uma varivel para puxas as configurações do perfil com o id selecionado na variável declarada acima
	$player_settings = $bdd->query("SELECT * FROM player_settings WHERE player_id='" . $perfil['id'] . "' ORDER BY id DESC LIMIT 1");
	// Associando a variável $p_c a variável declarada acima
	//$psettings = $player_settings->fetch(PDO::FETCH_ASSOC);
	$page = "perfil";
	$page_name = "Perfil: " . $perfil['username'] . "";

	include('../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter"></div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div class="column-separator-left flex-column" style="width: 488px;">
							<div class="flex-column" id="display-profile" style="background-image: url(); ">
								<div class="flex-wrap margin-bottom-max" id="display-profile-top-informations">
									<div class="flex" id="display-profile-top-informations-habbo">
										<img class="margin-auto-left-right" width="32px" height="55px" src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $perfil['figure']; ?>&action=std&direction=2&head_direction=3&img_format=png&gesture=std&headonly=0&size=s">
									</div>
									<div class="margin-auto-left margin-auto-top-bottom flex-wrap" id="display-profile-top-informations-friends">
										<icon class="margin-right-minm" icon="friends"></icon>
										<?php
										$friends = $bdd->query("SELECT * FROM messenger_friendships WHERE user_one_id='" . $perfil['id'] . "'");
										$friends_count = $friends->rowCount();

										if ($friends_count >= 0) {
										?>
										<h5 class="white"><?php echo number_format($friends_count) ?> amigos</h5>
										<?php } else { ?>
										<h5 class="white">0 amigos</h5>
										<?php } ?>
									</div>
								</div>
								<div class="flex-wrap">
									<div class="flex-column">
									<?php if ($player_settings['foto_perfil'] == NULL || $player_settings['foto_perfil'] == '') { ?>
										<div id="display-profile-photo" style="background-image: url('<?php echo $hotel['site']; ?>/general/assets/img/perfil.png?<?php echo rand(999999999999, 99999999999) ?>');"></div>
										<div id="display-profile-no-photo">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $perfil['figure']; ?>&action=wav,crr=667&direction=4&head_direction=3&img_format=png&gesture=sml&headonly=0&size=n">
										</div>
									<?php } ?>
										<div class="margin-top-min gray-clear flex-wrap">
											<icon icon="clock1" class="margin-auto-top-bottom margin-right-minm"></icon>
											<h5><?php echo $status ?></h5>
										</div>
									</div>
									<div class="margin-left-min flex-column" id="display-profile-informations">
										<div class="white flex-column margin-auto-top">
											<div class="flex-wrap">
											<?php if ($perfil['gender'] == 'M') { ?>
												<icon icon="male" class="flex float-left margin-right-minm margin-auto-top-bottom"></icon>
											<?php } else if ($perfil['gender'] == 'F') { ?>
												<icon icon="female" class="flex float-left margin-right-minm margin-auto-top-bottom"></icon>
											<?php } ?>
												<h3 class="bold margin-right-minm"><?php echo $perfil['username'] ?></h3>
												<h5 class="no-bold margin-auto-top-bottom">| <?php echo $rank['name'] ?></h5>
											</div>
											<h5 class="margin-top-minm"><?php echo $perfil['motto'] ?></h5>
											<div class="flex-column margin-top-max gray-clear">
												<div class="flex-wrap">
													<icon icon="room" class="margin-right-minm"></icon>
													<h5>Brasil</h5>
												</div>
												<div class="flex-wrap margin-top-minm">
													<icon icon="link" class="margin-right-minm"></icon>
													<a href="" target="_blank" class="no-link"><h5 class="gray-clear">Link aqui</h5></a>
												</div>
												<div class="flex-wrap margin-top-minm">
													<icon icon="display-identity" class="margin-right-minm"></icon>
													<h5>Conta criada em <?php echo strftime('%d de %B de %Y', $perfil['reg_date']) ?></h5>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="flex-column general-white-box padding-none margin-top-min">
								<div class="padding-md overflow-hidden" id="general-white-box-header2">
									<div style="position: absolute;background: url('http://localhost/general/assets/img/comments.png') -17px -45px / auto no-repeat;width: 198px;height: 57px;top: 0;right: 0;transform: scaleX(-1);"></div>
									<label class="gray">
										<h5 class="bold">Recadinhos para <?php if ($perfil['gender'] == 'F') { ?>a<?php } else { ?>o<?php } ?> <?php echo $perfil['username'] ?></h5>
										<h6>Os recados que os usuários deixam no perfil ficam aqui!</h6>
									</label>
								</div>
								<div class="bg-1">
									<div class="flex-column" id="errands">
									<?php
										$recados_count = $recados = $bdd->query("SELECT * FROM hybbe_recados WHERE para_user='" . $perfil['id'] . "'");
										if ($recados_count->rowCount() >= 1) {
										$recados = $bdd->query("SELECT * FROM hybbe_recados WHERE para_user='" . $perfil['id'] . "' ORDER BY time_recado DESC LIMIT 0,1");
										while ($recado = $recados->fetch(PDO::FETCH_ASSOC)) {
											$pegar_autor = $bdd->query("SELECT * FROM players WHERE id='" . $recado['user_deixou'] . "'");
											$autor = $pegar_autor->fetch(PDO::FETCH_ASSOC);
									?>
										<div class="flex margin-top-md margin-left-md margin-right-md" id="errand-box">
											<div class="margin-right-min">
												<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $autor['figure']; ?>&action=std&direction=2&head_direction=3&img_format=png&gesture=std&headonly=0&size=s">
											</div>
											<label class="gray-clear" id="errand-message">
												<div class="flex margin-bottom-min">
													<h6 class="fs-12"><b><?php echo $autor['username']; ?></b> | <?php echo strftime('%d de %B de %Y', $recado['time_recado']); ?> as <?php echo strftime('%H:%M', $recado['time_recado']); ?></h6>
												<?php
													if ($user['id'] == $recado['user_deixou'] || $user['id'] == $recado['para_user']) {
														$excluir_recado = $_POST['excluir_recado'];
														if(isset($excluir_recado)) {
															$bdd->query("DELETE FROM hybbe_recados WHERE id='" . $recado['id'] . "'");
															redirect('' . $hotel['site'] . '/perfil/' . $perfil['username'] . '');
														}
												?>
													<form class="margin-auto-left" method="POST">
														<button type="submit" name="excluir_recado" class="reset-button flex fs-12 gray-clear">(Excluir)</button>
													</form>
												<?php } ?>
												</div>
												<h6 class="fs-12 break-word"><?php echo $recado['recado']; ?></h6>
											</label>
										</div>
									<?php } ?>
									<?php 
										$recados = $bdd->query("SELECT * FROM hybbe_recados WHERE para_user='" . $perfil['id'] . "' ORDER BY time_recado DESC LIMIT 1,500");
										while ($recado = $recados->fetch(PDO::FETCH_ASSOC)) {
											$pegar_autor = $bdd->query("SELECT * FROM players WHERE id='" . $recado['user_deixou'] . "'");
											$autor = $pegar_autor->fetch(PDO::FETCH_ASSOC);
									?>
										<div class="flex margin-top-minm margin-left-md margin-right-md" id="errand-box">
											<div class="margin-right-min">
												<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $autor['figure']; ?>&action=std&direction=2&head_direction=3&img_format=png&gesture=std&headonly=0&size=s">
											</div>
											<label class="gray-clear" id="errand-message">
												<div class="flex margin-bottom-min">
													<h6 class="fs-12"><b><?php echo $autor['username']; ?></b> | <?php echo strftime('%d de %B de %Y', $recado['time_recado']); ?> as <?php echo strftime('%H:%M', $recado['time_recado']); ?></h6>
												<?php
													if ($user['id'] == $recado['user_deixou'] || $user['id'] == $recado['para_user']) {
														$excluir_recado = $_POST['excluir_recado'];
														if(isset($excluir_recado)) {
															$bdd->query("DELETE FROM hybbe_recados WHERE id='" . $recado['id'] . "'");
															redirect('' . $hotel['site'] . '/perfil/' . $perfil['username'] . '');
														}
												?>
													<form class="margin-auto-left" method="POST">
														<button type="submit" name="excluir_recado" class="reset-button flex fs-12 gray-clear">(Excluir)</button>
													</form>
												<?php } ?>
												</div>
												<h6 class="fs-12 break-word"><?php echo $recado['recado']; ?></h6>
											</label>
										</div>
									<?php } } else if ($recados_count->rowCount() <= 0) {?>
										<div class="flex margin-top-min" id="display-groups-area-warn">
											<h5 class="gray-clear margin-auto">Parece que <?php echo $perfil['username']; ?> não tem nenhum recado!</h5>
										</div>
									<?php } ?>
									</div>
								<?php if ($user['id'] == $perfil['id']) { ?>
									<div class="flex-column padding-md padding-top-none margin-top-md">
										<h6 class="gray margin-bottom-min">Você não pode deixar um recado para você mesmo! Mas aqui ficam os recados que os usuários deixam para você, caso alguém deixou um que não te agrada você pode <b>excluir</b> o mesmo e denunciar o (ou a) habbo que deixou o comentário que não lhe agradou para a nossa equipe!</h6>
										<h6 class="gray">Lembre-se de que ao denunciar, você deve enviar um print para comprovar a sua denuncia!</h6>
									</div>
								<?php } else { ?>
									<div class="flex-column padding-md padding-top-none margin-top-md">
										<form method="POST" id="errands-form">
											<?php 
												$recado = FilterText($_POST['errand_message']);
												$puxar_recados = $bdd->query("SELECT * FROM hybbe_recados WHERE para_user='" . $perfil['id'] . "' AND user_deixou='" . $user['id'] . "' ORDER BY time_recado DESC");
												$recadus = $puxar_recados->fetch(PDO::FETCH_ASSOC);

												if (isset($_POST['errand_message'])) {
													if ($recado == '') {
														$erro_recado = true;
														$erro_type = 'general-error';
														$erro_recado_text = 'Você não pode deixar o recado vazia, a final de contas não se lê um recado vázio!';
													}/* else if ($recadus['time_recado'] >= time() - 600) {
														$erro_recado = true;
														$erro_type = 'general-error-time';
														$erro_recado_text = 'Espere um pouco, você tem que esperar 10 minutos para enviar outro recado!';
													}*/ else if ($user['activity_points'] < '0' || $user['activity_points'] < '250') {
														$erro_recado = true;
														$erro_type = 'general-error';
														$erro_recado_text = 'Você não tem rubis suficientes para deixar um recado para ' . $perfil['username'] . '!';
													} else {
														$time_recado = time();
														$bdd->query("INSERT INTO hybbe_recados (user_deixou, para_user, time_recado, recado) VALUES ('" . $user['id'] . "', '" . $perfil['id'] . "', '" . $time_recado . "','" . FilterText($recado) . "')");
														$bdd->query("UPDATE players SET activity_points='" . $user['activity_points'] . "'-250 WHERE id='" . $user['id'] . "'");

														$recado_enviado = true;
														redirect('' . $hotel['site'] . '/perfil/' . $perfil['username'] . '');
													}
												}
											?>
											<div class="flex-column">
											<?php if ($erro_recado == true) { ?>
												<label class="<?php echo $erro_type; ?> margin-bottom-min">
													<h6 class="bold margin-auto-top-bottom"><?php echo FilterText($erro_recado_text); ?></h6>
												</label>
											<?php } ?>
												<div class="flex">
													<div class="errand-message" id="editeur" placeholder="Escreva aqui o seu recado para <?php echo $perfil['username']; ?>" contenteditable="true"></div>
													<div class="flex-column" id="errand-message-styles">
														<button class="reset-button margin-auto-bottom" onclick="Style('bold');" type="button">
															<b>B</b>
														</button>
														<button class="reset-button" onclick="Style('italic');" type="button">
															<i>I</i>
														</button>
														<button class="reset-button margin-auto-top" onclick="Style('underline');" type="button">
															<u>U</u>
														</button>
													</div>
												</div>
												<button type="submit" class="green-button-2" style="width: 100%;height: 35px;border-radius: 0 0 3px 3px;">
													<label class="white margin-auto flex">
														<h5 class="bold">Enviar recado</h5>
														<h6 class="flex margin-left-min margin-auto-top-bottom">(<icon icon="rubys" class="margin-right-minm"></icon> 250 rubis)</h6>
													</label>
												</button>
											<?php if ($recado_enviado == true) { ?>
												<label class="general-sucess margin-top-min margin-auto-left-right">
													<h6 class="bold margin-auto-top-bottom">Você deixou com sucesso o seu recado para <?php echo $perfil['username']; ?>!</h6>
												</label>
											<?php } ?>
											</div>
										</form>
									</div>
								<?php } ?>
								</div>
							</div>
						</div>							
						<div class="column-separator-right" style="width: 432px;">
							<div class="flex-column general-white-box padding-none">
								<div class="padding-md overflow-hidden" id="general-white-box-header2">
									<label class="gray">
										<h5 class="bold">Estatísticas <?php if ($perfil['gender'] == 'F') { ?>da<?php } else { ?>do<?php } ?> <?php echo $perfil['username'] ?></h5>
										<h6>Moedas, ruby's, gemas e esmeraldas</h6>
									</label>
								</div>
								<div class="flex padding-min bg-1">
									<div class="flex-wrap margin-right-minm" id="display-profile-rubys">
										<icon icon="rubys" class="margin-right-minm"></icon>
										<h5 class="white"><?php echo number_format($perfil['activity_points']) ?></h5>
									</div>
									<div class="flex-wrap margin-right-minm" id="display-profile-gems">
										<icon icon="gems" class="margin-right-minm"></icon>
										<h5 class="white"><?php echo number_format($perfil['vip_points']) ?></h5>
									</div>
									<div class="flex-wrap" id="display-profile-emeralds">
										<icon icon="emeralds" class="margin-right-minm"></icon>
										<h5 class="white"><?php echo number_format($perfil['sesonal_points']) ?></h5>
									</div>
								</div>
							</div>
							<div class="flex-column general-white-box margin-top-min padding-none">
								<div class="padding-md overflow-hidden" id="general-white-box-header2">
									<div style="position: absolute;background: url('http://localhost/general/assets/img/sprite.png') -784px -962px / auto no-repeat;width: 361px;height: 139px;top: -70px;right: -145px;"></div>
									<label class="gray">
										<h5 class="bold">Emblemas <?php if ($perfil['gender'] == 'F') { ?>da<?php } else { ?>do<?php } ?> <?php echo $perfil['username'] ?></h5>
										<h6><?php echo $badge_count; ?> de <?php echo $emblemas_count; ?> emblemas</h6>
									</label>
								</div>
								<div class="flex-wrap padding-min padding-right-none bg-1" id="display-badges-area">
								<?php
									if ($emblemas_count > 0) {
										while ($data = $badge->fetch(PDO::FETCH_ASSOC)) {
								?>
									<div class="margin-right-min flex" id="display-badges-box">
										<img class="margin-auto" src="<?php echo $hotel['site'] ?>/swfs/c_images/album1584/<?php echo $data['badge_code'] ?>.gif">
									</div>
								<?php } } else { ?>
									<div class="padding-right-min flex" id="display-rooms-area-warn">
										<h5 class="gray-clear margin-auto">Parece que <?php echo $perfil['username']; ?> não tem nenhum emblema!</h5>
									</div>
								<?php } ?>
								</div>
							</div>
							<div class="flex-column general-white-box margin-top-min padding-none">
								<div class="padding-md overflow-hidden" id="general-white-box-header2">
									<div style="position: absolute;background: url('http://localhost/general/assets/img/sprite.png') -1px -1008px / auto no-repeat;width: 396px;height: 93px;top: -35px;right: -170px;"></div>
									<label class="gray">
										<h5 class="bold">Quartos <?php if ($perfil['gender'] == 'F') { ?>da<?php } else { ?>do<?php } ?> <?php echo $perfil['username'] ?></h5>
										<h6><?php echo $room_count; ?> de <?php echo $quartos_count ?> quartos</h6>
									</label>
								</div>
								<div class="flex-column padding-min padding-top-minm bg-1">
								<?php
									if ($quartos_count > 0) {
										while ($data = $room->fetch(PDO::FETCH_ASSOC)) {
								?>
									<div class="margin-top-minm" id="list-room-div">
										<h5 class="gray"><?php echo $data['name'] ?></h5>
									</div>
								<?php } } else { ?>
									<div class="margin-top-minm flex" id="display-rooms-area-warn">
										<h5 class="gray-clear margin-auto">Parece que <?php echo $perfil['username']; ?> não tem nenhum quarto!</h5>
									</div>
								<?php } ?>
								</div>
							</div>
							<div class="flex-column general-white-box margin-top-min padding-none">
								<div class="padding-md overflow-hidden" id="general-white-box-header2">
									<div style="position: absolute;background: url('http://localhost/general/assets/img/sprite.png') -1162px -961px / auto no-repeat;width: 512px;height: 140px;top: -30px;right: -145px;transform: scale(0.5);image-rendering: pixelated;"></div>
									<label class="gray">
										<h5 class="bold">Grupos <?php if ($perfil['gender'] == 'F') { ?>da<?php } else { ?>do<?php } ?> <?php echo $perfil['username'] ?></h5>
										<h6><?php echo $group_count; ?> de <?php echo $grupos_count; ?> grupos</h6>
									</label>
								</div>
								<div class="flex-wrap padding-min padding-right-none bg-1">
									<?php
									if ($grupos_count > 0) {
										while ($data = $group->fetch(PDO::FETCH_ASSOC)) {
											$grupos = $bdd->query("SELECT * FROM groups WHERE id='" . $data['group_id'] . "'");
											while ($grupo = $grupos->fetch(PDO::FETCH_ASSOC)) {
									?>
									<div class="margin-right-min" id="display-groups-box" title="<?php echo $grupo['name']; ?>">
										<img width="39px" height="39px" src="https://hybbe.top/habbo-imaging/badge/<?php echo $grupo['badge'] ?>.gif">
									</div>
									<?php } } } else { ?>
									<div class="padding-right-min flex" id="display-groups-area-warn">
										<h5 class="gray-clear margin-auto">Parece que <?php echo $perfil['username']; ?> não está em nenhum grupo!</h5>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php include('../../config/includes/footer.php'); ?>
				</div>
			</div>
			<?php echo $submits; ?>
<?php include('../../config/includes/bottom.php');