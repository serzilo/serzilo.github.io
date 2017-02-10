<?
$dbfile="db/data.txt";
$pass_list=File($dbfile);

global $db;
	
	list($dbadr, $dbname, $dbuser, $dbpass)=$pass_list;
	$dbadr  = trim($dbadr);
	$dbname = trim($dbname);
	$dbuser = trim($dbuser);
	$dbpass = trim($dbpass);
	
	if($db = @mysql_connect($dbadr, $dbuser, $dbpass))
	{
		global $db;

		if(! @mysql_select_db($dbname, $db))
		{
		$err = mysql_errno();
		echo "DB Selection failed * |$dbname| error: $err";
		exit;
		}
		
		@mysql_query("SET NAMES 'cp1251'");
		
	}
	else
	{
		$err = mysql_error();
		echo "Connection fail $dbuser - $dbpass - $err ";
		exit;
	}
?>