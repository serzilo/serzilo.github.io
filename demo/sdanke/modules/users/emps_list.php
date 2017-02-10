<?php
if($registry->action=='employees')
{
	$args=$registry->args;
	if(isset($args[0]) && is_numeric($args[0]))
	{
		$query='SELECT * FROM  USER WHERE U_ID='.$args[0];
		$row = $registry->db->query($query);

		//echo ' -'.$row.'- ';
		//var_dump($row);
		if($row == false)
		{
			$tmp=$registry->db->get_error();
			file_put_contents('log_emps_mode.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
			', FILE_APPEND);
			header('Location: '.site_host.'employees');
			exit;
		}
		
		$user=$registry->db->get_assoc();

		$registry->user_arr = $user;
		$registry->cur_menu = 'employee';
		
	}else
	{
		
		//Departments
		//$query = 'SELECT * FROM DEPARTMENTS LEFT JOIN SECTIONS ON (D_ID=S_D_ID) ORDER BY D_ID';
		$query = 'SELECT * FROM DEPARTMENTS ' ;
		$row = $registry->db->query($query);

		if($row == false)
		{
			$tmp=$registry->db->get_error();
			file_put_contents('log_emps_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
			', FILE_APPEND);
		}
		$dept=array();
		while($res=$registry->db->get_assoc())
		{
			//print_r($res);
			$dept[]=$res;
		}

		$registry->dept_arr = $dept;
		
		//USERS
		$query='SELECT * FROM  USER, DEP_USER WHERE U_ID=DU_U_ID GROUP BY U_ID,DU_D_ID ORDER BY DU_D_ID ';
		$row = $registry->db->query($query);

		//echo ' -'.$row.'- ';
		//var_dump($row);
		if($row == false)
		{
			$tmp=$registry->db->get_error();
			file_put_contents('log_emps_mode.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
			', FILE_APPEND);
		}
			
		//echo '<pre>';
		$sec_user=array();
		while($res=$registry->db->get_assoc())
		{
			//print_r($res);
			$sec_user[$res['DU_D_ID']][]=$res;
		}

		//echo '</pre>';
		
		$registry->sec_user_arr = $sec_user;
		
		
		
		if(isset($args[0]) && $args[0]=='text')
		{	$registry->emps_photo_link = '<a href="'.site_host.'employees">Фотографиями</a>';
			$registry->emps_text_link = 'По алфавиту';
			$registry->emps_admin_link = '<a href="'.site_host.'employees/administration">Администрация</a>';
			
		}else
		{
			$registry->emps_photo_link = 'Фотографиями';
			$registry->emps_text_link = '<a href="'.site_host.'employees/text">По алфавиту</a>';
			$registry->emps_admin_link = '<a href="'.site_host.'employees/administration">Администрация</a>';
			
		}
	}
}
?>