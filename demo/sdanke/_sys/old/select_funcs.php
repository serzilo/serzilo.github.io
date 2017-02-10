<?

function outSelect($name="select", $option_arr=array(), $txt_sel='', $selected= false, $empty=false, $value=true, $values=false, $select=true)
{
//$name - name of the variable to send
//$option_arr - array of options to choose from
//$selected - is there selected option
//$empty - is there empty field
//$value - is there values needed for options
//$values - the array of values, if not array the values are keys of option_arr
//$txt_sel - the extra text for select for use of css class
//$select - is there select lable needed

	if (!is_array($option_arr))
	{
		echo "<select name=\"$name\" $txt_sel></select>
		";
		return;
	}

	if($select)
	echo "<select name=\"$name\" $txt_sel>
	";

	if($empty)
	{
		echo "<option value=\"\">         </option>
		";
	}

	if($selected === false)
	{
		if($value)
			if(is_array($values))
			{
				foreach($option_arr as $key=>$elem)
				{

					echo "<option value=\"".$values[$key]."\"> $elem</option>
					";

				}
			}else
			{
				foreach($option_arr as $key=>$elem)
				{

					echo "<option value=\"$key\"> $elem </option>
					";

				}
			}

		else
			foreach($option_arr as $elem)
			{

				echo "<option> $elem </option>
				";

			}
	}
	else
	{
		if($value)
			if(is_array($values))
			{
				foreach($option_arr as $key=>$elem)
				{
					if($key != $selected)
					echo "<option value=\"".$values[$key]."\"> $elem </option>";
					else
					echo "<option value=\"".$values[$key]."\" selected=\"selected\"> $elem </option>
					";

				}
			}else
			{
				foreach($option_arr as $key=>$elem)
				{
					if($key != $selected)
					echo "<option value=\"$key\"> $elem </option>";
					else
					echo "<option value=\"$key\"  selected=\"selected\"> $elem </option>
					";

				}
			}
		else
			foreach($option_arr as $elem)
			{
				if($elem != $selected)
				echo "<option > $elem </option>";
				else
				echo "<option  selected=\"selected\"> $elem </option>
				";

			}
	}

	if($select)
	echo "</select>
	";

	return true;
};

?>
