<?php
//class to display the data with the view component
Class template {

	private $registry;
	private $site_path = '';

	private $data = array();

	function __construct($registry, $def='contaner', $path='') 
	{
		$this->registry = $registry;
		$this->data['default_view'] = $def;
		$this->data['extra_path'] = $path;
		$this->check_path();
	}
	
	function get_adm_form($name) //if set echos a adm_form_data variable from session
	{
		if(isset($_SESSION['adm_form_data'][$name])) echo $_SESSION['adm_form_data'][$name];
	}

	public function __set($index, $value) 	//sets a value of the specific index
	{
		$this->data[$index] = $value;
	}
	
	public function __get($index) 			//gets a value of the specific index
	{
		return $this->data[$index];
	}
	
	function set_arr($data)					//sets an arry od values into data
	{
		if(is_array($data))
			$this->data = array_merge_recursive($this->data,$data);
	}
	
	function get_arr()						//sets an arry od values into data
	{
		return $this->data;
	}
	
	function add_arr($data)					//adds an arry od values into data
	{
		if(is_array($data))
			$this->data = array_merge_recursive($this->data,$data);
	}
	
	function set_path($path)
	{
		$this->data['extra_path']=$path;
		$this->check_path();
	}
	
	function check_path()
	{
		if(isset($this->data['extra_path']) && !empty($this->data['extra_path']) && substr($this->data['extra_path'],-1)!==DIRSEP)
		{
			$this->data['extra_path'] .=DIRSEP; 
		}else
			$this->data['extra_path'] =''; 
		
		$this->site_path = site_path.$this->data['extra_path'];
		return $this->site_path;
	}

	function show_any($path)
	{
		if (!is_file($path))
		{
			$path .='.php';
			if(!is_file($path))
			{
				//echo ' path - '.$path.' - ';
				// throw new Exception('Template not found in '. $path, 0);
				$this->registry->last_error='View template not found in '.__FILE__.
				' on line '.__LINE__.' in '. $path;	
				/*if(!is_callable(array($this->registry, 'add_arr')))
				{
					var_dump($this->registry);
					exit;
				}
				//*/
				$this->registry->add_arr('errors',$this->registry->last_error);	
				
				$path = $this->site_path . 'view' . DIRSEP .$this->data['default_view'].'.php';

				if (is_file($path))
				{// Load variables
					foreach ($this->data as $key => $value)
					{
						$$key = $value;
					}
					$registry=$this->registry;
					include ($path);
				}	
				return false;
			}
        }
			//echo ' path _* '.$path. ' *<br>';
        // Load variables
        foreach ($this->data as $key => $value)
        {
			$$key = $value;
        }
		$registry=$this->registry;
		//echo ' path _* '.$path. ' *<br>';
		//echo ' _'.$path.'_ ';
        include ($path);
		return true;
	}
	
	function show($name) 	// include a specified view component with creation of variables from data and 
							// creation a $registry variable. ( $name or $name.'.php')
	{
        $path = site_path . 'view' . DIRSEP .$name;
		$this->show_any($path);
	}
	
	function show_any_novars($path) //includes any file and gets $registry
	{
		if (is_file($path) == false)
        {
            $path .= '.php';
			if(is_file($path) == false )
			{    //throw new Exception('Template not found in '. $path , 1);
				$this->registry->last_error='View template not found in '.__FILE__.
				' on line '.__LINE__.' in '. $path;	
				$this->registry->add_arr('errors',$this->registry->last_error);				
                $path = $this->site_path . 'view' . DIRSEP .$this->data['default_view'].'.php';

				if (is_file($path))
				{
					$registry=$this->registry;
					include ($path);
				}
				return false;
			}
        }
		$registry=$this->registry;
        include ($path);
		return true;
	}
	
	function show_novars($name) // include a specified view component without creation of any variables,
								// but creates a $registry ( $name or $nmae.'.php')
	{
        $path =  $this->site_path . 'view'.DIRSEP.$name;
        $this->show_any_novars($path);
	}

	function out_adm_fields($arr, $options,  $prefix, $delim='-')
	{
		$date = new date_ru();
		foreach($arr as $key => $val)
		{
			if(!empty($options[$prefix.'_'.$val]))
			{
				if(strpos($val, 'DATE') !== false)
				{
					if(strpos($val, 'EDIT') !== false)
					echo '<span id="date_m">'.$date->get_date($options[$prefix.'_'.$val]).'</span>';
					else
					echo '<span id="date_c">'.$date->get_date($options[$prefix.'_'.$val]).'</span>';
					
				}
				elseif(strpos($val, 'NAME') !== false)
				{
					//echo $options['COM_'.$val].' '.$options['COM_NAME'] ;
					if(empty($options[$prefix.'_'.$val]))
						echo '<span id="name">'.$options[$prefix.'_NAME'].'</span>';
					else
						echo '<span id="name">'.$options[$prefix.'_'.$val].'</span>';
					
				}
				elseif(strpos($val, 'CONTACT') !== false)
				{
					
					echo '<span id="coment">'.substr($options[$prefix.'_'.$val],0,100).'</span>';
					
				}
				elseif(strpos($val, 'COMENT') !== false)
				{
					
					echo '<span id="coment">'.substr($options[$prefix.'_'.$val],0,100).'</span>';
					
				}
				else
					echo $options[$prefix.'_'.$val];
				if(next($arr)) echo ' <br/> ';
			}elseif(strpos($val, 'NAME') !== false)
				{
					//echo $options['COM_'.$val].' '.$options['COM_NAME'] ;
					if(empty($options[$prefix.'_'.$val]))
						echo '<span id="name">'.$options[$prefix.'_NAME'].'</span>';
					else
						echo '<span id="name">'.$options[$prefix.'_'.$val].'</span>';
					
				}
		}
	}
}
?>