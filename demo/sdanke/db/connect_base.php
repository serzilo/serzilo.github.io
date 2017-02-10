<?
$db_file_ini = realpath(dirname(__FILE__) . DIRSEP ) . DIRSEP. 'data.ini';
$db_ini=parse_ini_file($db_file_ini);

try{$db = new data_base($db_ini['host'],$db_ini['db_name'], $db_ini['login'], $db_ini['pass']);} 
catch (Exception $e){echo 'Connection failed: '.$e->getMessage().'<br> '.$db_ini['db_name'].' -> '.$db_ini['login'];}

$db->query("SET NAMES 'cp1251'");


?>