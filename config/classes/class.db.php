<?php
	class Db
	{
		public function InsertSQL($table, $inserts) 
		{
			global $bdd;
    		$values = array_map('mysql_real_escape_string', array_values($inserts));
    		$keys = array_keys($inserts);
    		return $bdd->query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
		}
}
?>