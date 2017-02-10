<?php
if($registry->cur_menu=='department')
{
	$f_ini = new file_ini();

	$args = $registry->args;
	
	//Departments
	//$query = 'SELECT * FROM DEPARTMENTS LEFT JOIN SECTIONS ON (D_ID=S_D_ID) ORDER BY D_ID';
	$query = 'SELECT * FROM DEPARTMENTS WHERE D_ID='. $registry->args[0] ;
	$row = $registry->db->query($query);
	
	$dept=array();
	
	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
		', FILE_APPEND);
	}else
		$dept=$registry->db->get_assoc();
	
	$registry->department = $dept;
	
}
?>