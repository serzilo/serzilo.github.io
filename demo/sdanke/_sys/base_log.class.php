<?php
class base_log extends obj
{ 
	// --------------------- variables
	//data elements 
		
	// --------------------- method declaration
	
	function log($file, $data, $append=FILE_APPEND)
	{
		if(empty($file))
			$file = 'common_log.txt';
		file_put_contents($file, date('Y-n-j').' -> '.$data.'
', $append);
	}

	
}

?>