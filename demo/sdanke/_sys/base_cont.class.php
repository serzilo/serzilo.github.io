<?php

Abstract Class base_cont 
{
	/*
	 * @registry object
	 */
	protected $registry;
	protected $site_path;
	protected $data=array();
	
	function __construct($registry) 
	{
		$this->registry = $registry;
		$registry->template= new template($registry);
		$registry->modules= new modules($registry);
		$this->site_path=site_path;
		$registry->cont_class=$this;
	}
	
	function goto_mess($name, $text)
	{
		$_SESSION['mess_name']=$name;
		$_SESSION['mess_text']=$text;
		session_write_close();
		Header('Location: '.site_host.'mess');
		exit;
	}
	
	function goto_error($name, $text, $log_name='common_log.txt')
	{
		$this->registry->log->log($log_name, ' : '.$name.' - '.$text.'
');
		$_SESSION['mess_name']=$name;
		$_SESSION['mess_text']=$text;
		session_write_close();
		Header('Location: '.site_host.'error');
		//Header('Location: /error');
		exit;
	}
	
	function start() // starts the page
	{
		$registry = $this->registry;
		$this->registry->template->show_any($this->site_path.'struc_src'.DIRSEP.'_start_model.php');
	}
	
	function start_view() // starts the page
	{
		$registry = $this->registry;
		$this->registry->template->show_any($this->site_path.'struc_src'.DIRSEP.'_start_view.php');
	}
	
	function end() // ends the page
	{
		$registry = $this->registry;
		include($this->site_path.'struc_src'.DIRSEP.'_end.php');
	}
	
	function check_action()
	{}
	
	
	function set_ini($dir_path)
	{
		$path=realpath(dirname($dir_path) . DIRSEP) . DIRSEP;
		$file = basename($dir_path, ".php"); 
		if(file_exists($path.$file.'.ini')) 
		{
			$ini=parse_ini_file($path.$file.'.ini', true);
			
			if(is_array($ini))
				$this->set_data($ini);
		}
		$this->path=$path;
		$this->name=$file;
	}

	/**
	 * @all controllers must contain a def (default) method
	 */
	abstract function def($args);
	function __get($name)
	{
		if(isset($this->data[$name]))
			return $this->data[$name];
		else
			return false;
	}
	
	protected function set($name, $x)
	{
		$this->data[$name]=$x;
	}
	
	protected function set_data($data_arr) // adds the array of arguments with overwriting the same args
	{
		if(is_array($data_arr))
			$this->data=array_merge_recursive($this->data,$data_arr);
			
	}
	
	protected function __set($name, $x)
	{
		$this->data[$name]=$x;
	}
	
	function find_num()
	{
		$i=0;
		$args=$this->registry->args;
		$count=count($args);
		if($count>0)
		{
			while($i<$count && !is_numeric($args[$i]) ) $i++;
			if($i<$count)
				return $args[$i];
		}
		return false;
	}
	
	function find_arg($name)
	{
		$i=0;
		$args=$this->registry->args;
		$count=count($args);
		if($count>0)
		{	
			while($i<$count && $args[$i]!= $name ) $i++;
			
			if($i<$count && isset($args[$i+1]))
				return $args[$i+1];
		}
		return false;
	}
	
	
	function find_ref($name, $def=0)
	{
		$this->find_ref_arg($name, $def);
	}
	
	function find_ref_arg($name, $def=0)
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$i=0;
			$args=explode('/',$_SERVER['HTTP_REFERER']);
			$count=count($args);
			
			if($count>0)
			{
				while($args[$i]!= $name && $i<$count) $i++;
				if($i<$count && isset($args[$i+1]))
					return $args[$i+1];
				elseif($i<$count)
					return $def;
			}
		}
		return false;
	}
	
	function get_ref()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			return $_SERVER['HTTP_REFERER'];
		}
		return false;
	}
	
}

?>