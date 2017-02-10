<?php
Class Base_file 
{
	/*
	 * @registry object
	 */
	protected $fdata;
	
	function file2str($file) //$file -name of the file to load the text from 
	{ 
		if(file_exists($file) && is_readable($file)) 
		{ 
			return $fdata=file_get_contents($file); 
		}else 
		{ 
			return false; 
		} 
	} 
}
?>