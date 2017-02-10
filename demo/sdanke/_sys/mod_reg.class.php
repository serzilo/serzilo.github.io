<?php
if(!class_exists('mod_reg')) 
{ 
	class mod_reg
	{ 
		// --------------------- variables
		//data elements 
		private $data=array();	
		private $mods_data;
		private $mods_names;
		private $struc_f_name;
		private $name_file;
		private $last_error='';
		
		// --------------------- method declaration
		
		function register($struc_f_name, $name_file)
		{
			$dirname=site_path.'modules';
			
			$data=array();
			$names=array();

			if(is_dir($dirname) && $handle = opendir($dirname))
			{
				$mod_struc= new file_ini();
				while($name = readdir($handle))
				{	
					$mod_dir=$dirname.DIRSEP.$name;
					if($name!='.' && $name!='..' && is_dir($mod_dir))
					{
						if(is_file($mod_dir.DIRSEP.'mod.ini'))
						{
							$arr=$mod_struc->read($mod_dir.DIRSEP.'mod.ini');
							
							//echo '<br>mod -> '.$arr['name'].' - '.$arr['name_alt'].'  in '.$mod_dir ;
							
							$data[$arr['name']]=$arr;
							$data[$arr['name']]['path']=$mod_dir ;
							$names[$arr['name']]=$arr['name_alt'];
						}
					
					//echo 'dir - ';
					}
					
					//echo $name.'<br>';
				}
			}
			
			if(!is_file($name_file) )
			{
				echo ' name_file - '.$name_file;
				file_put_contents($name_file, '');
			}
			
			
			$f_ini=new file_ini();
			$f_ini->write($name_file, $names);
			
			if(!is_file($struc_f_name))
			{
				file_put_contents($struc_f_name, '');
			}
			$f_ini->write($struc_f_name, $data);
			
			$this->mods_data=$data;
			$this->mods_names=$names;
		}
		
		function install( $name, $struc_f_name='', $name_file='')
		{
			if($struc_f_name=='')
				$struc_f_name=site_path.'modules'.DIRSEP.'modules.ini';
			
			if($name_file=='')
				$name_file=site_path.'modules'.DIRSEP.'names.ini';
		
			$this->register($struc_f_name,$name_file);
			//echo $name.' - ';
			if(!isset($this->mods_data[$name]))
			{
				$name=array_search($name, $this->mods_names);  
			}
			//echo $name.'<br>';
			
			$inc=$this->mods_data[$name]['install'];
			$path=$this->mods_data[$name]['path'].DIRSEP;
			if(is_file($path.$inc))
				include($path.$inc);
			elseif(is_file($path.$inc.'.php'))
				include($path.$inc.'.php');
		}
		
		function get_error()
		{
			return $this->last_error;
		}
	}
}



?>