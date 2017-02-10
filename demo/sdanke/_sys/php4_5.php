<?php 
if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data, $append=false) {
        if($append)
			$f = @fopen($filename, 'a');
		else
			$f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}

function get_file_contents($filename)
{
	if (!function_exists('file_get_contents'))
	{
		$fhandle = fopen($filename, "r");
		$fcontents = fread($fhandle, filesize($filename));
		fclose($fhandle);
	}
	else
	{
		$fcontents = file_get_contents($filename);
	}
	return $fcontents;
}

?>