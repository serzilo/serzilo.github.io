<?php
// requires php5
class arr2str
{
	// --------------------- variables
	
	// --------------------- method declaration

	// converts an array to string, keys of options are listed divided by $delim - default ',' (comma)
	//$options is the array of values the keys of witch are put into string
	function arr_str($data, $options, $delim=',')  
	{   
		$txt='';
		foreach ($data as $key => $val) 
		{    
			$k= array_search( $val, $options);
			if($k!= false)
			{
			  $txt .=$k.',';
			}
		}
		return $txt;
	}
	//converts a string to an array, keys of $options are listed divided by $delim - default ',' (comma)
	//keys of new array are natural 0,1,2,....
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
	}

	//converts a string to an array, keys of $options are listed divided by $delim - default ',' (comma)
	// preserve the same keys as in options
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
	}

	//converts string of keys to string of values of array $options
	function str_str($data, $options, $delim=',')
	{ 	
		$arr=str_arr($data, $options, $delim);
		return implode(', ', $arr);
	}
}
?>