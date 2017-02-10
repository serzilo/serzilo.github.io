<?
if(!empty($_POST) && isset($_POST['add_item']))
{
	$com = $registry->common;
	if(isset($com[$mods['name']]) && is_array($com[$mods['name']]))
		$sets = $com[$mods['name']];
	else
	{
		file_put_contents('add_'.$mods['name'].'_log.txt', date('Y-n-j').' '.$registry->adm_class->get_ref().
		' -> wrong post array, no submition item found
', FILE_APPEND);
				
		header('Location: '.site_host.$mods['name'].'/addd');
		exit;
	}
	
	$vals = '';
	$keys = '';
	
	//print_r($_POST);
	
	if(isset($sets['add']) && $sets['add'])
	{
		foreach($sets['add'] as $val)
		{
			//echo $val.' - ';
			if(isset($_POST[$struc['sql_prefix'].'_'.$val]))
			{
				//echo $val.' | ';
				$vals .= ' , \''.str_replace("'", '`', $_POST[$struc['sql_prefix'].'_'.$val]).'\'';
				$keys .= ' , '.$struc['sql_prefix'].'_'.$val;
			}
		}
	}else
	{
		print_r($sets);
	}
	
	if(!empty($vals))
	{
		
		$query = 'INSERT INTO '.$struc['table'].' ('.$struc['sql_prefix'].'_ID '.$keys.', COM_DATE_CREATE)
		VALUES(null'.$vals.', NOW())';
		$row = $registry->db->exec($query);
		
		//echo $query;
		
		if($row === false)
		{
			$_SESSION['mess_text']='Произошла ошибка при добавлении элемента в разделе '.$mods['name_alt'];
			$tmp= mysql_error();
					
			file_put_contents('add_'.$mods['name'].'_log.txt', date('Y-n-j').' '.$query.' -> '.$tmp.'
', FILE_APPEND);
					
			header('Location: '.site_host.'mess');
			exit;
		}
	}else
	{
		$_SESSION['mess_text']='Произошла ошибка при добавлении элемента в разделе '.$mods['name_alt'].' нет данных';
		file_put_contents('add_'.$mods['name'].'_log.txt', date('Y-n-j').
		' wrong post array, no needed items found -> '.file_get_contents('php://input').'
', FILE_APPEND);
		header('Location: '.site_host.'mess');
		exit;
	}
		
	header('Location: '.site_host.$mods['name'].'/list');
}else
{
	//init for addintion
}
?>