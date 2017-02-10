<?php
if($registry->action=='administration')
{
	$query='SELECT * FROM USER WHERE U_JOB_ID<20 ORDER BY U_JOB_ID';
	$row = $registry->db->query($query);

	
	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_user_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
	}
	$arr=array();
	if(isset($registry->args[0]))
		$active=intval($registry->args[0]);
	else
		$active = 0;
	//echo ' - '.$active.' - ';
	while($res = $registry->db->get_assoc())
	{
		//echo $res['U_JOB_ID'];
		if($active == $res['U_JOB_ID'])
			$res['class']='class="active"';
		else
			$res['class']='';
			
		$arr[]=$res;
	}
	//$active=intval($registry->args[0]);
	$max=count($arr);
	if($max-1 !== $active)
		$arr[$max-1]['class']='class="last"';
	else
		$arr[$max-1]['class']='class="active last"';
	$registry->adm_active=$arr[$active];
	$registry->adm_max=$max;
	$registry->adm_next= $arr[($active+1)%$max];
	
	$registry->admin_arr=$arr;
	
	$registry->emps_photo_link = '<a href="'.site_host.'employees">Фотографиями</a>';
	$registry->emps_text_link = '<a href="'.site_host.'employees/text">По алфавиту</a>';
	$registry->emps_admin_link = 'Администрация';
}
?>