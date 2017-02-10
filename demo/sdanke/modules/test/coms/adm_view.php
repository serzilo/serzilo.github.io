<?php
$dir=dirname(__FILE__).DIRSEP;
include($dir.'include.php');

$val = $registry->cur_sub_menu;
if(strpos($val, 'add') !==false)
	include($dir.$mods['adm_view_add']);
elseif(strpos($val, 'chg') !==false)
	include($dir.$mods['adm_view_chg']);
else
	include($dir.$mods['adm_view_list']);
?>