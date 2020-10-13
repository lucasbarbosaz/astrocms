<?php
	require_once("../../init.php");
	
	if(isset($_POST['pseudonyme'])) {
		if(empty($_POST['pseudonyme'])) {
			$message = "Veuillez remplir les champs vides." and $couleur = "rouge";
		} else {
			if(strlen($_POST['pseudonyme']) < 4) {
				$message = "Votre nouveau pseudonyme doit faire plus de 4 caractères." and $couleur = "rouge";
			} else {
				if(preg_replace("/[^a-z\d\-=\?!@:\.]/i", "", $_POST['pseudonyme']) !== $_POST['pseudonyme']) {
					$message = "Veuillez saisir un pseudonyme valide." and $couleur = "rouge";
				} else {		
					$pseudonyme = $bdd->prepare("SELECT username FROM users WHERE username = :username");
					$pseudonyme->bindParam(":username", $_POST['pseudonyme']);
					$pseudonyme->execute();
					if($pseudonyme->rowCount() > 0) {
						$p = $pseudonyme->fetch(PDO::FETCH_OBJ);
						$message = "Le pseudonyme '".$p->username."' est déjà utilisé" and $couleur = "rouge";
					} else {
						$flagme = $bdd->prepare("UPDATE users SET username = :username WHERE username = '".$_SESSION['username']."'");
						$flagme->bindParam(":username", $_POST['pseudonyme']);
						$flagme->execute();
						$message = "Votre nouveau pseudonyme est '".$_POST['pseudonyme']."'." and $couleur = "vert";
						$_SESSION['username'] = $_POST['pseudonyme'];
					}
				}
			}
		}
	}
	echo json_encode(array('message' => $message, 'couleur' => $couleur));
?>