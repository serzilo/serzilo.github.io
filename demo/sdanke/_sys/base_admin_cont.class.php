<?php

Abstract Class base_admin_cont extends base_cont 
{
	/*
	 * @registry object
	 */
	
	function __construct($registry) 
	{
		$this->site_path=site_path.$registry->site_path_extra.DIRSEP;
		$this->registry = $registry;
		if(isset($_GET['rt']))
		{
			$tmp=explode('/',$_GET['rt']);
			$registry->cur_menu = $tmp[0];
			//
		}else
			$registry->cur_menu = '';
		
		
		$registry->template= new template($registry);
		$registry->template->set_path($registry->site_path_extra);
		$registry->modules= new modules($registry);
		$registry->adm_class=$this;
		$registry->cont_class=$this;
		
		if($registry->cur_menu !=='login') // login can be accesed by anyone
		{
			$this->start();
			$this->allow();//can we go here???
		}
	}
	
	function allow()
	{
		$registry = $this->registry;
		if($registry->cur_menu !=='login' && $registry->cur_menu !=='' && !$this->check_pr($registry->cur_menu))
		{
			Header('Location: '.site_host);
		}
	
	}
	
	function check_pr($name)
	{
		return true;
		//echo $name.'<pre>';
		//print_r($_SESSION);
		//echo '</pre>';
		
		if(empty($_SESSION) || !isset($_SESSION['adm_pass']) || 
		!isset($_SESSION['adm_login']) || !isset($_SESSION['adm_meta_data']) ||
		!is_array($_SESSION['adm_meta_data']) || !isset($_SESSION['adm_meta_data']['allow']))
			return false;
		
		$allow = $_SESSION['adm_meta_data']['allow'];
		if(isset($_SESSION['adm_meta_data']['deny']))
			$deny = $_SESSION['adm_meta_data']['deny'];
		//var_dump(count($allow)===0 && !isset($deny));
		if(is_array($allow) && ((count($allow)===0 && !isset($deny)) || array_key_exists($name, $allow)))
			return true;
		
		return false;
	}
	
	function check_pr_chg($name)
	{
		return true;
		if(empty($_SESSION) || !isset($_SESSION['adm_pass']) || 
		!isset($_SESSION['adm_login']) || !isset($_SESSION['adm_meta_data']) ||
		!is_array($_SESSION['adm_meta_data']) || !isset($_SESSION['adm_meta_data']['allow_chg']))
			return false;
		
		$allow = $_SESSION['adm_meta_data']['allow_chg'];
		if(isset($_SESSION['adm_meta_data']['deny_chg']))
			$deny = $_SESSION['adm_meta_data']['deny_chg'];
		
		if(is_array($allow) && ((count($allow)===0 && !isset($deny)) || array_key_exists($name, $allow)))
			return true;
		
		return false;
	}
	
	function check_action()
	{
		
	}

	function get_pr($post_arr)
	{
		$registry = $this->registry;
		
		if(!$registry->menu_data)
		{
			$menu = parse_ini_file($this->site_path.'struc/menu.ini',true); 
			$registry->menu_data = $menu;
		}

		$pr_arr['allow']=array();
		$pr_arr['allow_chg']=array();
		$pr_arr['deny']=array();
		$pr_arr['deny_chg']=array();
		foreach($post_arr as $key => $val)
		{
			if($this->check_pr($key) || $this->check_pr_chg($key))
			{
				//echo $key.' ';
				if(array_key_exists($key, $registry->menu_data))
				{
					$pr_arr['allow'][$key]=true;
				}else
				{
					$tmp_arr = explode('_', $key, 2);
					//print_r($tmp_arr);
					if($tmp_arr[0]=='chg' && array_key_exists($tmp_arr[1], $registry->menu_data) )
					{
						$pr_arr['allow_chg'][$key]=true;
					}				
				}
			}
		}
		
		if(count($pr_arr['allow']) == 0)
			$pr_arr['deny']=array_keys($registry->menu_data);
		if(count($pr_arr['allow_chg']) == 0)
			$pr_arr['deny_chg']=array_keys($registry->menu_data);
		
		if(count($pr_arr['allow']) == count($registry->menu_data))
		{
			$pr_arr['allow']=array();
			unset($pr_arr['deny']);
		}
		if(count($pr_arr['allow_chg']) == count($registry->menu_data))
		{
			$pr_arr['allow_chg']=array();
			unset($pr_arr['deny_chg']);
		}
			
		return $pr_arr;
	}
}
?>