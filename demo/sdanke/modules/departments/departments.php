<?php
if($registry->cur_menu=='departments')
{
	$f_ini = new file_ini();

	
	//Departments
	//$query = 'SELECT * FROM DEPARTMENTS LEFT JOIN SECTIONS ON (D_ID=S_D_ID) ORDER BY D_ID';
	$query = 'SELECT * FROM DEPARTMENTS ' ;
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
		', FILE_APPEND);
	}
	$dept=array();
	while($res=$registry->db->get_assoc())
	{
		//print_r($res);
		$dept[]=$res;
	}

	$registry->dept_arr = $dept;
	
	//Users
	
	$d_u_rels=$f_ini->read(site_path.'struc'.DIRSEP.'common.ini');
	
	$query = 'SELECT * FROM USER, DEP_USER WHERE DU_U_ID=U_ID AND DU_REL_ID< 20 ORDER BY DU_D_ID ' ;
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
		', FILE_APPEND);
	}
	$duser=array();
	while($res=$registry->db->get_assoc())
	{
		//print_r($res);
		$res['DU_REL_TXT']=$d_u_rels['d_u_rels']['rels'][$res['DU_REL_ID']];
		$duser[$res['DU_D_ID']][]=$res;
	}
	

	$registry->dept_user_arr = $duser;
	
	// Sections
	
	//$query = 'SELECT * FROM DEPARTMENTS LEFT JOIN SECTIONS ON (D_ID=S_D_ID) ORDER BY D_ID';
	$query = 'SELECT * FROM SECTIONS ORDER BY S_D_ID';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
		', FILE_APPEND);
	}
	$sec=array();
	while($res=$registry->db->get_assoc())
	{
		//print_r($res);
		if(strlen($res['S_NAME']) > 25)
			$res['S_NAME_SHORT'] = substr($res['S_NAME'],0,23).'...';
		else
			$res['S_NAME_SHORT'] =$res['S_NAME'];
		$sec[$res['S_D_ID']][]=$res;
		
	}
	$registry->dept_sec_arr = $sec;
}
?>