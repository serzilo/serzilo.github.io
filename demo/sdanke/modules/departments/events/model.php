<?php
if($registry->cur_menu=='main')
{
//insert into EVENTS VALUES(null, 'к 65-летию Великой Победы',0,'2010-01-01', '2010-12-31', '','','65let.png',0,0,0);
	$query='SELECT * FROM EVENTS WHERE EVE_DATE_END>NOW() ORDER BY EVE_PRIORITY LIMIT 3';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('modules/events/log_eve_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
	}else
	{
		while($res = $registry->db->get_assoc())
		{
			$tmp[]=$res;
		}
		
		$registry->eve_arr=$tmp;
	}
}
?>