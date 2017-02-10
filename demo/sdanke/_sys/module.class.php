<?php
class module
{ 
	// --------------------- variables
	//data elements 
	private $register;
	private $order;
	
	private $data=false;
	private $name;
	private $name_alt='';
	
	private $last_error='';
	
	private $mod_struc_fname;
	private $mod_name_fname;
		
	// --------------------- method declaration
	
	function __construct($registry, $name=false, $order=false) //set module name at start
	{
		$this->mod_struc_fname = site_path.'modules'.DIRSEP.'modules.ini';//get modules description
		$this->mod_name_fname = site_path.'modules'.DIRSEP.'names.ini';//get modules names
		if($registry ==false)
		{
			echo 'no registry in module';
			exit;
		}
		$this->registry = $registry;
		$this->order = $order;
		$this->name=$name;
		
		if(!isset($this->registry->template))
			$this->registry->template=new template($registry);
		//var_dump($name);
		//echo ' construct from module  <br> ';
		
		
		$this->load_mod($name);
		
		
		//echo $this->mod_struc_fname .'  - '.$this->mod_name_fname ;
			
	}
	
	function load_mod($name)
	{
		if($name != false) // if needs to load the module
		{
			//echo 'name';
			//var_dump($name);
			//echo ' ** '.$this->mod_struc_fname .'  - '.$this->mod_name_fname ;
			//echo 'name - '.$name;
			
			$f_ini = new file_ini();
			$mods_data = $f_ini->read($this->mod_struc_fname);// read structure
			
			//print_r($mods_data);
			//echo $name.' - ';
			
			if(!is_array($mods_data) || !isset($mods_data[$name]))   //if there are no such module name
			{
				$mods_names = $f_ini->read($this->mod_name_fname);
				if(!$mods_names) 
				{
					echo $this->mod_name_fname;
					$this->registry->last_error='No module name file found in '.__FILE__.
				' on line '.__LINE__.' in '.$this->mod_name_fname;
					$this->registry->add_arr('errors',$this->registry->last_error);	
				
				}
				else
					$name = array_search($name, $mods_names); 
			}
			if(is_array($mods_data) && isset($mods_data[$name])) // if there is such module 
			{
				$this->data = $mods_data[$name];
				$this->name=$name;
				$this->name_alt=$mods_data[$name]['name_alt'];
			}else // no such module
			{
				$this->last_error='No such module';
				$this->name=false;
				$this->name_alt=false;
				$this->data=false;
				$this->registry->last_error='No module with name '.$name.' found  at '.__FILE__.
				' on line '.__LINE__;
				$this->registry->add_arr('errors',$this->registry->last_error);	
			}
		}
	}
	
	function is_active() // if the te is a module active
	{
		if(!$this->name)
			return false;
		else
			return true;
	}
	
	function get_params()
	{
		echo $this->last_error.' * <br>';
		echo $this->name.' * <br>';
		echo $this->name_alt.' * <br>';
	}
	
	
	function set_registry($registry) 
	{
		$this->registry = $registry;
	}	
	
	function set_order($order) 
	{
		$this->order = $order;
	}	
	
	
	
	function model()
	{
		//echo 'model '.$this->name;
		$inc = $this->data['path'].DIRSEP.$this->data['model'];
		$this->registry->template->show_any_novars($inc);
	}
	
	function view()
	{
		$inc = $this->data['path'].DIRSEP.$this->data['view'];
		$this->registry->template->show_any($inc);
	}
	
	function cont()
	{
		$inc = $this->data['path'].DIRSEP.$this->data['cont'];
		$this->registry->template->show_any($inc);
	}
	
	function adm_model()
	{
		$registry = $this->registry;
		include($this->data['path'].DIRSEP.$this->data['adm_model']);
	}
	
	function adm_view()
	{
		$registry = $this->registry;
		include($this->data['path'].DIRSEP.$this->data['adm_view']);
	}
	
	function adm_model_list()
	{
		$registry = $this->registry;
		include($this->data['path'].DIRSEP.$this->data['adm_model_list']);
	}
	
	function adm_model_add()
	{
		$registry = $this->registry;
		include($this->data['path'].DIRSEP.$this->data['adm_model_add']);
	}
	function adm_model_del()
	{
		$registry = $this->registry;
		include($this->data['path'].DIRSEP.$this->data['adm_model_del']);
	}
	function adm_model_chg()
	{
		$registry = $this->registry;
		include($this->data['path'].DIRSEP.$this->data['adm_model_chg']);
	}
	
	function adm_view_list()
	{
		$inc = $this->data['path'].DIRSEP.$this->data['adm_view_list'];
		$this->registry->template->show_any_novars($inc);
	}
	
	function adm_view_add()
	{
		$inc = $this->data['path'].DIRSEP.$this->data['adm_view_add'];
		$this->registry->template->show_any_novars($inc);
	}
	function adm_view_chg()
	{
		$inc = $this->data['path'].DIRSEP.$this->data['adm_view_chg'];
		$this->registry->template->show_any_novars($inc);
	}
	
	function adm_cont()
	{
		$inc = $this->data['path'].DIRSEP.$this->data['adm_cont'];
		$this->registry->template->show_any($inc);
	}
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
}

?>