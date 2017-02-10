<?php
$dir=dirname(__FILE__).DIRSEP;
include($dir.'include.php');

	//deleting the record from the base
	$query = 'DELETE FROM '.$struc['table'].' WHERE T_ID = '.$args[1];
	
	$row = $registry->db->exec($query);
	
	if($row != false)
	{
		if(isset($_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		else
			header('Location: '.site_host.$mods['name']);
		exit;
	}
	$registry->adm_class->goto_error('error', $query.' -> '.mysql_error());
?>