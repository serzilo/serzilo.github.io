<?
$db_file_ini = realpath(dirname(__FILE__) . DIRSEP ) . DIRSEP. 'data.ini';
$db_ini=parse_ini_file($db_file_ini);

try{$db = new PDO('mysql:host='.$db_ini['host'].';dbname='.$db_ini['db_name'], $db_ini['login'], $db_ini['pass']);} 
catch (PDOException $e){echo 'Connection failed: '.$e->getMessage().'<br> '.$db_ini['db_name'].' -> '.$db_ini['login'];}

$db->query("SET NAMES 'cp1251'");

?>