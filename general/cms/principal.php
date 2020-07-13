<?php
	require_once '../../geral.php';

	error_reporting(0);
	ini_set(“display_errors”, 0 );

	$Auth::Session_Disconnected($_SESSION);
	$id = safe($_GET['id'],'SQL');
	$idpage = safe($_GET['idpage'],'SQL');

	$page = "principal";
	$page_name = "Principal: " . $user['username'] . "";

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
						<div id="general-alert">
							<div id="general-alert-icon"></div>
							<div id="general-alert-label">
								<div id="general-alert-label-title">Aviso</div>
								<div id="general-alert-label-description">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.</div>
							</div>
							<button class="reset-button" id="general-button-view-all">Ver mais</button>
						</div>
						<div class="column-separator-left">
							<div class="drop-shadow" id="container-player">
								<div id="player-habbo-container">
									<div id="player-habbo-image">
										<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $user['look']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=std,crr=667"/>
									</div>
									<div class="white" id="player-display-information">
										<h3 class="bold"><?php echo $user['username']; ?></h3>
										<h5><?php echo Filter('xss', $user['motto']); ?></h5>
									</div>
								</div>
								<div class="no-select" id="player-monetary-container">
									<div id="player-credits"><?php echo number_format($user['credits']); ?></div>
									<div id="player-duckets"><?php echo number_format($user['activity_points']); ?></div>
									<div id="player-diamonds"><?php echo number_format($user['vip_points']); ?></div>
									<?php if ($user['vip'] == 0) {?>
										<div id="player-vip-information">
											<a href="<?php echo $hotel['site']; ?>/loja/vip" class="no-link white">Junte-se ao <b>VIP CLUB</b>!</a>
										</div>
									<?php } else if ($user['vip'] == 1) {?>
										<div id="player-vip-information">Você é VIP!</div>
									<?php }?>
								</div>
							</div>
							<div class="drop-shadow" id="general-events-container">
								<?php 
									$eventos = $bdd->query("SELECT * FROM hybbe_eventos WHERE type = '1' LIMIT 1");
									
									while($evento = $eventos->fetch(PDO::FETCH_ASSOC)){
								?>
								<div id="recent-events" style="background-image: url(<?php echo $evento['image']; ?>);">
									<div id="recent-events-label">
										<h3 class="bold"><?php echo $evento['title']; ?></h3>
										<h6><?php echo $evento['description']; ?></h6>
									</div>
								</div>
								<?php } ?>
								<?php 
									$atividades = $bdd->query("SELECT * FROM hybbe_eventos WHERE type = '2' LIMIT 1");
									
									while($atividade = $atividades->fetch(PDO::FETCH_ASSOC)){
								?>
								<div id="special-events" style="background-image: url(<?php echo $atividade['image']; ?>);">
									<div id="special-events-label">
										<h3 class="bold"><?php echo $atividade['title']; ?></h3>
										<h6><?php echo $atividade['description']; ?></h6>
									</div>
								</div>
								<?php } ?>
                        	</div>
							<div id="featured-fame-rooms-container">
								<div id="featured-fame-container">
									<div id="featured-fame-header">Usuários famosos</div>
									<div id="featured-fame">
										<div id="featured-fame-users">
											<div id="featured-fame-credits">
												<div id="featured-fame-habbo">
                                                    <?php 
                                                    $r = $bdd->query("SELECT username,figure,credits,id FROM players WHERE rank < 4 ORDER BY vip_points DESC LIMIT 1");
                                                    $s = $r->fetch(PDO::FETCH_ASSOC);
                                                    ?>
													<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $s['figure'];?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
												</div>
												<div id="featured-fame-label">
													<h4 class="bold" username-fame><?php echo $s['username'];?></h4>
													<h6 credits><?php echo number_format($s['credits']) ?> créditos</h6>
												</div>
											</div>
											<div id="featured-fame-duckets">
												<div id="featured-fame-habbo">
                                                    <?php
                                                    $r = $bdd->query("SELECT username,figure,activity_points,id FROM players WHERE rank < 4 ORDER BY activity_points DESC LIMIT 1");
                                                    $s = $r->fetch(PDO::FETCH_ASSOC);
                                                    ?>
													<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $s['figure'];?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
												</div>
												<div id="featured-fame-label">
													<h4 class="bold" username-fame><?php echo $s['username'];?></h4>
													<h6 duckets><?php echo number_format($s['activity_points']) ?> duckets</h6>
												</div>
											</div>
											<div id="featured-fame-diamonds">
												<div id="featured-fame-habbo">
                                                    <?php
                                                    $r = $bdd->query("SELECT username,figure,vip_points,id FROM players WHERE rank < 4 ORDER BY gotw_points DESC LIMIT 1");
                                                    $s = $r->fetch(PDO::FETCH_ASSOC);
                                                    ?>
													<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $s['figure'];?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
												</div>
												<div id="featured-fame-label">
													<h4 class="bold" username-fame><?php echo $s['username'];?></h4>
													<h6 diamonds><?php echo number_format($s['vip_points']) ?> diamantes</h6>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="featured-rooms-container">
									<div id="featured-rooms-header">Quartos em destaque</div>
									<div id="featured-rooms">
									<?php 
										$rooms = $bdd->query("SELECT * FROM rooms WHERE users_now ORDER BY users_now DESC LIMIT 3");
										if ($rooms->rowCount() > 0) {
											while ($room = $rooms->fetch(PDO::FETCH_ASSOC)) {
									?>
										<div id="featured-room">
											<div class="flex-wrap">
												<?php if ($room['thumbnail'] == NULL || $room['thumbnail'] == '') { ?>
												<div id="featured-room-thumbnail" style="background-image: url('<?php echo $hotel['site']; ?>/general/assets/img/sprite.png');"></div>
												<?php } else { ?>
												<div id="featured-room-thumbnail" style="background-image: url('<?php echo $room['thumbnail']; ?>');"></div>
												<?php } ?>
												<?php 
													$pushUser = $bdd->prepare("SELECT username FROM users WHERE id = ?");
													$pushUser->bindValue(1, $room['owner']);
													$pushUser->execute();
													$fetchUser = $pushUser->fetch(PDO::FETCH_ASSOC);
												?>
												<div id="featured-room-label">
													<h4 class="bold text-nowrap"><?= $room['caption']; ?></h4>
													<h6 class="text-nowrap"><?= $fetchUser['username']; ?></h6>
												</div>
											</div>
											<div id="featured-room-interactions">
												<div id="featured-interaction-users-in-room"><?php echo number_format($room['users_now']); ?></div>
											</div>
										</div>
									<?php } } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="column-separator-right">
							<div class="margin-bottom-min">
								<div id="news-widget-controller">
									<a id="news-widget-controller-prev" class="prev" onclick="plusSlides(-1)"></a>
									<a id="news-widget-controller-next" class="next" onclick="plusSlides(1)"></a>
								</div>
								<div id="news-widget-containers">
									<?php 
										$news_widget = $bdd->query("SELECT * FROM habbo_news ORDER BY id DESC LIMIT 5");
										while ($rownews = $news_widget->fetch(PDO::FETCH_ASSOC)) {
									?>
									<div class="mySlides flex-column" id="news-widget-slide">
										<a href="<?php echo $hotel['site']; ?>/article/<?php echo $rownews['id']; ?>" class="no-link">
											<div id="news-widget-slide-image" style="background-image: url(<?php echo $rownews['image_url']; ?>)"></div>
										</a>
										<?php 
											$author = $bdd->prepare("SELECT * FROM players WHERE id = ?");
											$author->bindValue(1, $rownews['autor']);
											$author->execute();
											$fetchAuthor = $author->fetch(PDO::FETCH_ASSOC);
										?>
										<label class="flex-column gray margin-top-min" id="news-widget-slide-label">
											<h6 class="margin-bottom-minm">Categoria: <a class="no-link bold"><?php echo $rownews['category']; ?></a></h6>
											<h4 class="bold text-nowrap" id="news-widget-label-title"><?php echo $rownews['title']; ?></h4>
											<h6 class="text-nowrap" id="news-widget-label-description"><?php echo $rownews['stext']; ?></h6>
											<h6 class="padding-minm margin-auto-top" id="news-widget-slide-info">Por: <b><?php echo $fetchAuthor['username']; ?></b> em <b><?php echo strftime('%d de %B de %Y',$rownews['time']); ?></b> às <b><?php echo strftime('%H:%M',$rownews['time']); ?></b></h6>
										</label>
									</div>
								<?php } ?>
								</div>
							</div>
							<div class="flex-wrap" id="social-networks-container">
								<h3 class="gray bold">Siga nossas redes sociais!</h3>
								<a href="<?php echo $hotel['facebook']; ?>" target="_blank" class="no-link margin-top-min" id="facebook-social-network">
									<h4 class="gray bold">Curta nossa página!</h4>
								</a>
								<a href="<?php echo $hotel['twitter']; ?>" target="_blank" class="no-link margin-top-min" id="twitter-social-network">
									<h4 class="gray bold">Siga-nos no twitter!</h4>
								</a>
								<a href="<?php echo $hotel['discord']; ?>" target="_blank" class="no-link margin-top-min" id="discord-social-network">
									<h4 class="gray bold">Junte-se ao servidor no discord!</h4>
								</a>
							</div>
						</div>
					</div>
					<?php include('../../config/includes/footer.php'); ?>
				</div>
<?php include('../../config/includes/bottom.php'); ?>
