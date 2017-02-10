<?php
$arr['name'] = $mods['name'];   $arr['table']= $struc['table'];
if(empty($_POST))
{
	$arr['order']=' ORDER BY '.$struc['sql_prefix'].'_PAGE ';	
	$_SESSION['adm_search']=array();
	$registry->list_data= $arr;
	$registry->modules->list_tables->model();
}else		// fillter was envoked
{
	$code = '';
	$_SESSION['adm_search']=$_POST;
	
	if(isset($_POST['title']) && !empty($_POST['title'])) 	//fillter on title
		$code .=' AND '.$struc['sql_prefix']."_TITLE LIKE '%".$_POST['title']."%' " ;
	
	if(isset($_POST['page']) && !empty($_POST['page']))		//fillter on page
		$code .=' AND '.$struc['sql_prefix']."_PAGE LIKE '%".$_POST['page']."%' " ;

	if(isset($_POST['name']) && !empty($_POST['name']))		//fillter on name
		$code .=' AND '.$struc['sql_prefix']."_NAME LIKE '%".$_POST['name']."%' " ;
	
	if(!empty($code))
		$arr['where']=' WHERE '.substr($code, 4);	
	
	$arr['order']=' ORDER BY '.$struc['sql_prefix'].'_PAGE ';	
    $registry->list_data= $arr;
	
	$registry->modules->list_tables->model();
}
?>