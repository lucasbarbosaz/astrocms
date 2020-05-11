<?php
	require_once '../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = "comunidade";
	$page_name = "Comunidade";

	include('../../config/includes/head.php');
?>
	<body class="grid-template-rows">
		<?php include('../../config/includes/header.php'); ?>
			<div id="header-other-area">
				<div class="webcenter">
					<div id="header-other-area-icon" community></div>
					<a href="<?php echo $hotel['site']; ?>/comunidade/halldafama" id="header-ohter-area-menu-button">Hall da Fama</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/comunidade/equipe" id="header-ohter-area-menu-button">Equipe</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/comunidade/forum" id="header-ohter-area-menu-button">Fórum</a>
						<separator></separator>
					<a href="<?php echo $hotel['site']; ?>/comunidade/radio" id="header-ohter-area-menu-button">Rádio</a>
				</div>
			</div>
		</header>
		<container>
			<div id="container">
				<div class="webcenter flex-column">
					<div id="content">
						<div id="active-promotions-container">
							<div id="active-promotions-header">
								<h5 class="white">Promoções ativas</h5>
							</div>
							<div id="active-promotions-list">
								<h6 class="gray margin-bottom-minm" id="active-promotions-info">Confira aqui as promoções ativar recentemente lançadas para que você possa participar e ganhar prêmios!</h6>
								<div id="active-promotions-scroll">
									<?php 
										$puxar_noticia = $bdd->query("SELECT * FROM habbo_news WHERE category='Promoções' AND formulario='1' ORDER BY time_expire DESC LIMIT 0,1");
										while ($noticia = $puxar_noticia->fetch(PDO::FETCH_ASSOC)) {
									?>
									<a href="<?php echo $hotel['site']; ?>/noticia/<?php echo $noticia['id']; ?>" class="no-link" id="active-promotions-item">
										<div class="margin-right-min" id="active-promotions-badge">
											<img src="<?php echo $noticia['image_url'] ?>">
										</div>
										<label class="gray" id="active-promotions-label">
											<div class="flex">
												<h5 class="bold text-nowrap"><?php echo $noticia['title']; ?></h5>
												<h6 class="margin-left-minm margin-auto-top-bottom">por <?php echo $noticia['autor']; ?></h6>
											</div>
											<h6 class="text-nowrap">Expira em <?php echo strftime('%d de %B de %Y', $noticia['time_expire']); ?></h6>
										</label>
									</a>
									<?php } ?>
									<?php 
										$puxar_noticia = $bdd->query("SELECT * FROM habbo_news WHERE category='Promoções' AND formulario='1' ORDER BY time_expire DESC LIMIT 1,50");
										if ($puxar_noticia->rowCount() > 1) {
											while ($noticia = $puxar_noticia->fetch(PDO::FETCH_ASSOC)) {
									?>
									<a href="<?php echo $hotel['site']; ?>/noticia/<?php echo $noticia['id']; ?>" class="no-link margin-top-minm" id="active-promotions-item">
										<div class="margin-right-min" id="active-promotions-badge">
											<img src="<?php echo $noticia['image_url'] ?>">
										</div>
										<label class="gray" id="active-promotions-label">
											<div class="flex">
												<h5 class="bold text-nowrap"><?php echo $noticia['title']; ?></h5>
												<h6 class="margin-left-minm margin-auto-top-bottom">por <?php echo $noticia['autor']; ?></h6>
											</div>
											<h6 class="text-nowrap">Expira em <?php echo strftime('%d de %B de %Y', $noticia['time_expire']); ?></h6>
										</label>
									</a>
									<?php } } ?>
								</div>
							</div>
						</div>
						<div id="discord-community-container">
							<div id="discord-community-label">
								<h2 class="gray bold">Entre em nosso servidor do Discord!</h2>
								<h6 class="gray" style="margin: 0 0 10px 0;">No servidor do discord do Hybbe Hotel, rolam diversas coisas legais para o entretenimento e diversão dos jogadores, por lá você pode encontrar:</h6>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Mais de 600 membros!</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Muitos sorteios de mobis raros exclusivos!</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Entretenimento e diversão a mil!</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Não perca nenhuma de nossas noticías, você sempre recebrá notificações.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Apoio ao jogadores em questões de segurança.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Segurança rígida para uma diversão saudavél.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Minerador de <b>ruby's</b> que podem ser trocados.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Canal de reclamação, denúncias e sugestões.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Moderação competente para um lugar mais agradavél.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Encontre jogadores novos jogadores através de seus nomes.</h5>
								</div>
								<div id="discord-community-label-item-list" left>
									<h5 class="gray">Saiba tudo que vai vir de novo no hotel.</h5>
								</div>
							</div>
							<div class="no-select" id="discord-community-widget">
								<div id="discord-community-widget-icon"></div>
								<div id="discord-community-widget-server-info">
									<div id="discord-community-widget-server-name">Hybbe Hotel</div>
									<div id="discord-community-widget-server-onlines">
										<img src="https://discordapp.com/api/guilds/429193985794375680/widget.png?<?php echo time(); ?>" style="position: relative;margin: 0 0 0 -28px;"/>
									</div>
								</div>
								<a href="<?php echo $hotel['discord'] ?>" target="_blank" class="no-link" id="discord-community-widget-enter-now">Entre agora mesmo!</a>
							</div>
						</div>
					</div>
					<?php include('../../config/includes/footer.php'); ?>
				</div>
			</div>
<?php include('../../config/includes/bottom.php'); ?>
