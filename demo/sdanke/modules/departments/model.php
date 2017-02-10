<?php
if($registry->cur_menu=='departments')
{
	$args = $registry->args;
	if(isset($args[0]) && is_numeric($args[0]))
	{
		$registry->cur_menu= 'department';
		include (dirname(__FILE__).DIRSEP.'department.php');
	}elseif($registry->cur_menu=='departments')
	{
		include (dirname(__FILE__).DIRSEP.'departments.php');
	}
}
?>