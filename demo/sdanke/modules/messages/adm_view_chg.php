<?php
//if exists item_data array
if($registry->item_data && is_array($registry->item_data))
{
//get the data and common settings 
$item_data = $registry->item_data;    $com = $registry->common;

	if(isset($com[$mods['name']]) && is_array($com[$mods['name']]['chg']))
	{
		$sets = $com[$mods['name']]['chg'];
	}else
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
	$keys = '';
	if(isset($sets)) //if there are needed settings for adm panel
	{
		echo '<form method="post" class="edit-add">
<table class="parameters" cellpadding="0" border="0" cellspacing="5">
	<tr>';
		
		foreach($sets as $val)
		{
			$registry->adm_field_data = array('mods'=>$mods,'struc'=>$struc, 'val'=>$val);
			$registry->modules->adm_fields->view();
		}
	echo '</tr>
	</table><input type="submit" value="Изменить" class="submit" name="add_user" />
</form>';
	}
}else
{
	echo '<p> Извините, по данному элементу нет данных для изменения.. </p>';
}
?>