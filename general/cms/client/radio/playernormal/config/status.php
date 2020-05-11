<?php
ini_set('max_input_vars', 99000);
ini_set('post_max_size', "50MB");
header('Access-Control-Allow-Origin: *');
flush(true);

function RadioGalaxyServers($ip,$port){

	$shoutcast = simplexml_load_file('http://'.$ip.':'.$port.'/stats?sid=1');
	if(@$shoutcast){
			// Speaker
		$speaker = $shoutcast->SERVERTITLE;
			// Program
		$program = $shoutcast->SERVERGENRE;
			// Listeners
		$listeners = $shoutcast->CURRENTLISTENERS;
			// Music
		$music = $shoutcast->SONGTITLE;
	} else if(@!$shoutcast) {
		$ch = curl_init('http://'.$ip.':'.$port.'/index.html');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
		$default = curl_exec($ch);
		$online = null;
		$server = strpos($default, 'Server is currently up and public.');
		if($server){
				$online = 1; // Yes
			} else {
				$online = 0; // No
			}
			// Init
			if($online == 1){
				// Speaker
				$speaker = explode('Stream Title: </font></td><td><font class=default><b>', $default);
				$speaker = explode('</b>', $speaker[1]);
				$speaker = $speaker[0];
				// Program
				$program = explode('Stream Genre: </font></td><td><font class=default><b>', $default);
				$program = explode('</b>', $program[1]);
				$program = $program[0];
				// Listeners
				$listeners = explode('listeners (', $default);
				$listeners = explode(' unique)', $listeners[1]);
				$listeners = $listeners[0];
				// Music
				$music = explode('Current Song: </font></td><td><font class=default><b>', $default);
				$music = explode('</b>', $music[1]);
				$music = $music[0];
			} else {
				$speaker = 'Offline';
				$program = 'Offline';
				$listeners = '?';
				$music = 'Offline';
			}
		} else {
			echo 'Error';
		}
		$get = (int) isset($_GET['get']) ? strip_tags($_GET['get']) : '';
		if($get == '1'){

			if ($speaker == "RadioSpace"){
				$data = array(
					'locutor' => utf8_encode($speaker),
					'programa' => utf8_encode($program),
					'ouvintes' => utf8_encode($listeners),
				'musica' => utf8_encode("AutoDJ Space.") /// Mostra programação
		////	'musica' => utf8_encode($music) /// Mostra musica
			);
			} else {
				$data = array(
					'locutor' => utf8_encode($speaker),
					'programa' => utf8_encode($program),
					'ouvintes' => utf8_encode($listeners),
				'musica' => utf8_encode($program) /// Mostra programação
		////	'musica' => utf8_encode($music) /// Mostra musica
			);
			}
			echo json_encode($data);
		} else if($get == '2'){
			$type = isset($_GET['type']) ? strip_tags($_GET['type']) : '';
			if($type == 'speaker'){
				echo $speaker;
			} else if($type == 'program'){
				echo $program;
			} else if($type == 'listeners'){
				echo $listeners;
			} else if($type == 'music'){
				echo $music;
			}
		}
	} 

	include('../../config.php');
	RadioGalaxyServers($ipp,$portphb);

	?>