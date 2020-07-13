<?php
	session_start();
	require_once ("../../geral.php");

	if($_GET['article_id'] != "") {
		$news_id = $_GET['article_id'];
	} else {
		$sql = $bdd->query("SELECT * FROM habbo_news WHERE id != '-344' ORDER BY id DESC LIMIT 1");
		$swazzy = $sql->fetch(PDO::FETCH_ASSOC);
		$locations = is_numeric($swazzy['id']);
		header("Location: $path/article/$locations");
	}


	$useradmin_s = $bdd->prepare("SELECT * FROM players WHERE username = ?");
	$useradmin_s->bindValue(1, $_SESSION['username']);
	$useradmin_s->execute();
	$useradmin = $useradmin_s->fetch(PDO::FETCH_ASSOC);

	$figure_s = $bdd->prepare("SELECT * FROM players WHERE figure = ?");
	$figure->bindValue(1, $_POST['figure']);
	$figure->execute();
	$figure = $figure_s->fetch(PDO::FETCH_ASSOC);

	$sql2 = $bdd->query("SELECT * FROM habbo_news WHERE id != '-344' ORDER BY id DESC");
	$sql232 = $bdd->query("SELECT * FROM habbo_news WHERE id != '-344' ORDER BY id DESC");

	$noticias = $bdd->prepare("SELECT * FROM habbo_news WHERE id = ?");
	$noticias->bindValue(1, $_GET['article_id']);
	$noticias->execute();
	$noticia = $noticias->fetch(PDO::FETCH_ASSOC);

	$figure_autor = $bdd->prepare("SELECT * FROM players WHERE id = ?");
	$figure_autor->bindValue(1, $noticia['autor']);
	$figure_autor->execute();
	$autor = $figure_autor->fetch(PDO::FETCH_ASSOC);

	$page = "noticias";
	$page_name = "" . $noticia['title'] . "";

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
					<div id="content" class="flex">
						<div class="column-separator-left margin-auto-left">
							<div id="news-container">
								<div id="news-content">
									<div class="flex" id="news-header">
										<div class="margin-right-md" id="news-thumbnail" style="background-image: url('<?php echo $noticia['image_url']; ?>')">
											<div class="margin-auto-left-right" id="news-habbo-author">
												<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $autor['figure']; ?>&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=std">
											</div>
										</div>
										<label class="gray flex-column margin-auto-top-bottom width-content margin-right-md" id="news-header-label">
											<h3 class="bold"><?php echo $noticia['title']; ?></h3>
										<?php if ($noticia['stext'] != '' || $noticia['stext'] != NULL) { ?>
											<h5><?php echo $noticia['stext']; ?></h5>
										<?php } ?>
										<?php 
											$author = $bdd->prepare("SELECT * FROM players WHERE id = ?");
											$author->bindValue(1, $noticia['autor']);
											$author->execute();
											$fetchAuthor = $author->fetch(PDO::FETCH_ASSOC);
										?>
											<div class="margin-top-minm">
												<h6>Noticia postada por: <a href="<?php echo $hotel['site']; ?>/perfil/<?php echo $noticia['autor']; ?>" class="bold no-link"><?php echo $fetchAuthor['username']; ?></a> em <?php echo strftime('%d de %B de %Y', $noticia['time']); ?> às <?php echo strftime('%H:%M', $noticia['time']); ?> na categoria <b><?php echo $noticia['category']; ?></b>.</h6>
											</div>
										</label>
									</div>
										<hr>
									<div id="news-body"><?php echo $noticia['btext']?></div>
										<hr>
									<div class="padding-min flex-between">
									<?php if ($noticia['formulario'] == 1) { ?>
										<button class="reset-button flex-wrap padding-left-min padding-right-min" id="news-open-form">
											<icon icon="duck" class="margin-right-min"></icon>
											<h5 class="white margin-auto-top-bottom">Formulário</h5>
										</button>
									<?php } else if ($noticia['formulario'] == 2) { ?>
										<button class="reset-button flex-wrap padding-left-min padding-right-min" id="news-open-form" disabled>
											<icon icon="duck" class="margin-right-min"></icon>
											<h5 class="white margin-auto-top-bottom">Formulário indisponível</h5>
										</button>
									<?php } ?>
									<?php if ($noticia['badges'] != '' || $noticia['badges'] != NULL) { ?>
										<div id="news-badges-area">
											<img src="<?php echo $hotel['site']; ?>/swfs/c_images/album1584/"/>
										</div>
									<?php } ?>
										<div class="margin-auto-left margin-auto-top-bottom" id="news-interaction-area">
									<?php

										// Se o usuário estiver logado, oque estiver no if será verdadeiro. Se não, o botão de like não aparecerá
										if($_SESSION['username']) {
											$idnoticia = $_GET['article_id'];
											$consulta = $bdd->prepare("SELECT * FROM hybbe_curtidas WHERE id_post = ? AND usercurtiu = ?");
											$consulta->bindValue(1, $idnoticia);
											$consulta->bindValue(2, $user['id']);
											$consulta->execute();

											$consulta2 = $bdd->query("SELECT * FROM hybbe_curtidas WHERE id_post='" . $idnoticia . "' AND usercurtiu='" . $user['id'] . "'");
											$row = $consulta2->fetch(PDO::FETCH_ASSOC);

											if ($consulta->rowCount() <= 0) {
												$like_type = 'curtir';
											} else if ($row['status'] == '1') {
												$like_type = 'curtido';
											} else if ($row['status'] == '0') {
												$like_type = 'curtir';
											}

											// Se o resultado da consulta for menor ou igual 0, ou seja, se não existir uma consulta. Oque estiver no if será executado.
											if ($consulta->rowCount() <= 0) {
												if (isset($_POST['curtir'])) {
													$idnoticia = $_GET['article_id'];
													$consultar_noticia = $bdd->prepare("SELECT * FROM hybbe_curtidas WHERE id_post = ? AND usercurtiu = ?");
													$consultar_noticia->bindValue(1, $idnoticia);
													$consultar_noticia->bindValue(2, $user['id']);
													$consultar_noticia->execute();
													$result = $consultar_noticia->fetch(PDO::FETCH_ASSOC);

													$insertLike = $bdd->prepare("INSERT INTO hybbe_curtidas (id_post, usercurtiu, status) VALUES (?,?,?)");
													$insertLike->bindValue(1, $idnoticia);
													$insertLike->bindValue(2, $user['id']);
													$insertLike->bindValue(3, '1');
													$insertLike->execute();
													$like_type = 'curtido';
													$likes_count+1;
												}
											} else if ($consulta->rowCount() > 0 && $row['status'] == '1') {
												if (isset($_POST['curtido'])) {
													$idnoticia = $_GET['article_id'];
													$consultar_noticia = $bdd->query("SELECT * FROM hybbe_curtidas WHERE id_post='" . $idnoticia . "' AND usercurtiu='" . $user['id'] . "'");
													$result = $consultar_noticia->fetch(PDO::FETCH_ASSOC);

													$bdd->query("UPDATE hybbe_curtidas SET status='0' WHERE id_post='" . $idnoticia . "' AND usercurtiu='" . $user['id'] . "'");
													$like_type = 'curtir';
													$likes_count-1;
												}
											} else if ($consulta->rowCount() > 0 && $row['status'] == '0') {
												if (isset($_POST['curtir'])) {
													$idnoticia = $_GET['article_id'];
													$consultar_noticia = $bdd->query("SELECT * FROM hybbe_curtidas WHERE id_post='" . $idnoticia . "' AND usercurtiu='" . $user['id'] . "'");
													$result = $consultar_noticia->fetch(PDO::FETCH_ASSOC);

													$bdd->query("UPDATE hybbe_curtidas SET status='1' WHERE id_post='" . $idnoticia . "' AND usercurtiu='" . $user['id'] . "'");
													$like_type = 'curtido';
													$likes_count+1;
												}
											}

											$consulta_likes = $bdd->query("SELECT * FROM hybbe_curtidas WHERE id_post='" . $idnoticia . "' AND status='1'");
											$likes_count = $consulta_likes->rowCount();
										}
									?>  
											<div class="flex margin-auto-top-bottom">
												<label class="flex-column pointer-none" for="news" <?php echo $like_type; ?>>
													<icon icon="heart-big-noborder" class="margin-auto-left-right"></icon>
													<h5 class="pink"><?php echo $likes_count; ?> likes</h5>
												</label>
												<form action="<?php echo $hotel['site']; ?>/article/<?php echo $idnoticia; ?>" method="post" class="absolute total-content">
													<button type="submit" class="reset-button absolute total-content" name="<?php echo $like_type; ?>" id="news-interaction-like" <?php echo $like_type; ?>></button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="margin-top-min">
								<?php if($noticia['comentarios'] == 1) { ?>
									<?php

										$idPost = $_GET['article_id'];
										$consulta = $bdd->prepare("SELECT * FROM habbo_news WHERE id = ?");
										$consulta->bindValue(1, $idPost);
										$consulta->execute();
										$consulta_comentario = $bdd->query("SELECT * FROM hybbe_comentarios WHERE id_post='" . $idPost . "' AND autor='" . $user['id'] . "' ORDER BY data DESC");
										$resultado = $consulta_comentario->fetch(PDO::FETCH_ASSOC);

											if (isset($_POST['comentar'])) {

												if ($resultado['data'] >= time() - 300) {
													$error = true;
												} else {
													$idPost = $_GET['article_id'];
													$comentario = $_POST['comentario'];
													$autor = $user['id'];
													$data = time();

													$comentar = $bdd->prepare("INSERT INTO hybbe_comentarios (id_post, comentario, autor, data) VALUES(?,?,?,?)");
													$comentar->bindValue(1, $idPost);
													$comentar->bindValue(2, Filter('xss', $comentario));
													$comentar->bindValue(3, $autor);
													$comentar->bindValue(4, $data);
													$comentar->execute();
												}
											}
									?>
									<div id="news-new-comment">
										<div id="news-new-comment-habbo">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $useradmin['look'];?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
										<form action="<?php echo $hotel['site']; ?>/article/<?php echo $idPost; ?>" method="POST" class="flex-column">
											<div class="flex-wrap margin-auto-top-bottom">
												<div class="margin-left-minm margin-right-max" id="news-new-comment-area">
													<textarea name="comentario" class="emojis" id="news-new-comment-text-area" placeholder="Digite algo para comentar..."></textarea>
												</div>
												<button class="reset-button margin-left-min" type="submit" name="comentar" id="news-comment-button">Comentar</button>
                                        	</div>
                                        	<?php if ($error == true) { ?>
											<label class="general-error absolute pointer-none" style="left: 12px;bottom: 15px;">
												<h6 class="bold">Você deve esperar 5 minutos para enviar outro comentário!</h6>
											</label>
                                        	<?php } ?>
                                        </form>
									</div>
								<?php

									$consulta = $bdd->query("SELECT * FROM hybbe_comentarios WHERE id_post = '" . $idPost . "' ORDER BY data DESC");
									if ($consulta->rowCount() <= 0) {
								?>
									<div class="flex" id="news-user-comment">
										<icon icon="warning-blue" class="margin-right-min margin-auto-top-bottom"></icon>
										<label class="gray">
											<h5 class="bold uppercase margin-auto-top-bottom">Sem comentários!</h5>
											<h5>Parece que ainda ninguém comentou nesta noticia, que tal ser <?php if ($user['gender'] == 'F') { ?>a primeira<?php } else { ?>o primeiro<?php } ?> a comentar.</h5>
										</label>
									</div>
								<?php } else { ?>
								<?php
									$idPost = $_GET['article_id'];
									while ($comentario = $consulta->fetch(PDO::FETCH_ASSOC)) {
yers										while ($user_comentario = $comentario_info->fetch(PDO::FETCH_ASSOC)) {
								?>
									<div class="flex-column">
										<div class="flex" id="news-user-comment">
											<div id="news-user-comment-habbo">
												<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $user_comentario['look']; ?>&headonly=0&size=s&gesture=std&direction=2&head_direction=3&action=std" style="position: relative;width: 32;height: 55px;margin: 0 auto;"/>
											</div> 
											<label class="margin-auto-top-bottom flex-column content-width break-word no-select gray" id="news-comment-area">
												<h5 class="margin-bottom-minm"><?= Filter('xss', Filter('emoji', $comentario['comentario'])); ?></h5>
												<h6>Por: <a href="<?php echo $hotel['site']; ?>/perfil/<?php echo $user_comentario['username']; ?>" class="bold no-link"><?php echo $user_comentario['username']; ?></a> em <?php echo strftime('%d/%m/%Y', $comentario['data']); ?> as <?php echo strftime('%H:%M', $comentario['data']); ?></h6>
											</label>
											<div id="news-owner-comment-interactions"></div>
										</div>
									</div>
								<?php } } ?>
								<?php } ?>
								<?php } else if ($noticia['comentarios'] == 0) { ?>
									<div id="news-comment-disabled">
										<h5 class="margin-auto-top-bottom">Os comentários para esta noticia foram desativados!</h5>
									</div>
                                <?php }?>
								</div>
								<?php include('../../config/includes/footer.php'); ?>
							</div>
						</div>
						<div class="column-separator-right margin-bottom-md margin-auto-right">
							<div id="other-news-container">
								<div id="other-news-header" style="background-image: url('')">
									<div id="other-news-header-icon"></div>
									<div id="other-news-header-label">
										<h3 class="gray bold">Mais noticías</h3>
										<h6 class="gray bold">Leia outras noticías!</h6>
									</div>
								</div>
				<?php
					for ($i = 0; $i < 6; $i++) {
						$section_name = "";
						$section_time_max = 0;
						$section_time_min = 0;

						switch ($i) {
							case 0:
							$section_name = 'Hoje';
							$section_time_max = time();
							$section_time_min = time() - 86400;
							break;
							case 1:
							$section_name = 'Ontem';
							$section_time_max = time() - 86400;
							$section_time_min = time() - 172800;
							break;
							case 2:
							$section_name = 'Esta semana';
							$section_time_max = time() - 172800;
							$section_time_min = time() - 604800;
							break;
							case 3:
							$section_name = 'Semana anterior';
							$section_time_max = time() - 604800;
							$section_time_min = time() - 1209600;
							break;
							case 4:
							$section_name = 'Este mês';
							$section_time_max = time() - 1209600;
							$section_time_min = time() - 2592000;
							break;
							case 5:
							$section_name = 'Último mês';
							$section_time_max = time() - 2592000;
							$section_time_min = time() - 5184000;
							break;
							case 6:
							$section_name = 'Último mês';
							$section_time_max = time() - 5184000;
							$section_time_min = time() - 269298000;
							break;
						}

						$selecionar_noticias = $bdd->prepare("SELECT * FROM habbo_news WHERE time >= ? AND time <= ? ORDER BY time DESC LIMIT 5");
						$selecionar_noticias->bindValue(1, $section_time_min);
						$selecionar_noticias->bindValue(2, $section_time_max);
						$selecionar_noticias->execute();

						if ($selecionar_noticias->rowCount() > 0) {
								echo '<div class="flex" id="other-news-content-separator"><h5 class="margin-auto-top-bottom white">' . $section_name . '</h5>
									</div>
								';

							while ($result_others_articles = $selecionar_noticias->fetch(PDO::FETCH_ASSOC)) {
				?>
										<div id="other-news-content" style="background-image: url(<?= $result_others_articles['image_url']; ?>)">
											<a href="/article/<?= $result_others_articles['id']; ?>" class="no-link" id="other-news-box">
												<div id="other-news-content-icon" <?= ($result_others_articles['id'] == $_GET['article_id']) ? 'reading-news' : ''; ?>></div>
												<div id="other-news-content-label" class="white text-nowrap">
													<h5 class="bold text-nowrap"><?= $result_others_articles['title']; ?></h5>
													<h6 class="text-nowrap"><?= $result_others_articles['stext']; ?></h6>
												</div>
											</a>
										</div>
				<?php
							}
						}
					}
				?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php if ($noticia['formulario'] == '1') { ?>
			<?php 
				$id_post = $_GET['article_id'];
				$consulta_formularios = $bdd->query("SELECT * FROM hybbe_formularios WHERE id_post='" . $id_post . "' AND user_send='" . $user['id'] . "' ORDER BY data DESC");

				$consulta_formularios2 = $bdd->query("SELECT * FROM hybbe_formularios WHERE id_post='" . $id_post . "' AND user_send='" . $user['id'] . "' ORDER BY data DESC");
				//$c_f = $consulta_formularios2->fetch(PDO::FETCH_ASSOC);

				if ($consulta_formularios->rowCount() <= 0) {
					$limit_form = '2';
				} else if ($consulta_formularios->rowCount() == 1) {
					$limit_form = '1';
				} else if ($consulta_formularios->rowCount() >= 2) {
					$erro_form = true;
					$erro_message = 'Você alcançou o limite de envios de apenas <b class="underline">3</b> formulários por vez!';
				}

				if(isset($_POST['send_form'])) {

					if ($consulta_formularios2->rowCount() >= 2) {
						$erro_form = true;
						$form_active = 'active';
					} else {
						$id_post = $_GET['article_id'];
						$user_send = $user['id'];
						$participants = $_POST['form_participants'];
						$data = time();
						$link = $_POST['form_link'];
						$message = $_POST['form_message'];

						$send_form = $bdd->query("INSERT INTO hybbe_formularios (id_post, user_send, usernames, data, link, message) VALUES ('" . $id_post . "','" . $user_send . "' ,'" . $participants . "', '" . $data . "', '" . $link . "', '" . $message . "')");

						$sucess_form = true;
						$form_active = 'active';
					}
				}
			?>
			<div class="modal-container <?php echo $form_active; ?>">
				<div id="modal-content">
					<div id="news-modal">
						<div class="flex-column margin-bottom-min" id="news-modal-header">
							<div class="margin-right-min flex-wrap margin-bottom-md" id="news-modal-header-icon">
								<icon icon="ballon-big1"></icon>

								<label class="margin-left-min gray">
									<h4 class="bold">Formulário de noticias</h4>
									<h5>Envie seu formulário para <b><?php echo $fetchAuthor['username']; ?></b></h5>
								</label>
								<button class="reset-button flex margin-auto-left margin-auto-top-bottom close-modal">
									<icon icon="close"></icon>
								</button>
							</div>
							<div class="flex-column">
								<h4 class="bold gray margin-bottom-minm">Dados da Noticia</h4>
								<div class="flex-wrap" id="news-modal-header-news-info">
									<div id="news-modal-header-news-info-habbo-author">
										<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $autor['look']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std">
									</div>
										<?php 
											$author = $bdd->prepare("SELECT * FROM players WHERE id = ?");
											$author->bindValue(1, $noticia['autor']);
											$author->execute();
											$fetchAuthor = $author->fetch(PDO::FETCH_ASSOC);
										?>
									<label class="gray margin-auto-top-bottom">
										<h5 class="bold margin-bottom-minm"><?php echo $noticia['title']; ?></h5>
										<h6>Por <b><?php echo $fetchAuthor['username']; ?></b> em <?php echo strftime('%d de %B de %Y', $noticia['time']); ?> as <?php echo strftime('%H:%M', $noticia['time']); ?></h6>
									</label>
								</div>
							</div>
						</div>
							<hr>
						<form class="flex-column margin-top-min" method="POST">
							<div class="flex margin-bottom-minm">
								<icon icon="head-plus" style="top: 7px;left: 8px;margin-right: -17px;"></icon>
								<input type="text" name="form_participants" id="participants-modal-news" placeholder="Participantes" value="<?php echo $user['username']; ?>" required>
							</div>
							<div class="flex margin-bottom-minm">
								<icon icon="link" style="top: 8px;left: 8px;margin-right: -15px;"></icon>
								<input type="text" name="form_link" id="link-modal-news" placeholder="Link" required>
							</div>
							<div class="flex margin-bottom-minm">
								<icon icon="email" style="top: 8px;left: 7px;margin-right: -16px;"></icon>
								<textarea id="message-modal-news" name="form_message" placeholder="Mensagem" required></textarea>
							</div>
							<div class="margin-top-min">
								<button class="green-button-2" type="submit" name="send_form" style="width: 100%; height: 45px;">
									<label class="margin-auto white bold">Enviar formulário</label>
								</button>
							</div>
							<?php if ($sucess_form == true) { ?>
							<label class="general-sucess margin-top-min margin-auto-left-right">
								<h6 class="margin-auto-top-bottom bold">Formulário enviado com sucesso! Você só pode enviar mais <?php echo $limit_form; ?> formulários.</h6>
							</label>
							<?php } else if ($erro_form) { ?>
							<label class="general-error margin-top-min margin-auto-left-right">
								<h6 class="margin-auto-top-bottom bold"><?php echo $erro_message; ?></h6>
							</label>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		<?php } ?>
<?php include('../../config/includes/bottom.php'); ?>
