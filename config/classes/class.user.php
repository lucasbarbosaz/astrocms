<?php
	class User
	{
		public function __construct($bdd, $username, $password)
		{
			global $bdd;
			$req = $bdd->prepare('SELECT * FROM players WHERE username = :username AND password = :password');
			$req->execute(Array(':username' => $username, ':password' => $password));
			if($req->rowCount() == 1)
			{
				$data = $req->fetch();
				foreach($data as $k=>$v){
					$this->$k = safe($v,'HTML');
				}
			}
		}

		public function UpdateIP($userID)
		{
			global $bdd;
			$req = $bdd->prepare("UPDATE players SET ip_last = :ip WHERE id = :user_id");
			$req->execute(Array(":ip" => getenv("REMOTE_ADDR"), ":user_id" => $userID));
		}

		//public function Verifica($renamed, $gender_register)
		//{
		//	if($renamed == 0) {
		//	Redirect(URL."/client");
		//	}
 		//	if($gender_register == 0) {
		//	Redirect(URL."/client");
		//	}
		//	return true;
		//}
        
		public function Token() 
		{
			$token = bin2hex(mcrypt_create_iv(10, MCRYPT_DEV_RANDOM));
			return $token;
		}

		function Avatar($figure, $style, $action = ''){
			$style = explode(",", $style);
			if($style[0] == "s"){ $style[6] = "1"; }else{ $style[6] = "0"; }
			if($style[3] == "sml"){ $style[7] = "1"; }else{ $style[7] = "0"; }
		
			return Shybbe('avatarimage')."avatarimage?figure=".$figure."&size=".$style[0]."&direction=".$style[1]."&head_direction=".$style[2]."&crr=".$style[5]."&action=".$action."&gesture=".$style[3]."&frame=".$style[4]."&headonly=".$style[5];
		}
}
?>