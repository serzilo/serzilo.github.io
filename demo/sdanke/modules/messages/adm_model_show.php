<?php
$dir=dirname(__FILE__).DIRSEP;
include($dir.'include.php');

	$num=$registry->adm_class->find_num();

	//deleting the record from the base
	$query = 'SELECT * FROM '.$struc['table'].' WHERE TRUE LIMIT 1 ';
	
	$row = $registry->db->query($query);
	
	if($row === false)
		$registry->adm_class->goto_error('error', $query.' -> '.mysql_error());
	
	$data = $registry->db->get_assoc();
	if(isset($data[$struc['sql_prefix'].'_SHOW']))
		$query = 'UPDATE '.$struc['table'].' SET '.$struc['sql_prefix'].
		'_SHOW = NOT '.$struc['sql_prefix'].'_SHOW 
		WHERE '.$struc['sql_prefix'].'_ID = '.$num;
	elseif(isset($data[$struc['sql_prefix'].'_ACTIVE']))
		$query = 'UPDATE '.$struc['table'].' SET '.$struc['sql_prefix'].
		'_ACTIVE = NOT '.$struc['sql_prefix'].'_ACTIVE  WHERE '.$struc['sql_prefix'].'_ID = '.$num;
	elseif(isset($data[$struc['sql_prefix'].'_READ']))
		$query = 'UPDATE '.$struc['table'].' SET '.$struc['sql_prefix'].
		'_READ = NOT '.$struc['sql_prefix'].'_READ  WHERE '.$struc['sql_prefix'].'_ID = '.$num;
	else
		$registry->adm_class->goto_mess('ошибка', ' Некорректные данные');
	
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