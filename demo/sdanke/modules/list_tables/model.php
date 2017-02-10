<?php
if(isset($registry) && is_array($registry->list_data) && !empty($registry->list_data['table']))
{ 
	$list=$registry->list_data;
	if(!isset($list['order']))
		$list['order']='';
		
	if(!isset($list['limit']))
		$list['limit']='';
		
	if(!isset($list['where']))
		$list['where']='';
		
	if(!isset($list['from']))
		$list['from']=' * ';
		
	$registry->list_tables = array();	
	
	$query='SELECT '.$list['from'].' FROM '.
	$list['table'].' '.$list['where'].
	' '.$list['order'].' '.$list['limit'];

	//echo $query;
	//var_dump($registry->db);
	
	$row = $registry->db->query($query);
	$arr=array();
	
	if($row !== false)		
	{
		while($res=$registry->db->get_assoc())
		{
			$arr[]=$res;
		}
		
	}else
	{
		$registry->last_error = ' Error selecting a list '. $query.' -> '.mysql_error();
		$this->registry->add_arr('errors',$this->registry->last_error);	
	}
	$registry->list_tables_count = $row;
	$registry->list_tables = $arr;
}else
	var_dump($registry->list_data);
?>