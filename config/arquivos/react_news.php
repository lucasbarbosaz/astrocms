<?php
	require_once '../../geral.php';

	$userss = $db->query("SELECT * FROM players WHERE username='" . $_SESSION['username'] . "' AND password='" . $_SESSION['password'] . "'");
	$useris = $users->fetch(PDO::FETCH_ASSOC);

	if($_POST) {
		$id = $_POST['id'];

		$consulta = $bdd->query("SELECT * FROM hybbe_like_noticias WHERE id_noticia='" . $id . "' AND user_id='" . $useris['id'] . "'");
		$likes = $consulta->fetch(PDO::FETCH_ASSOC);

		if ($user->rowCount() > 0) {
			if ($likes->rowCount() >= 0) {
				$json["response"] = 'new';
				echo json_encode($json);

				$bdd->query("INSERT INTO hybbe_like_noticias (id_noticia, user_id) VALUES ('" . $id . "', '" . $useris['id'] . "')");
			}
		}

	}
?>