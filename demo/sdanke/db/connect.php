<?
$db_file_ini = realpath(dirname(__FILE__) . DIRSEP ) . DIRSEP. 'data.ini';
$db_ini=parse_ini_file($db_file_ini);

if($db = @mysql_connect($db_ini['host'], $db_ini['login'], $db_ini['pass']))
{
	if(! @mysql_select_db($db_ini['db_name'], $db))
	{
	$err = mysql_errno();
	echo 'Selection failed * |'.$db_ini['db_name'].'| error: $err';
	exit;
	}
	
	@mysql_query("SET NAMES 'cp1251'");
	
}
else
{
	$err = mysql_error();
	echo 'Connection fail '. $db_ini['host'].' : '. $db_ini['login'].' - $err ';
	exit;
}

?>