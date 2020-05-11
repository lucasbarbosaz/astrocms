<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = 'comunidade';
	$page_name = "Equipe: Staff";

	include('../../../config/includes/head.php');
?>

	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" team></div>
					<a href="http://localhost/comunidade/equipe" id="header-ohter-area-menu-button" visited>Equipe</a>
						<separator></separator>
					<a href="http://localhost/comunidade/equipe/colaboradores" id="header-ohter-area-menu-button">Colaboradores</a>
				</div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div class="column-separator-left" style="width: 515px;">
							<div class="flex-column padding-none" id="general-white-box">
								<div class="flex-wrap padding-min overflow-hidden" id="general-white-box-header">
									<div class="flex" id="general-white-box-header-icon">
										<icon icon="badge-ceo" class="margin-auto"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">CEO's</h4>
										<h5>Responsáveis por gerenciar a comunidade e o hotel!</h5>
									</label>
								</div>
									<hr>
								<div class="flex-column">
									<?php
									
										$ranks = $bdd->query("SELECT * FROM server_permissions_ranks WHERE id='11' ORDER BY id DESC");
										while($rank = $ranks->fetch(PDO::FETCH_ASSOC)) {
											$row_rank = $bdd->query("SELECT * FROM players WHERE rank='" . $rank . "' ORDER BY rank DESC");
											while ($user_rank = $row_rank->fetch(PDO::FETCH_ASSOC)) {
												if ($user_rank['online'] == '1') {
													$status = 'online';
												} else {
													$status = 'offline';
												}
									?>
									<div class="flex-wrap bg-1">
										<div id="team-display-habbo">
											<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $user_rank['figure']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=wav">
										</div>
										<label class="gray margin-auto-top-bottom flex-column">
											<h5 class="bold fs-14 flex-wrap"><?php echo $user_rank['username']; ?> <div class="margin-left-minm margin-auto-top-bottom" status="<?php echo $status; ?>"></div></h5>
											<h6><?php echo $user_rank['motto']; ?></h6>
										</label>
									</div>
									<hr>
									<?php } } ?>
								</div>
							</div>
							<div class="flex-column padding-none margin-top-min" id="general-white-box">
								<div class="flex-wrap padding-min overflow-hidden" id="general-white-box-header">
									<div class="flex" id="general-white-box-header-icon">
										<icon icon="badge-ger" class="margin-auto"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Gerência</h4>
										<h5>Contratações, demissões & organização da equipe.</h5>
									</label>
								</div>
									<hr>
								<div class="flex-column">
									<?php
									
										$ranks = $bdd->query("SELECT * FROM server_permissions_ranks WHERE id='10' ORDER BY id DESC");
										while($rank = $ranks->fetch(PDO::FETCH_ASSOC)) {
											$row_rank = $bdd->query("SELECT * FROM players WHERE rank='" . $rank['id'] . "' ORDER BY rank DESC");
											while ($user_rank = $row_rank->fetch(PDO::FETCH_ASSOC)) {
												if ($user_rank['online'] == '1') {
													$status = 'online';
												} else {
													$status = 'offline';
												}
									?>
									<div class="flex-wrap bg-1">
										<div id="team-display-habbo">
											<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $user_rank['figure']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=wav">
										</div>
										<label class="gray margin-auto-top-bottom flex-column">
											<h5 class="bold fs-14 flex-wrap"><?php echo $user_rank['username']; ?> <div class="margin-left-minm margin-auto-top-bottom" status="<?php echo $status; ?>"></div></h5>
											<h6><?php echo $user_rank['motto']; ?></h6>
										</label>
									</div>
									<hr>
									<?php } } ?>
								</div>
							</div>
							<div class="flex-column padding-none margin-top-min" id="general-white-box">
								<div class="flex-wrap padding-min overflow-hidden" id="general-white-box-header">
									<div class="flex" id="general-white-box-header-icon">
										<icon icon="badge-adm" class="margin-auto"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Administração</h4>
										<h5>Atividades, notícias, promoções e entretenimento geral.</h5>
									</label>
								</div>
									<hr>
								<div class="flex-column">
									<?php
									
										$ranks = $bdd->query("SELECT * FROM server_permissions_ranks WHERE id='9' ORDER BY id DESC");
										while($rank = $ranks->fetch(PDO::FETCH_ASSOC)) {
											$row_rank = $bdd->query("SELECT * FROM players WHERE rank='" . $rank['id'] . "' ORDER BY rank DESC");
											while ($user_rank = $row_rank->fetch(PDO::FETCH_ASSOC)) {
												if ($user_rank['online'] == '1') {
													$status = 'online';
												} else {
													$status = 'offline';
												}
									?>
									<div class="flex-wrap bg-1">
										<div id="team-display-habbo">
											<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $user_rank['figure']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=wav">
										</div>
										<label class="gray margin-auto-top-bottom flex-column">
											<h5 class="bold fs-14 flex-wrap"><?php echo $user_rank['username']; ?> <div class="margin-left-minm margin-auto-top-bottom" status="<?php echo $status; ?>"></div></h5>
											<h6><?php echo $user_rank['motto']; ?></h6>
										</label>
									</div>
									<hr>
									<?php } } ?>
								</div>
							</div>
							<div class="flex-column padding-none margin-top-min" id="general-white-box">
								<div class="flex-wrap padding-min overflow-hidden" id="general-white-box-header">
									<div class="flex" id="general-white-box-header-icon">
										<icon icon="badge-mod" class="margin-auto"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Moderação</h4>
										<h5>Realizar eventos, ouvir a comunidade e atender os embaixadores.</h5>
									</label>
								</div>
									<hr>
								<div class="flex-column">
									<?php
									
										$ranks = $bdd->query("SELECT * FROM server_permissions_ranks WHERE id='8' ORDER BY id DESC");
										while($rank = $ranks->fetch(PDO::FETCH_ASSOC)) {
											$row_rank = $bdd->query("SELECT * FROM players WHERE rank='" . $rank['id'] . "' ORDER BY rank DESC");
											while ($user_rank = $row_rank->fetch(PDO::FETCH_ASSOC)) {
												if ($user_rank['online'] == '1') {
													$status = 'online';
												} else {
													$status = 'offline';
												}
									?>
									<div class="flex-wrap bg-1">
										<div id="team-display-habbo">
											<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $user_rank['figure']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=wav">
										</div>
										<label class="gray margin-auto-top-bottom flex-column">
											<h5 class="bold fs-14 flex-wrap"><?php echo $user_rank['username']; ?> <div class="margin-left-minm margin-auto-top-bottom" status="<?php echo $status; ?>"></div></h5>
											<h6><?php echo $user_rank['motto']; ?></h6>
										</label>
									</div>
									<hr>
									<?php } } ?>
								</div>
							</div>
						</div>
						<div class="column-separator-right" style="width: 405px;">
							<div class="flex-column padding-none" id="general-white-box">
								<div class="flex-wrap padding-min overflow-hidden" id="general-white-box-header">
									<div class="flex" id="general-white-box-header-icon">
										<icon icon="badge-dev" class="margin-auto"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Desenvolvimeto</h4>
										<h5>Responsáveis pelo funcionamento geral do hotel.</h5>
									</label>
								</div>
									<hr>
								<div class="flex-column">
									<?php
									
										$ranks = $bdd->query("SELECT * FROM server_permissions_ranks WHERE id='12' ORDER BY id DESC");
										while($rank = $ranks->fetch(PDO::FETCH_ASSOC)) {
											$row_rank = $bdd->query("SELECT * FROM players WHERE rank='" . $rank['id'] . "' ORDER BY rank DESC");
											while ($user_rank = $row_rank->fetch(PDO::FETCH_ASSOC)) {
												if ($user_rank['online'] == '1') {
													$status = 'online';
												} else {
													$status = 'offline';
												}
									?>
									<div class="flex-wrap bg-1">
										<div id="team-display-habbo">
											<img src="<?php echo $hotel['avatarimage'] ?>figure=<?php echo $user_rank['figure']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=wav">
										</div>
										<label class="gray margin-auto-top-bottom flex-column">
											<h5 class="bold fs-14 flex-wrap"><?php echo $user_rank['username']; ?> <div class="margin-left-minm margin-auto-top-bottom" status="<?php echo $status; ?>"></div></h5>
											<h6><?php echo $user_rank['motto']; ?></h6>
										</label>
									</div>
									<hr>
									<?php } } ?>
								</div>
							</div>
							<div class="flex-column padding-none margin-top-min" id="general-white-box">
								<div class="flex-wrap padding-min bg-1 overflow-hidden" id="general-white-box-header">
									<div class="flex" id="general-white-box-header-icon">
										<icon icon="help" class="margin-auto"></icon>
									</div>
									<label class="gray margin-auto-top-bottom">
										<h4 class="bold">Equipe Hybbe</h4>
										<h5>Quem nós somos, o que fazemos?</h5>
									</label>
								</div>
									<hr>
								<div class="gray margin-auto-top-bottom padding-md">
									<h5>A equipe sempre está a sua disposição com intuito de anteder todas as necessidades possíveis de todos os usuários e ouvir a comunidade sempre a comunidade do hotel ao máximo.</h5>
									<h5 class="margin-top-min">Para a segurança de todos, e principalmente evitar enganos dentro do hotel, todos os staffs possuem um emblema como identificação que pode ser visto claramente ao entrar no hotel.</h5>
									<h5 class="margin-top-min">Então caso alguém se passe por um membro da equipe denuncie o mas rápido possível!</h5>
									<div class="margin-top-md">
										<h5 class="bold uppercase">Cuidado!</h5>
										<h5 class="margin-top-minm">Os staffs nunca vão pedir a sua senha, caso alguém à peça denuncie a um membro superior da equipe</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include('../../../config/includes/footer.php'); ?>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>
