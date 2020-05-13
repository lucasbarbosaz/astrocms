<?php 
	if (isset($_POST['motto'])) {
		if (strlen($motto) > 100 || strlen($motto) < 1) {
			$message['motto'] = 'Tente colocar outra missão!';
			$error == true;
		}

		if($error == false) {
			$send = $bdd-prepare("UPDATE players SET motto = ? LIMIT 1 ");
			$send->bindValue(1, $_POST['motto']);
			$send->execute();#
		}
		Redirect(URL."/configuracoes?salvo");
	}
?>
