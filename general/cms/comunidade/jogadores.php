<?php
	require_once '../../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = "comunidade";
	$page_name = "Hall da Fama: Jogadores";

	include('../../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" halloffame></div>
					<a href="http://localhost/comunidade/halldafama/fama" id="header-ohter-area-menu-button">Fama</a>
						<separator></separator>
					<a href="http://localhost/comunidade/halldafama/jogadores" id="header-ohter-area-menu-button" visited>Jogadores</a>
				</div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div id="hall-of-fame-gamers-content">
							<div class="margin-right-min" id="hall-of-fame-content" events>
								<div id="hall-of-fame-header">Mais pontos em eventos</div>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY premiar DESC LIMIT 0,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['premiar']); ?></b> eventos</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="1st"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY premiar DESC LIMIT 1,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['premiar']); ?></b> eventos</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="2nd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY premiar DESC LIMIT 2,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['premiar']); ?></b> eventos</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="3rd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY premiar DESC LIMIT 3,2");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['premiar']); ?></b> eventos</h6>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
							<div class="margin-right-min" id="hall-of-fame-content" promotions>
								<div id="hall-of-fame-header">Mais promoções ganhas</div>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY promocoes DESC LIMIT 0,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['promocoes']); ?></b> promoções</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="1st"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY promocoes DESC LIMIT 1,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['promocoes']); ?></b> promoções</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="2nd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY promocoes DESC LIMIT 2,1");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['promocoes']); ?></b> promoções</h6>
										</div>
									</div>
									<div id="hall-of-fame-place" place="3rd"></div>
								</div>
							<?php } ?>
							<?php
								$consulta = $bdd->query("SELECT * FROM players WHERE rank < 6 ORDER BY promocoes DESC LIMIT 3,2");
								while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
							?>
								<div id="hall-of-fame-boxes">
									<div id="hall-of-fame-box">
										<div id="hall-of-fame-box-habbo-imager">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $resultado['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<div id="hall-of-fame-box-label">
											<h5 class="bold" id="hall-of-fame-label-username"><?php echo $resultado['username']; ?></h5>
											<h6 id="hall-of-fame-label-amount">por ganhar <b><?php echo number_format($resultado['promocoes']); ?></b> promoções</h6>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
							<div id="hall-of-fame-content">
								<div class="bg-1 padding-md general-radius">
									<label class="flex-column gray">
										<h5 class="margin-bottom-md">Este é o hall da fama onde você tem a chance de ficar entre os 5 usuários que fazem mais pontos em eventos ou que participaram e ganharam promoções!</h5>
										<h5>Ao final de todo mês este hall da fama é resetado, assim dando uma nova chance para que as outras pessoas possam aparecer por aqui, sem contar que após ser resetado os usuários que ficaram no pódio (5 lugares) ganharam prêmios sendo eles rubis, gemas, emblemas ou até raros. Não perca essa chance e participe dos eventos e ganhe promoções para receber prêmios e ficar famoso!</h5>
									</label>
								</div>
							</div>
						</div>
					</div>
					<?php include('../../../config/includes/footer.php'); ?>
				</div>
			</div>
<?php include('../../../config/includes/bottom.php'); ?>