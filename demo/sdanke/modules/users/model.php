<?php

if($registry->action=='administration')
{
	include (dirname(__FILE__).DIRSEP.'administration.php');
}elseif($registry->action=='employees')
{
	include (dirname(__FILE__).DIRSEP.'emps_list.php');
}
?>