<?php
include(dirname(__FILE__).DIRSEP.'paging.php'); //find the location of paging function file
if(($registry->paging_arr !== false) && is_array($registry->paging_arr) )
{
	//set default values for paging array
	$p = array('total'=>10, 'num'=>0, 'call_addr'=>'', 'prefix'=>'../', 'per_page'=>10, 'end_call'=>'', 'delta'=>2);
	//print_r($registry->paging_arr);
	$p = array_merge($p, $registry->paging_arr); //merge defaults with passed array
	//print_r($p);
	//calling paging function
	paging($p['total'], $p['num'], $p['call_addr'], $p['prefix'], $p['per_page'], $p['end_call'], $p['delta']);
}

?>