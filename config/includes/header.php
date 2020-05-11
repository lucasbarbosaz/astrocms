
		<header>
			<div id="header">
				<div class="webcenter" header>
					<div id="header-logo"></div>
					<div class="margin-auto-top-bottom" id="header-interactions">
						<div id="header-onlines"><?php Onlines(); ?> hybbe's online</div>
						<a href="<?php echo $hotel['site']; ?>/client/jogar" class="green-button-2 no-link" style="width: 166px;height: 42px;left: -1px;font-size: 13px;box-shadow: -4px 0 0 rgba(0, 0, 0, 0.15);">
							<label class="margin-auto white">Entrar no Hotel</label>
						</a>
					</div>
				</div>
			</div>
			<div id="header-menu">
				<div class="webcenter space-between">
					<nav id="header-menu-area">
						<ul class="margin-auto-right" id="header-menu-left">
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/principal" id="header-menu-button" <?php if ($page == 'principal') { ?>visited <?php } ?>>Principal</a>
							</li>
							<?php 
								$menunewsid = $bdd->query("SELECT * FROM habbo_news ORDER BY id DESC LIMIT 1");

								if ($menunewsid->rowCount() > 0) {
									while ($rownews = $menunewsid->fetch(PDO::FETCH_ASSOC)) {
							?>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/noticia/<?php echo $rownews['id']; ?>" id="header-menu-button" <?php if ($page == 'noticias') { ?>visited <?php } ?>>Notícias</a>
							</li>
							<?php } } ?>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/comunidade" id="header-menu-button" <?php if ($page == 'comunidade') { ?>visited <?php } ?>>Comunidade</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/loja" id="header-menu-button" <?php if ($page == 'loja') { ?>visited <?php } ?>>Loja</a>
							</li>
						</ul>
						<ul class="margin-auto-right" id="header-menu-right">
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/perfil/<?php echo $user['username']; ?>" id="header-menu-button" <?php if ($user['username'] == $perfil['username']) { ?>visited <?php } ?>>Minha página</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/configuracoes" id="header-menu-button" <?php if ($page == 'configuracoes') { ?>visited <?php } ?>>Configurações</a>
							</li>
							<li id="header-menu-item">
								<a href="<?php echo $hotel['site']; ?>/sair" id="header-menu-button">Sair</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>