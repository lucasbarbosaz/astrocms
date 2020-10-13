<?php
	require_once("../../init.php");
	
	$online = $bdd->query("SELECT * FROM users WHERE online = '1' ORDER BY username");
	$conteur = $online->rowCount();
	
	$contenu = array();
	
	
	while($u = $online->fetch(PDO::FETCH_OBJ)) {
		$contenu[] = "
			<table style='width: 100%;'>
				<tr>
					<td>
						<div class='avatar'>
							<div class='look' style='background-image: url(http://avatar-retro.com/habbo-imaging/avatarimage?figure=".$u->look."&action=null&direction=2&head_direction=3&gesture=sml&size=big&img_format=gif);'></div>
						</div>
						<div class='infos'>
							<div class='nom'>".$u->username."</div>
							<div class='date'>Dernière connexion : le ".date("d-m-Y à H:m", $u->last_online)."</div>
							<div class='mission'>Misson : ".$u->motto."</div>
						</div>
					</td>
				</tr>
			</table>
		";
	}
	
	echo json_encode(array("conteur" => $conteur, "contenu" => $contenu));
?>