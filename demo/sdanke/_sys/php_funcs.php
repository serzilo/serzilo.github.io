<?php
function filter_form($val)
{
	global $pre;
	if(strpos($val,$pre) === 0)
	{
		return true;
	}	
	else
	{
		return false;
	}
}

function sel_form_data($arr, $predicate)
{
	global $pre;
	$pre = $predicate;
	$tmp_k = array_keys($arr);
	$tmp = array_filter($tmp_k, 'filter_form');
	$res = array();
	foreach($tmp as $val)
	{
		$res[$val] = $arr[$val];
	}
	$this->form_data=$res;
	return $res;
}
?>