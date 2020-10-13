<?php
if (!defined('CORE'))
    die('Error core acces');
define('PATH', str_replace("config", "", dirname(__FILE__)));

$injection = 'INSERT|UNION|SELECT|NULL|COUNT|FROM|LIKE|DROP|TABLE|WHERE|COUNT|COLUMN|TABLES|INFORMATION_SCHEMA|OR';
foreach ($_GET as $getSearchs) {
    $getSearch = explode(" ", $getSearchs);
    foreach ($getSearch as $k => $v) {
        if (in_array(strtoupper(trim($v)), explode('|', $injection))) {
            exit;
        }
    }
}
if (!headers_sent())
    header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset', 'utf-8');
if (function_exists('date_default_timezone_set')) {
    @date_default_timezone_set('Europe/Portugal');
}
if (!defined('_MYSQL_REAL_ESCAPE_STRING_'))
    define('_MYSQL_REAL_ESCAPE_STRING_', function_exists('mysql_real_escape_string'));


define('URL', hybbe('site'));
define('UPDATE', mt_rand(500, 999));
define('GENERATE_KEY', md5(microtime() . rand()));

require_once PATH . 'config/classes/class.db.php';
require_once PATH . 'config/classes/class.config.php';
require_once PATH . 'config/classes/class.auth.php';
require_once PATH . 'config/classes/class.user.php';
require_once PATH . 'config/classes/class.filter.php';
require_once PATH . 'config/arquivos/sessao.php';
$Db = new Db($bdd);
$Config = new Config();
$Auth = new Auth();
//$Function = new Functions();
if (isset($_SESSION)) {
    $user = new User($bdd, $_SESSION['username'], $_SESSION['password']);
}


if (!isset($_SERVER['REQUEST_URI']) OR empty($_SERVER['REQUEST_URI'])) {
    if (substr($_SERVER['SCRIPT_NAME'], -9) == 'index.php' && empty($_SERVER['QUERY_STRING']))
        $_SERVER['REQUEST_URI'] = dirname($_SERVER['SCRIPT_NAME']) . '/';
    else {
        $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
        if (isset($_SERVER['QUERY_STRING']) AND !empty($_SERVER['QUERY_STRING']))
            $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
    }
}
if (!isset($_SERVER['HTTP_HOST']) OR empty($_SERVER['HTTP_HOST']))
    $_SERVER['HTTP_HOST'] = @getenv('HTTP_HOST');
?>
