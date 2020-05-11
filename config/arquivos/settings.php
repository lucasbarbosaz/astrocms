<?php 
	if (isset($_POST['motto'])) {
		if (strlen($motto) > 100 || strlen($motto) < 1) {
			$message['motto'] = 'Tente colocar outra missão!';
			$error == true;
		}

		if($error == false) {
			$bdd->query("UPDATE players SET motto = '" . $_POST['motto'] . "' LIMIT");
		}
		Redirect(URL."/configuracoes?salvo");
	}
?>