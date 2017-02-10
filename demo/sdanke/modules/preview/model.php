<?php
if($registry->preview=='main')
{
	$registry->preview_show=true;
	
	$query='SELECT * FROM PREVIEWS WHERE PR_DATE_END>NOW() AND PR_DATE < NOW() ORDER BY RAND() LIMIT 1';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_preview_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
	}

	if($row === 0)
	{
		//echo mysql_error();
		$query='SELECT * FROM PREVIEWS ORDER BY PR_DATE_END DESC LIMIT 1';
		$row = $registry->db->query($query);
	}
	
	if($row !== false)
	{
		$date = new date_ru();
		$arr=$registry->db->get_assoc();
				
		//$arr['PR_TEXT_SHORT']=str_replace(' ','</span><span>',$arr['PR_TEXT_SHORT']);
		$registry->template->add_arr($arr);
		$registry->template->add_arr($date->get_date_arr($arr['PR_DATE']));
		
	}else
	{
		//echo mysql_error();
		$registry->preview_show=false;
	}
}elseif($registry->cur_menu=='preview')
{
	
	$args=$registry->args;
	
	$num=array_search('show',$args);
	if($num !== false && isset($args[$num+1]))
	{
		$preview_num=$args[$num+1];
	}else
		Header('Location: '.site_host.'previews/all');
		
	$query='SELECT * FROM PREVIEWS WHERE PR_ID='.$preview_num;
	$row = $registry->db->query($query);

	if($row === false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_preview_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
		Header('Location: '.site_host.'previews/all');
	}

	if($row === 0)
	{
		Header('Location: '.site_host.'previews/all');
	}
	
	
		$tmp=array();
		$date = new date_ru();
		$arr=$registry->db->get_assoc();
		
			$arr['date']=$date->get_date($arr['PR_DATE']);
			
		
		$registry->preview_arr=$arr;
	
	
}elseif($registry->cur_menu=='previews')
{
	$query='SELECT * FROM PREVIEWS WHERE PR_DATE_END>NOW() AND PR_DATE < NOW() ORDER BY PR_DATE DESC';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_preview_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
		Header('Location: '.site_host);
	}

	
	
		$tmp=array();
		$date = new date_ru();
		while($arr=$registry->db->get_assoc())
		{
			$arr['PR_TEXT_SHORT']=str_replace(' ','</span><span>',$arr['PR_TEXT_SHORT']);
			
			$arr['date']=$date->get_date($arr['PR_DATE']);
			$tmp[]=$arr;
		}
		$registry->preview_arr=$tmp;
	
}
?>