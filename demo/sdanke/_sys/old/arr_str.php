<?php 
	
function arr_str($data, $options, $delim=',')
{   
	 $txt="";
	 foreach ($data as $key => $val) 
	 {    
		$k= array_search( $val, $options);
		if($k!= false)
		{
		  $txt .=$k.',';
		}
	 }
	return $txt;
};

	
function str_arr($data, $options, $delim=',')
{ 	
	$arr=array();
	$pieces = explode($delim , $data);	
	foreach ($pieces as $val)
	{	
	   if($val != '')
			$arr[]=$options[$val];	
	}
	return $arr;
};

function str_arr_keys($data, $options, $delim=',')
{ 	
	$arr=array();
	$pieces = explode($delim , $data);	
	foreach ($pieces as $val)
	{	
	   if($val != '')
			$arr[$val]=$options[$val];	
	}
	return $arr;
};

function str_str($data, $options, $delim=',')
{ 	
	$arr=str_arr($data, $options, $delim);
	return implode(', ', $arr);
}
?>