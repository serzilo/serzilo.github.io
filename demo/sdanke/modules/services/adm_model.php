<?php
$dir=dirname(__FILE__).DIRSEP;
include($dir.'include.php');

$registry->set_arr('mods', $mods['name'], array('mods'=>$mods, 'struc'=>$struc) );
$registry->adm_edit_name_alt=$mods['name_alt'];

$val = $registry->cur_sub_menu;
if(strpos($val, 'add') !==false)
	include($dir.$mods['adm_model_add']);
elseif(strpos($val, 'del') !==false)
	include($dir.$mods['adm_model_del']);
elseif(strpos($val, 'chg') !==false)
	include($dir.$mods['adm_model_chg']);
else
	include($dir.$mods['adm_model_list']);
?>