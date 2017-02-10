<?php
if(!empty($_POST))
{
	$num=$registry->adm_class->find_num();

	if($num)
	{
		$com = $registry->common;

		if(isset($com[$mods['name']]) && is_array($com[$mods['name']]['chg']))
		{
			$sets = $com[$mods['name']]['chg'];
		}
		else
		{
			$registry->log->log('chg_'.$mods['name'].'_log.txt',
			' '. __FILE__ .' line '.__LINE__ .' ' .$registry->adm_class->get_ref().
			' -> common settings for '.$mods['name'].' not present
	');
			echo '<p> Извините, по данному элементу нет данных для изменения. </p>';
			//echo '<pre>';
			//var_dump($com);
			//echo '</pre>';
		}
		
		$vals = '';
		$query = '';
		$post = $registry->db->get_real_strs($_POST);
		if(isset($sets)) //if there are needed settings for adm panel
		{
			foreach($sets as $val)
			{
				$query .= $struc['sql_prefix'].'_'.$val.' = \''.$post[$struc['sql_prefix'].'_'.$val].'\'';
				if(next($sets))
					$query .=', ';
				
			}
		}
		
		$query = 'UPDATE '.$struc['table'].' SET '.$query.' WHERE '.$struc['sql_prefix'].'_ID='.$num;
		$row = $registry->db->exec($query);
		
		if($row === false)
		{
			$_SESSION['mess_text']='Произошла ошибка при изменении объекта в разделе '.$mods['name_alt'];
			$registry->log->log('chg_'.$mods['name'].'_log.txt', __FILE__ .' line '.__LINE__ .' '.$query.' -> '.mysql_error().'
');
			header('Location: '.site_host.'mess');
			exit;
		}
		header('location: '.site_host.$mods['name'].'/list');
		exit;
	}else
		header('location: '.site_host.$mods['name'].'/list');
	exit;
}else
{
	$registry->cur_sub_menu = 'chg';
	
	$num=$registry->adm_class->find_num();
	if($num !== false)
	{
		$query='SELECT * FROM '.$struc['table'].' WHERE '.$struc['sql_prefix'].'_ID='.$num;
		$row = $registry->db->query($query);
		$arr=array();
		if($row !== false)		
		{
			$arr=$registry->db->get_assoc();
		}else
			$registry->db_error(' Error selecting a list '. $query.' -> '.mysql_error());
		
		$registry->item_data = $arr;
	}else
	{
		header('location: '.site_host.$mods['name'].'/');
		exit;
	}
	$registry->mce=FALSE;
}
$registry->mce=FALSE;
?>