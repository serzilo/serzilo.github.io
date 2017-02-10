<?

function upload2path($name,$path) 
{
	if (!empty($_FILES[$name]['tmp_name'])) 
	{ 
		move_uploaded_file($_FILES[$name]['tmp_name'], $path.$_FILES[$name]['name']); 
		$filename = $_FILES[$name]['name']; 
		$filesize = $_FILES[$name]['size']; 
		chmod ($path.$filename."", 0644); 
	} 
	return true; 
}

// ---  FORM SELECTION  ---

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
	return $res;
}

function site_des($dir) 
{
    $mydir = opendir($dir);
    while(false !== ($file = readdir($mydir))) {
        if($file != "." && $file != "..") {
            chmod($dir.$file, 0777);
            if(is_dir($dir.$file)) {
                chdir('.');
                site_des($dir.$file.'/');
                rmdir($dir.$file) or DIE("couldn't delete $dir$file<br />");
            }
            else
            unlink($dir.$file) or DIE("couldn't delete $dir$file<br />");
        }
    }
    closedir($mydir);//*/
	
}


?>