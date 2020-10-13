<?php
	if(isset($_POST['dedicace'])) {
		if(empty($_POST['dedidace'])) {
			$message = "Veuillez remplir les champs vides." and $couleur = "rouge";
		} else {
			$dedidace = $bdd->query("SELECT time FROM dedidace WHERE username = '".$_SESSION['username']."' ORDER BY id DESC LIMIT 1");
			
		}
	}

?>