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
				
		header('Location: '.site_host.$mods['name'].'/add');
		exit;
	}
	
	$vals = '';
	$keys = '';
	
	if($sets['add'])
	{
		foreach($sets['add'] as $val)
		{
			if(isset($_POST[$val]))
			{
				$vals .= ' , '.$_POST[$val];
				$keys .= ' , '.$val;
			}
		}
	}
	
	if(!empty($vals))
	{
		
		$query = 'INSERT INTO '.$registry->cur_mod_struc['table'].' VALUES(null,'.$_POST['dept'].',\''.$_POST['name'].'\',\''.$f_name.'\','.$year.'
		,\''.$_POST['text'].'\',\''.$_POST['text_short'].'\',\'\', 1 ,0,0)';
		$row = $registry->db->exec($query);
		
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
		$_SESSION['mess_text']='Произошла ошибка при добавлении элемента в разделе '.$mods['name_alt'];
		file_put_contents('add_'.$mods['name'].'_log.txt', date('Y-n-j').
		' wrong post array, no needed items found -> '.file_get_contents('php://input').'
', FILE_APPEND);
		header('Location: '.site_host.$mods['name'].'/add');
		exit;
	}
		
	header('Location: '.site_host.$mods['name'].'/list');
}else
{
	//init for addintion
}
?>