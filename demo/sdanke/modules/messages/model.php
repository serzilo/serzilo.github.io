<?php
$dir=dirname(__FILE__).DIRSEP;
include($dir.'include.php');

$num=$registry->cont_class->find_arg('pg');
if(!$num)
	$num=0;

$query = 'SELECT * FROM '.$struc['table'].' WHERE TRUE LIMIT 1 ';
	
	$row = $registry->db->query($query);
	
	if($row === false)
		$registry->adm_class->goto_error('error', $query.' -> '.mysql_error());
	
	$data = $registry->db->get_assoc();
	if(isset($data[$struc['sql_prefix'].'_SHOW']))
		$query = 'SELECT * FROM '.$struc['table'].' WHERE '.$struc['sql_prefix'].'_SHOW = 1 
		ORDER BY '.$struc['sql_prefix'].'_DATE_EDIT  ';
	elseif(isset($data[$struc['sql_prefix'].'_ACTIVE']))
		$query = 'SELECT * FROM '.$struc['table'].' WHERE '.$struc['sql_prefix'].'_ACTIVE = 1 
		ORDER BY '.$struc['sql_prefix'].'_DATE_EDIT  ';
	elseif(isset($data[$struc['sql_prefix'].'_READ']))
		$query = 'SELECT * FROM '.$struc['table'].' WHERE '.$struc['sql_prefix'].'_READ = 1 
		ORDER BY '.$struc['sql_prefix'].'_DATE_EDIT ';
	else
		$registry->adm_class->goto_mess('ошибка', ' Некорректные данные');

$row = $registry->db->query($query);



if($row === false)
{
	$tmp=$registry->db->get_error();
	file_put_contents('log_messages_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
	', FILE_APPEND);
}

$arr=array();

//echo $query;
	while($res=$registry->db->get_assoc())
	{
		
		$arr[]=$res;
	}

$registry->items_arr = $arr;
?>