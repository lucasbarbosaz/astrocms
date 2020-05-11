<?php
class MyPdo extends PDO {
	static public $HOST = HOST;
	static public $DATABASE = DATABASE;
	static public $USERNAME = USERNAME;
	static public $PASSWORD = PASSWORD;
	function __construct() {
	$PDO_OPTIONS[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
	$DB = parent::__construct('mysql:host=' . MyPdo::$HOST . ';dbname=' . MyPdo::$DATABASE, MyPdo::$USERNAME, MyPdo::$PASSWORD, $PDO_OPTIONS);
	}
}
?>