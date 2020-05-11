<?php
try { 
		$bdd = new MyPDO(HOST, DATABASE, USERNAME, PASSWORD); 
		$Mysql = new Mysql(HOST, DATABASE, USERNAME, PASSWORD);
		}catch(PDOException $e) {}
?>
