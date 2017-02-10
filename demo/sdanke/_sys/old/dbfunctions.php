<?
function dbconnect() 
{ 
$dbfile="db/data.txt";
$pass_list=File($dbfile);
	
	list($dbname, $dbuser, $dbpass)=$pass_list;
	
	if($db=@mysql_connect('localhost',$dbuser,$dbpass))
	{
		if(! @mysql_select_db($dbname, $db));
		{
			return false;
		}
		@mysql_query("SET NAMES 'cp1251'");
		return true;
	}
	else
	{
		return false;
	}
}


function realstr($str)
{
	return mysql_escape_string($str);
}
?>