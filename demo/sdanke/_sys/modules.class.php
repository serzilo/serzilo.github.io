<?php
class modules
{ 
	// --------------------- variables
	//data elements 
	private $mods=array();
	private $registry;
	
	private $data;
	
	private $mod_struc_fname;
	private $mod_name_fname;
	
	// --------------------- method declaration
	
	function __construct($registry) //set module name at start
	{
		if($registry ==false)
		{
			echo 'no registry in modules';
		}
		$this->registry = $registry;
		$this->mod_struc_fname = site_path.'modules'.DIRSEP.'modules.ini';//get modules description
		$this->mod_name_fname = site_path.'modules'.DIRSEP.'names.ini';//get modules names
		
		//echo 'construct from modules';
	}
	
	function load_mod($name)
	{
		if(!isset($this->mods[$name]))
			$this->mods[$name]=new module($this->registry, $name);
		if($this->mods[$name]->is_active())
			return true;
		else
			return false;
	}
	
	function model($name)
	{
		$registry = $this->registry;
		if(!isset($this->mods[$name]))
			$this->mods[$name]=new module($this->registry, $name);
		if($this->mods[$name]->is_active())
		{
			$this->mods[$name]->model();
			return true;
		}
		elseif(is_file(site_path.'model'.DIRSEP.$name))
		{
			require(site_path.'model'.DIRSEP.$name);
			return true;
		}elseif(is_file(site_path.'model'.DIRSEP.$name.'.php'))
		{
			require(site_path.'model'.DIRSEP.$name.'.php');
			return true;
		}		
			return false;
	}
	
	function view($name)
	{
		$registry = $this->registry;
		if(!isset($this->mods[$name]))
			$this->mods[$name]=new module($this->registry, $name);
		if($this->mods[$name]->is_active())
		{
			$this->mods[$name]->view();
			return true;
		}
		elseif(is_file(site_path.'view'.DIRSEP.$name))
		{
			require(site_path.'view'.DIRSEP.$name);
			return true;
		}elseif(is_file(site_path.'view'.DIRSEP.$name.'.php'))
		{
			require(site_path.'view'.DIRSEP.$name.'.php');
			return true;
		}		
			return false;
	}
	
	function cont($name)
	{
		if(!isset($this->mods[$name]))
			$this->mods[$name]=new module($this->registry, $name);
		if($this->mods[$name]->is_active())
		{
			$this->mods[$name]->cont();
			return true;
		}
		else
			return false;
	}
	
	
	public function __get($name)
	{
		if(isset($this->mods[$name]))
			return $this->mods[$name];
		else
		{
			$this->mods[$name]=new module($this->registry, $name);
			if($this->mods[$name]->is_active())
			{
				return $this->mods[$name];
			}else
			{
				return false;
			}
		}
	}
	
	function get_names()
	{
		$dirname=site_path.'modules';
		$mod_struc= new file_ini();
		$arr=$mod_struc->read($dirname.DIRSEP.'modules.ini');
		
		
		return array_keys($arr);
	}
	
	////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////////////////
	
	function register() // registers all modules in dir modules
	{
		mod_reg::register($this->mod_struc_fname, $this->mod_name_fname );
	}
	
	function install()//installes module with name $name
	{
		mod_reg::install($this->name, $this->mod_struc_fname, $this->mod_name_fname );
	}
	
	function get_error()
	{
		return $this->last_error;
	}
	
	function clear_tpl()
	{
		$this->registry->remove('template');
		$this->registry->template= new template($this->registry);
	}
}

?>