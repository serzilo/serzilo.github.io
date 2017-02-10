<h2>Добавить элемент в раздел - <?php echo $registry->adm_edit_name_alt; ?> </h2> 

<form method="post" class="edit-add" enctype="multipart/form-data">

<table class="parameters" cellpadding="0" border="0" cellspacing="5">
	<tr>
	<?//------------------------------------------------------------------------------------------------?>
	
	<?php
//getcommon settings
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
		echo '<p> Извините, по данному элементу нет данных для добавления. </p>';
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
	</table><input type="submit" value="Добавить" class="submit" name="add_item" />
</form>';
	}

?>
	
	
	
	
	
	<?//------------------------------------------------------------------------------------------------?>
	
	<!--	<td class="label" width="10%">Название компании:</td> 
		<td colspan="3">
			<input type="test" class="big" name="COM_NAME"/>
		</td>
		</tr><tr>
		<td class="label" width="10%">Название компании по русски:</td> 
		<td colspan="3">
			<input type="test" class="big" name="COM_NAME_RUS"/>
		</td>
		</tr><tr>
		
		<td class="label" width="10%">Кому назначено:</td> 
		<td colspan="3">
			<input type="test" class="big" name="COM_ASSIGN"/>
		</td>
		</tr><tr>
		
		<td class="label" width="10%">Link (сайт)</td> 
		<td colspan="3">
			<input type="test" class="big" name="COM_LINK"/>
		</td>
		</tr><tr>
		<td class="label" width="10%">Контактное лицо и телефон:</td> 
		<td colspan="3">
			<input type="test" class="big" name="COM_CONTACT"/>
		</td>
		
		</tr><tr>
		<td class="label">Коментарий:</td> 
		<td colspan="3">
			<textarea class="big editor" rows="5" cols="10" name="COM_COMENT"></textarea>
			
		</td>
		
		</tr><tr>
		<td class="label">О компании:</td> 
		<td class="input" colspan="3">
		<textarea class="big editor" rows="5" cols="10" name="COM_ABOUT"></textarea>
		</td>
		
		-->
	