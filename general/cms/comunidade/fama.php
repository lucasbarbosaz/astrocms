<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = "comunidade";
	$page_name = "Hall da Fama: Fama";

	include('../../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" halloffame></div>
					<a href="http://localhost/comunidade/halldafama/fama" id="header-ohter-area-menu-button" visited>Fama</a>
						<separator></separator>
					<a href="http://localhost/comunidade/halldafama/jogadores" id="header-ohter-area-menu-button">Jogadores</a>
				</div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div class="flex-column" id="content">
						<div id="hall-of-fame-users-container">
							<div class="margin-right-min" id="hall-of-fame-content" rubys>
								<div id="hall-of-fame-header">Mais ricos em rubis</div>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY activity_points DESC LIMIT 0,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['activity_points']); ?></b> rubis</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="1st"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY activity_points DESC LIMIT 1,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['activity_points']); ?></b> rubis</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="2nd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY activity_points DESC LIMIT 2,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['activity_points']); ?></b> rubis</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="3rd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY activity_points DESC LIMIT 3,7");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['activity_points']); ?></b> rubis</h6>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
							<div class="margin-right-min" id="hall-of-fame-content" gems>
								<div id="hall-of-fame-header">Mais ricos em gemas</div>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY vip_points DESC LIMIT 0,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['vip_points']); ?></b> gemas</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="1st"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY vip_points DESC LIMIT 1,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['vip_points']); ?></b> gemas</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="2nd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY vip_points DESC LIMIT 2,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['vip_points']); ?></b> gemas</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="3rd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY vip_points DESC LIMIT 3,7");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['vip_points']); ?></b> gemas</h6>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
							<div id="hall-of-fame-content" emeralds>
								<div id="hall-of-fame-header">Mais ricos em esmeraldas</div>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY seasonal_points DESC LIMIT 0,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['seasonal_points']); ?></b> esmeraldas</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="1st"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY seasonal_points DESC LIMIT 1,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['seasonal_points']); ?></b> esmeraldas</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="2nd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY seasonal_points DESC LIMIT 2,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['seasonal_points']); ?></b> esmeraldas</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="3rd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY seasonal_points DESC LIMIT 3,7");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ter <b><?php echo number_format($resultado['seasonal_points']); ?></b> esmeraldas</h6>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
					</div>
					<?php include('../../../config/includes/footer.php'); ?>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>