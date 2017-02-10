<?
	$id=$_COOKIE['id'];
	$id_pass=$_COOKIE['id_pass'];
	$state= false;
	
	require_once("db/connect.php");
	if(!get_magic_quotes_gpc())
	{	
	//$post_pass = realstr($post_pass);
	$id = realstr($id);
	}	
	
	$result = mysql_query("SELECT * FROM USERS WHERE USER_ID= '$id';");
	require_once("db/check_sel.php");
	
	$rows = mysql_num_rows($result);
	if($rows === 1)
	{	
		$res = mysql_fetch_row($result);
		$pass = $res[2];
		if($id_pass == md5($pass))
		{	
			$state = true;
		}
	}
	unset($rows);
	unset($pass);
?>