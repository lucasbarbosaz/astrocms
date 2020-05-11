<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8",true); 
	setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
	date_default_timezone_set( 'America/Sao_Paulo' );
	require_once ("../../geral.php");

	if($_GET['id'] != "") {
		$news_id = $_GET['id'];
	} else {
		$sql = $bdd->query("SELECT * FROM habbo_news WHERE id != '-344' ORDER BY id DESC LIMIT 1");
		$swazzy = $sql->fetch(PDO::FETCH_ASSOC);
		$locations = $swazzy['id'];
		header("Location: $path/noticia/$locations");
	}

    $useradmin_s = $bdd->query("SELECT * FROM players WHERE username = '" . $_SESSION['username'] . "'");
    $useradmin = $useradmin_s->fetch(PDO::FETCH_ASSOC);

    $figure_s = $bdd->query("SELECT * FROM players WHERE figure = '". $_POST['figure'] . "'");
    $figure = $figure_s->fetch(PDO::FETCH_ASSOC);

	$sql2 = $bdd->query("SELECT * FROM habbo_news WHERE id != '-344' ORDER BY id DESC");
	$sql232 = $bdd->query("SELECT * FROM habbo_news WHERE id != '-344' ORDER BY id DESC");

	$noticias = $bdd->query("SELECT * FROM habbo_news WHERE id='".$_GET['id']."'");
	$noticia = $noticias->fetch(PDO::FETCH_ASSOC);

	$figure_autor = $bdd->query("SELECT * FROM players WHERE username='" . $noticia['autor'] . "'");
	$autor = $figure_autor->fetch(PDO::FETCH_ASSOC);

	$palavrasbloqueadas=file_get_contents('/PalavrasBloqueadas.txt');

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
					<div id="content">
						<div class="column-separator-left">
							<div id="news-container">
								<div id="news-content">
									<div id="news-header">
										<div id="news-thumbnail" style="background-image: url('<?php echo $noticia['image_url']; ?>')">
											<div id="news-habbo-author">
												<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $autor['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std">
											</div>
											<div id="news-habbo-author-info">
												<div class="no-select" id="news-habbo-author-info-label">Publicada por <b><?php echo $noticia['autor']; ?></b><br>em <?php echo $noticia['data']; ?> na categoria <b><?php echo $noticia['category']; ?></b></div>
											</div>
										</div>
										<div class="gray" id="news-label">
										<?php if ($noticia['stext'] != '') { ?>
											<h3 class="bold"><?php echo $noticia['title']; ?></h3>
											<h5><?php echo $noticia['stext']; ?></h5>
										<?php } else { ?>
											<h3 class="bold margin-auto-top-bottom"><?php echo $noticia['title']; ?></h3>
										<?php } ?>
										</div>
									</div>
										<hr/>
									<div id="news-body"><?php echo $noticia['btext']?></div>
										<hr/>
									<div id="news-footer">
									<?php if ($noticia['formulario'] == 1) { ?>
										<button class="reset-button" id="news-open-form">Formulário</button>
									<?php } else if ($noticia['formulario'] == 2) { ?>
										<button class="reset-button" id="news-open-form" unavailable>
											<h5 class="white">Formulário indisponível</h5>
										</button>
									<?php } ?>
									<?php if ($noticia['badges'] != '' || $noticia['badges'] != null) { ?>
										<div id="news-badges-area">
											<img src="<?php echo $hotel['site']; ?>"/>
										</div>
									<?php } ?>
										<div id="news-interaction-area">
											<button class="reset-button" id="news-interaction-like"><h6 class="white">Gostei</h6></button>
											<button class="reset-button" id="news-interaction-deslike"><h6 class="white">Não gostei</h6></button>
										</div>
									</div>
								</div>
								<div id="news-comments-container">
								<?php if($noticia['comentarios'] == 1) { ?>
									<div id="news-new-comment">
										<div id="news-new-comment-habbo">
											<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $useradmin['figure'];?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std"/>
										</div>
                                        <form action="" method="POST" enctype="multipart/form-data">
											<div id="news-new-comment-area">
												<textarea name="comentario" id="news-new-comment-text-area" placeholder="Digite algo para comentar..."></textarea>
											</div>
											<button class="reset-button" id="news-comment-button">Comentar</button>
                                        	<input type="hidden" name="comentar" value="comment">
                                        </form>
									</div>
								<?php

									$idPost = $_GET['id'];
									
									if (isset($_POST['comentar']) && $_POST['comentar'] == "comment") {
										$comentario = $_POST['comentario'];
										$autor = $_SESSION['username'];
										$figure = $useradmin['figure'];

										date_default_timezone_set('America/Sao_paulo');
										$data = date("d/m/Y");
										$hora = date("H:i");

										$comentar = $bdd->query("INSERT INTO hybbe_comentarios (id_post, comentario, autor, figure, data, hora) VALUES('$idPost', '$comentario', '$autor', '$figure', '$data', '$hora')");
									}

									$seleciona = $bdd->query("SELECT * FROM hybbe_comentarios WHERE id_post = '$idPost'");
									$conta = $seleciona->rowCount();

									while($row = $seleciona->fetch(PDO::FETCH_ASSOC)){
										$comentario = $row['comentario'];
										$data = $row['data'];
										$hora = $row['hora'];
										$autor = $row['autor'];
										$figure = $row['figure'];
                                	?>
									<div id="news-users-comments">
										<div id="news-user-comment">
											<div id="news-user-comment-habbo">
												<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $figure;?>&headonly=0&size=s&gesture=std&direction=2&head_direction=3&action=std" style="position: relative;width: 32;height: 55px;margin: 0 auto;"/>
											</div>
											<div class="margin-auto-top-bottom" id="news-comment-area">
												<div id="news-comment-user"><?php echo $comentario;?></div>
												<div id="news-comment-author">Por: <b><?php echo $autor;?></b> em <?php echo $data;?> as <?php echo $hora;?></div>
											</div>
											<div id="news-owner-comment-interactions"></div>
										</div>
									</div>
									<?php } ?>
									<?php } else if ($noticia['comments_enabled'] == 0) { ?>
									<div id="news-comment-disabled">
										<h5 class="margin-auto-top-bottom">Os comentários para está notícias foram desativados!</h5>
									</div>
                                <?php }?>
								</div>
								<?php include('../../config/includes/footer.php'); ?>
							</div>
						</div>
						<div class="column-separator-right">
							<div id="other-news-container">
								<div id="other-news-header" style="background-image: url('')">
									<div id="other-news-header-icon"></div>
									<div id="other-news-header-label">
										<h3 class="gray bold">Mais noticías</h3>
										<h6 class="gray bold">Leia outras noticías!</h6>
									</div>
								</div>
								<?php
									$consultar_noticia55 = $bdd->query("SELECT * FROM habbo_news WHERE ")
									if ()
								?>
								<div class="flex" id="other-news-content-separator">
									<h5 class="margin-auto-top-bottom white">Xereca</h5>
								</div>
								<?php 
									while($row32 = $sql2->fetch(PDO::FETCH_ASSOC)){
								?>
								<div id="other-news-content">
									<a href="<?php echo $hotel['site']; ?>/noticia/<?php echo $row32['id'];?>" class="no-link" id="other-news-box">
										<div id="other-news-content-icon"></div>
										<div id="other-news-content-label" class="white">
											<h5 class="bold" id="other-news-content-label-title"><?php echo $row32['title'];?></h5>
											<h6 id="other-news-content-label-subtitle"><?php echo $row32['stext'];?></h6>
										</div>
									</a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="modal-container">
				<div id="modal-content">
					<div id="news-modal">
						<div class="flex-column margin-bottom-min" id="news-modal-header">
							<div class="margin-right-min flex-wrap margin-bottom-md" id="news-modal-header-icon">
								<icon icon="ballon-big1"></icon>
								<label class="margin-left-min gray">
									<h4 class="bold">Formulário de noticias</h4>
									<h5>Envie seu formulário para <b><?php echo $noticia['autor']; ?></b></h5>
								</label>
								<button class="reset-button flex margin-auto-left margin-auto-top-bottom">
									<icon icon="close"></icon>
								</button>
							</div>
							<div class="flex-column">
								<h4 class="bold gray margin-bottom-minm">Dados da Noticia</h4>
								<div class="flex-wrap" id="news-modal-header-news-info">
									<div id="news-modal-header-news-info-habbo-author">
										<img src="<?php echo $hotel['avatarimage']; ?>figure=<?php echo $autor['figure']; ?>&headonly=0&size=n&gesture=std&direction=2&head_direction=3&action=std">
									</div>
									<label class="gray margin-auto-top-bottom">
										<h5 class="bold margin-bottom-minm"><?php echo $noticia['title']; ?></h5>
										<h6>Notícia postada por: <?php echo $noticia['autor']; ?> em <?php echo $noticia['data']; ?></h6>
									</label>
								</div>
							</div>
						</div>
							<hr>
						<form class="flex-column margin-top-min" method="POST">
							<div class="flex margin-bottom-minm">
								<icon icon="head-plus" style="top: 7px;left: 8px;margin-right: -17px;"></icon>
								<input type="text" name="participants" id="participants-modal-news" placeholder="Participantes" value="<?php echo $user['username']; ?>" required>
							</div>
							<div class="flex margin-bottom-minm">
								<icon icon="link" style="top: 8px;left: 8px;margin-right: -15px;"></icon>
								<input type="text" name="link" id="link-modal-news" placeholder="Link" required>
							</div>
							<div class="flex margin-bottom-minm">
								<icon icon="email" style="top: 8px;left: 7px;margin-right: -16px;"></icon>
								<textarea id="message-modal-news" placeholder="Mensagem" required></textarea>
							</div>
							<div class="margin-top-min">
								<button class="green-button-2" type="submit" style="width: 100%; height: 45px;">
									<label class="margin-auto white bold">Enviar formulário</label>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
<?php include('../../config/includes/bottom.php'); ?>