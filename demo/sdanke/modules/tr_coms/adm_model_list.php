<?php

//print_r($_SESSION['adm_search']);

$arr['name'] = $mods['name'];   $arr['table']= $struc['table'];
if(empty($_POST) && empty($_SESSION['adm_search']))
{
	$arr['order']=' ORDER BY '.$struc['sql_prefix'].'_DATE_EDIT DESC';	
	//$_SESSION['adm_search']=array();
	$registry->list_data= $arr;
	$registry->modules->list_tables->model();
}else		// fillter was envoked
{
	$code = '';
	if(isset($_POST['filter']))
		$_SESSION['adm_search']=$_POST;
	
	if(isset($_SESSION['adm_search']['ASSIGN']) && !empty($_SESSION['adm_search']['ASSIGN'])) 	//fillter on title
		$code .=' AND '.$struc['sql_prefix']."_ASSIGN LIKE '%".$_SESSION['adm_search']['ASSIGN']."%' " ;
	
	if(isset($_SESSION['adm_search']['TYPE']) && (!empty($_SESSION['adm_search']['TYPE']) ||
	$_SESSION['adm_search']['TYPE']=='0') && $_SESSION['adm_search']['TYPE']!='-1') 	//fillter on title
		$code .=' AND '.$struc['sql_prefix']."_TYPE =".$_SESSION['adm_search']['TYPE']." " ;
	
	
	if(isset($_SESSION['adm_search']['NAME_RUS']) && !empty($_SESSION['adm_search']['NAME_RUS']))		//fillter on page
		$code .=' AND '.$struc['sql_prefix']."_NAME_RUS LIKE '%".$_SESSION['adm_search']['NAME_RUS']."%' " ;

	if(isset($_SESSION['adm_search']['NAME']) && !empty($_SESSION['adm_search']['NAME']))		//fillter on name
		$code .=' AND '.$struc['sql_prefix']."_NAME LIKE '%".$_SESSION['adm_search']['NAME']."%' " ;
		
	if(isset($_SESSION['adm_search']['date_create_to']) && !empty($_SESSION['adm_search']['date_create_to']))
	{
		$code .=" AND COM_DATE_CREATE <= '".$_SESSION['adm_search']['date_create_to']."' " ;
	}
	
	if(isset($_SESSION['adm_search']['date_create_from']) && !empty($_SESSION['adm_search']['date_create_from']))
	{
		$code .=" AND COM_DATE_CREATE >= '".$_SESSION['adm_search']['date_create_from']."' " ;
	}
	
	if(isset($_SESSION['adm_search']['date_edit_to']) && !empty($_SESSION['adm_search']['date_edit_to']))
	{
		$code .=" AND COM_DATE_EDIT <= '".$_SESSION['adm_search']['date_edit_to']."' " ;
	}
	
	if(isset($_SESSION['adm_search']['date_edit_from']) && !empty($_SESSION['adm_search']['date_edit_from']))
	{
		$code .=" AND COM_DATE_EDIT >= '".$_SESSION['adm_search']['date_edit_from']."' " ;
	}
	
	if(!empty($code))
		$arr['where']=' WHERE '.substr($code, 4);	
	
	$arr['order']=' ORDER BY '.$struc['sql_prefix'].'_DATE_EDIT DESC';	
    $registry->list_data= $arr;
	
	$registry->modules->list_tables->model();
}
?>