<?php
	class Auth
	{
		public function Login($username, $password, $admin = 'false', $banSQL) 
		{
			global $bdd;                
			$username = safe($_POST['username'],'SQL');
			$password = md5($_POST['password']); 

			$verif_user = $bdd->prepare("SELECT id,username FROM players WHERE (username = ? OR email = ?) AND password = ? LIMIT 1");
			$verif_user->bindValue(1, $username);
			$verif_user->bindValue(2, $username);
			$verif_user->bindValue(3, $password);
			$verif_user->execute();
			$assoc_user = $verif_user->fetch(PDO::FETCH_ASSOC);

			if($verif_user->rowCount() < 1){
				throw new Exception('Nome ou senha errados');
			} else {
				if($assoc_user['desativada'] == 1) {
				throw new Exception('Sua conta foi desativada. Em caso de erro contate um membro da equipe');
			} else {
				$sql_b = $bdd->query("SELECT * FROM bans WHERE data= '".safe($username,'SQL')."'");
				$b = $sql_b->fetch(PDO::FETCH_ASSOC);
				$r = $sql_b->rowCount();

			@$stamp_now = mktime(date('H:i:s d-m-Y'));
			$stamp_expire = $b['expire'];
			$expire = date('d/m/Y H:i:s', $b['expire']);

			if(@$stamp_now < @$stamp_expire){
				throw new Exception('Sua conta foi banida por '.$b['added_by'].' pelo seguinte motivo: '.$b['reason'].'. Este expirará em '.date_fr("d M. Y H:i:s", $b['expire']).'.');
			} else {
			if($r > 0){
				$query = $bdd->prepare("DELETE FROM bans WHERE data = ?");
				$query->bindValue(1, safe($username,'SQL'));
				$query->execute();
			}
				
			if($verif_user->rowCount() == 1){
				$laxus = $bdd->prepare("UPDATE players SET last_online = ? WHERE username = ?");
				$laxus->bindValue(1, time());
				$laxus->bindValue(2, safe($username, 'SQL'));
				$laxus->execute();
				$_SESSION['username'] = $assoc_user['username'];
				$_SESSION['password'] = $password;
			if($admin == 'false') {
				Redirect(URL."/principal");
			}
			if($admin == 'true') {
				Redirect(URL."/admin/");
			}
			}
			}
			}
			}
			return true;
		}

		public function BanIP($table, $ip, $pageid)
		{
			global $bdd;

			$verif_ban = $bdd->prepare("SELECT * FROM bans WHERE (user_id = ? OR ip = ? OR machine_id = ?) ORDERS BY timestamp DESC");
			$verif_ban->bindValue(1, $assoc_user['id']);
			$verif_ban->bindValue(2, $assoc_user['ip_current']);
			$verif_ban->bindValue(3, $assoc_user['machine_id']);
			$verif_ban->execute();
			$assoc_user = $verif_ban->fetch(PDO::FETCH_ASSOC);
		}
        
		public function IP() 
		{
			$ip = getenv("REMOTE_ADDR");
			return $ip;
		}

		public function Session_Connected($session) 
		{
			if(isset($session['username']))
			{
			Redirect(URL."/principal");
			}
		}

		public function Session_Disconnected($session) 
		{
			if(!isset($session['username']))
			{
			Redirect(URL);
			}
		}

		public function Logout() 
		{
			session_destroy();
		}
}
?>
