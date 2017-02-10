<?php
if(isset($registry) && is_array($registry->adm_field_data) )
{
	$com = $registry->common;
	$mdata = $registry->adm_field_data;
	$item_data = $registry->item_data;

	if(isset($com[$mdata['mods']['name']][$mdata['val']]))
	{
		$name = $com[$mdata['mods']['name']][$mdata['val']];
	}else
		$name = $mdata['val'];
		
	if(isset($com['input_types'][$mdata['val']]))
		$type = $com['input_types'][$mdata['val']];
	else
		$type = 'text';
		
		switch ($type)
		 {
    case 'textarea':
        echo '<td class="label">'.$name.'</td> 
		<td class="input" colspan="3">
		<textarea class="big editor" rows="5" cols="20" 
		name="'.$mdata['struc']['sql_prefix'].'_'.$mdata['val'].'">'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'</textarea>
		</td>
		
		</tr><tr>';
        break;
	case 'select':
        echo '<td class="label">'.$name.'</td> 
		<td class="input" colspan="3">
		<select name="'.$mdata['struc']['sql_prefix'].'_'.$mdata['val'].'">
		';
		if(isset($mdata['struc'][$mdata['val']]) && is_array($mdata['struc'][$mdata['val']]))
			foreach($mdata['struc'][$mdata['val']] as $sel_key => $sel_val)
			{
				if(isset($mdata['struc'][$mdata['val'].'_COLORS']) && is_array($mdata['struc'][$mdata['val'].'_COLORS']))
					if($item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']] == $sel_key)
					echo '<option style="background-color: '.$mdata['struc'][$mdata['val'].'_COLORS'][$sel_key].'" value="'.$sel_key.'" selected>'.$sel_val.'</option>';
				else
					echo '<option style="background-color: '.$mdata['struc'][$mdata['val'].'_COLORS'][$sel_key].'" value="'.$sel_key.'">'.$sel_val.'</option>';
				else
					if($item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']] == $sel_key)
					echo '<option value="'.$sel_key.'" selected>'.$sel_val.'</option>';
				else
					echo '<option value="'.$sel_key.'">'.$sel_val.'</option>';
				
			}
		echo '
		</select>
		</td>
		
		</tr><tr>';
        break;
	case 'select_no_val':
        echo '<td class="label">'.$name.'</td> 
		<td class="input" colspan="3">
		<select name="'.$mdata['struc']['sql_prefix'].'_'.$mdata['val'].'">
		';
		if(isset($mdata['struc'][$mdata['val']]) && is_array($mdata['struc'][$mdata['val']]))
			foreach($mdata['struc'][$mdata['val']] as $sel_val)
			{
				if($item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']] == $sel_val)
					echo '<option selected>'.$sel_val.'</option>';
				else
					echo '<option >'.$sel_val.'</option>';
				
			}
		echo '
		</select>
		</td>
		
		</tr><tr>';
        break;
	case 'link':
	
		if(!empty($item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']]) &&
		strpos('http', $item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']]) ===false)
		{
			echo '<td class="label">'.$name.'</td> 
			<td colspan="3">
				<input type="text" class="big" 
				name="'.$mdata['struc']['sql_prefix'].'_'.$mdata['val'].'" 
				value="'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'"/> <br/>
				<a href="http://'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'" >
				'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'</a>
			</td>
		</tr><tr>';
		}else
		echo '<td class="label">'.$name.'</td> 
			<td colspan="3">
				<input type="text" class="big" 
				name="'.$mdata['struc']['sql_prefix'].'_'.$mdata['val'].'" 
				value="'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'"/> <br/>
				<a href="'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'" >
				'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'</a>
			</td>
		</tr><tr>';
		break;
	default:
        echo '<td class="label">'.$name.'</td> 
		<td colspan="3">
			<input type="text" class="big" 
			name="'.$mdata['struc']['sql_prefix'].'_'.$mdata['val'].'" 
			value="'.$item_data[$mdata['struc']['sql_prefix'].'_'.$mdata['val']].'"/>
		</td>
		
		</tr><tr>';
		}
  
}
?>