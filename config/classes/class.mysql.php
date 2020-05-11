<?php
  class Mysql
  {
  static public $HOST = HOST;
  static public $DATABASE = DATABASE;
  static public $USERNAME = USERNAME;
  static public $PASSWORD = PASSWORD;
    public function __construct()
    {
      $MySQL = mysql_connect(Mysql::$HOST, Mysql::$USERNAME, Mysql::$PASSWORD);
      mysql_select_db(Mysql::$DATABASE, $MySQL);
    }
}
?>