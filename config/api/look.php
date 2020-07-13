<?php 
	require_once('../../geral.php');

	header('Content-Type: application/json');

	if (extract($_POST)) {
		$username = (isset($_POST['username'])) ? $_POST['username'] : '';

		$consult_look = $bdd->prepare("SELECT look FROM users WHERE username = ?");
		$consult_look->bindValue(1, $username);
		$consult_look->execute();

		$look = $consult_look->fetch(PDO::FETCH_ASSOC);

		if ($consult_look->rowCount() > 0) {
			echo json_encode([
				"look" => AVATARIMAGE . 'figure=' . $look['look'] . '&head_direction=3&size=n&gesture=sml'
			]);
		} else {
			echo json_encode([
				"look" => CDN . '/assets/img/ghost.png'
			]);
		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
	}
?>
