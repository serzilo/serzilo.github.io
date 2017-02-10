<?php
if($registry->cur_menu=='main')
{
	$query='SELECT * FROM PREVIEWS WHERE PR_DATE_END>NOW() ORDER BY RAND() LIMIT 1';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
		', FILE_APPEND);
	}
	
	$date = new date_ru();
	
	
	$arr=$registry->db->get_assoc();
	
	
	$arr['PR_TEXT']=str_replace(' ','</span><span>',$arr['PR_TEXT']);
	
	$registry->template->add_arr($arr);
	$registry->template->add_arr($date->get_date_arr($arr['PR_DATE']));
	
}
?>