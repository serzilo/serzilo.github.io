<?php

//echo 'News model';
$date = new date_ru();
if($registry->cur_menu=='main')
{
	$query='SELECT * FROM NEWS, DEPARTMENTS WHERE N_D_ID=D_ID AND N_SHOW=1 ORDER BY N_DATE DESC LIMIT 3';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_news_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
	}else
	{
		$i=-1;
		while($res = $registry->db->get_assoc())
		{
			$i++;
			$res['class']='';
			$res['N_TEXT_SHORT']=htmlspecialchars_decode($res['N_TEXT_SHORT']);
						$res['N_TEXT']=htmlspecialchars_decode($res['N_TEXT']);
						$res['N_NAME']=htmlspecialchars_decode($res['N_NAME']);
						
			$res['date'] = $date->get_date($res['N_DATE']);
			$tmp[]=$res;
		}
		$tmp[$i]['class']=' newsitem_teaser_last';
		$registry->news_arr=$tmp;
	}
	//--------------------------------------------------------------------------
	
	if(is_array($registry->eve_arr))
	{
		$tmp=array();
		$news_key_arr=array();
		foreach($registry->eve_arr as $eve_key => $eve_val)
		{
			$keys=explode(',',$eve_val['EVE_KEYS']);
			$tmp_txt='';
			if(count($keys)>0 && !empty($keys[0]))
			{
				foreach($keys as $kval)
					$tmp_txt .= " N_KEYS like '%$kval%' OR";
				$tmp_txt = '('.substr($tmp_txt,0, -3).')';
				//echo $tmp_txt;
				$query='SELECT * FROM NEWS, DEPARTMENTS WHERE N_D_ID=D_ID AND N_SHOW=1 AND '.$tmp_txt.' ORDER BY RAND() LIMIT 3';
				//echo $query;
				$row = $registry->db->query($query);

				if($row == false)
				{
					$tmp=$registry->db->get_error();
					file_put_contents('modules/news/log_news_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
					', FILE_APPEND);
				}else
				{
					$i=-1;
					$tmp=array();
					while($res = $registry->db->get_assoc())
					{
						$i++;
						$res['class']='';
						$res['order']=$eve_key+2;
						$res['N_TEXT_SHORT']=htmlspecialchars_decode($res['N_TEXT_SHORT']);
						$res['N_TEXT']=htmlspecialchars_decode($res['N_TEXT']);
						$res['N_NAME']=htmlspecialchars_decode($res['N_NAME']);
						
						$res['date'] = $date->get_date($res['N_DATE']);
						$tmp[]=$res;
						
					}
					
					$tmp[$i]['class']=' newsitem_teaser_last';
					$news_key_arr[$eve_key+2]=$tmp;
				}
			}
		}
		$registry->news_key_arr=$news_key_arr;
	}
	//echo '<pre>';
	//var_dump($registry->news_key_arr);
	//echo '</pre>';
}elseif($registry->news_type == 'all')
{
	
	$query='SELECT * FROM NEWS, DEPARTMENTS WHERE N_D_ID=D_ID AND N_SHOW=1 ORDER BY N_DATE DESC '.$registry->paging_limit;
	$row = $registry->db->query($query);
	//echo $query;
	if($row === false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_news_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
		header('Location: '.site_host.'news');
	}else
	{
		if($row == 0)
			Header('location: '.site_host);
		
		if(is_array($registry->paging_arr))
		{
			$registry->paging_arr = array_merge($registry->paging_arr , 
		array('total'=>$row,'prefix'=>site_host));
		}else
			$registry->paging_arr = array('total'=>$row, 'call_addr'=>'news/', 
			'prefix'=>site_host, 'per_page'=>2, 'end_call'=>'', 'delta'=>2);
			//*/
		$i=0;
		$tmp=array();
		$date = new date_ru();
		while(($res = $registry->db->get_assoc()) && $i<$registry->paging_arr['per_page'])
		{
			$i++;
			$res['N_TEXT_SHORT']=htmlspecialchars_decode($res['N_TEXT_SHORT']);
						$res['N_TEXT']=htmlspecialchars_decode($res['N_TEXT']);
						$res['N_NAME']=htmlspecialchars_decode($res['N_NAME']);
						
			$res['date'] = $date->get_date($res['N_DATE']);
			$tmp[]=$res;
		}
		$registry->news_arr=$tmp;
	}
}elseif($registry->news_type == 'single')
{
	if(count($registry->args)>0)
		$id = intval($registry->args[0]);
	else
		Header('Location: '.site_host.'news/all');
	$query='SELECT * FROM NEWS, DEPARTMENTS WHERE N_D_ID=D_ID AND N_ID='.$id.' AND N_SHOW=1 ';
	$row = $registry->db->query($query);

	if($row == false)
	{
		$tmp=$registry->db->get_error();
		file_put_contents('log_news_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp.'
		', FILE_APPEND);
		header('Location: '.site_host.'news');
	}else
	{
		$res = $registry->db->get_assoc();
		$res['N_TEXT_SHORT']=htmlspecialchars_decode($res['N_TEXT_SHORT']);
						$res['N_TEXT']=htmlspecialchars_decode($res['N_TEXT']);
						$res['N_NAME']=htmlspecialchars_decode($res['N_NAME']);
						
		
		$res['date'] = $date->get_date($res['N_DATE']);
				
		$registry->news_arr=$res;
	}
}
?>