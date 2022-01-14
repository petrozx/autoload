<?
define('DB_HOST', 'mysql.petroz.myjino.ru');
define('DB_USER', 'petroz');
define('DB_PASS', '198719pv');
define('DB_NAME', 'petroz');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CLASS_COMPONENT', 'class.php');
define('TEMPLATE', 'template.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/DB/DB.php');
global $content;
global $css;
global $js;
global $jsx;
global $arResult;