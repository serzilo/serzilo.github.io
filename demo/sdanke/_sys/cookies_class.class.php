<?php
if(!class_exists('cookies_class')) 
{ 
	class cookies_class
	{ 
		// --------------------- variables
		//data elements 
		private $data='';		
		
		// --------------------- method declaration
	
	//sets cookies fron array - $send_arr
	//sends multiple cookies from array $send_arr
	function send_cookies($send_arr)
	{
		if (!is_array($send_arr)) return false;

		foreach($send_arr as $key => $value)
		{
			setcookie("$key","$value");
		}
		return true;
	}
		//clears all cookies exept the ones in $exeption (as keys and values)
	function clear_cookies($exeptions=array())
	{
		if(is_array($exeptions))
		{
			foreach($_COOKIE as $key => $value)
			{
				if(!array_key_exists($key,$exeptions) || !in_array($key,$exeptions))
					setcookie("$key",'');
			}
		}else
		{
			foreach($_COOKIE as $key => $value)
			{
				setcookie("$key",'');
			}
		}
		return true;
	}
}
?>