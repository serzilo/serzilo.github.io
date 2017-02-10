<? 
/*		tpl_cls ver 0.1
	*	separates a template into parts and replases the words inside {}
	*
	*
	//*/
	
if(!class_exists("tpl_cls")) 
{ 
class tpl_cls
{ 
	var $tpls=array(); //template by whole
	var $ptpls=array(); //parsed templates; 
	
	var $wtpls=array(); //while templates (blocks, used many times) templates by parts 
	var $wtpls_params=array(); //while templates (blocks, used many times) templates by parts 
	var $wtpls_names=array(); //while templates (blocks, used many times) templates by parts 
	var $pwtpls=array(); //parsed while templates 
	//** 
	
	
	//**/
	function file2string($file) //$file -name of the file to load the text from 
	{ 
		if(file_exists($file) && is_readable($file)) 
	    { 
		    return file_get_contents($file); 
	    }else 
	    { 
		    return false; 
	    } 
	} 
	//** 
	function loadtpl($tpl) //$tpl -name of the template
	{ 
		if($result=$this->file2string($tpl)) 
		{ 
		$this->tpls[$tpl]=$result; 
		return true; 
		} 
		return false; 
	} 
	//** 
	function parse($rarray,$tpl) // $rarray - array for change; $tpl - name of the template 
	{ 
		if(!isset($this->tpls[$tpl]) or !is_array($rarray)) return false; 
		//** 
		$tpltxt/*template text*/=$this->tpls[$tpl]; 
		//** 
		//foreach($rarray as $key=>$value) 
		//{ 
		$value=array_values($rarray);
		$keys=array_keys($rarray);
		for($i=0;$i<count($keys) ; $i++) $keys[$i] ='{'.$keys[$i].'}';  
	
		$tpltxt=str_replace($keys, $value, $tpltxt); 
		
		//} 
		//** 
		$this->ptpls[$tpl]=$tpltxt; 
		
		return true; 
	} 
	//** 
	function getparsedtext($tpl) //Get the array of parts of template
	{ 
		if(!isset($this->ptpls[$tpl])) return false; 
		//** 
		return $this->ptpls[$tpl]; 
	} 
    //* parts of our template, delimited in content -> into 
	function loadwtpl($tpl,$delimiter="<!--delimiter-->") //load templates by parts, separated by delimiter
	{ 
	    if($result=$this->file2string($tpl)) 
	    { 
	        $parts = explode($delimiter, $result); //split by delimiter 
			$vals = array();
			//$params = '';
		
			echo '<pre>';
			
			//echo '$parts=';
			//print_r($parts);
			
			$count=sizeof($parts);
			
			$p_num=0;
			
			for($i=0; $i<$count; $i++)
			{
				$tmp=explode('-->', $parts[$i],2);   //if there is a params in the part
				$tmp1=explode('<!--', $tmp[0],2); //if there is somthing before coment 
				//echo ' $tmp1=';
				//print_r($tmp1);
				
				
				$param = array();			
				if(sizeof($tmp)==2 && (trim($tmp1[0]) == '')) //if coment is a parameter data
				{
					$val_str = $tmp[1];
					
					$name=$p_num++;
					$t_args=explode('|',$tmp1[1]);
					
					//print_r($t_args);
					
					$par_c = sizeof($t_args);
					
					for($j=0; $j<$par_c; $j++)
					{
						$st_name = explode('=', $t_args[$j],2);
						if($st_name[0]!=='' && sizeof($st_name)==2)
						{
							$param[$st_name[0]]=$st_name[1];
							if($st_name[0]=='name')
							{
								$name=$st_name[1];
								$p_num--;
							}
						}
					}
					//print_r($param);
					$key=$name;
				}else
				{
					$val_str = $parts[$i];
					$key=$p_num++;
				}
				//print_r($param);
				
				$vals[$key]= $val_str;
				$params[$key] = $param;
				$names[$i] = $name;
				
			 }

			$this->wtpls[$tpl]=$vals; 
			$this->wtpls_params[$tpl] = $params;
			$this->wtpls_names[$tpl] = $names;
			echo '</pre>';
			
	        return true; 
	    } 
	    return false; 
	} 
	//** 
	function wparse($rarray,$tpl,$n) //replaces the key by the values in the n_th part
	{ 
	    if(!isset($this->wtpls[$tpl][$n]))
		{
			if(isset($this->wtpls[$tpl][$this->wtpls_names[$tpl][$n]]))
				$tpltxt=$this->wtpls[$tpl][$this->wtpls_names[$tpl][$n]]; /*template text*/
			else return false;
			//echo '<hr><br>'.$this->wtpls_names[$tpl][$n].'<br>'.$tpltxt.'<hr>';
		
		}else
		$tpltxt=$this->wtpls[$tpl][$n]; /*template text*/
	    
	    
	    //*do replacements* 
	    if(is_array($rarray))
			foreach($rarray as $key=>$value) 
			{
				if(!is_array($value))
				$tpltxt=str_replace('{'.$key.'}', $value, $tpltxt); 
			}

	    //** 
	    $this->pwtpls[$tpl][$n]=$tpltxt; 
	    return true; 
	} 
	//** 
	function wparseall($rarray,$tpl) // $rarray - array for change; $tpl - name of the template 
	{ 
		if(!isset($this->wtpls[$tpl]) or !is_array($rarray)) return false; 
		//** 
		foreach($rarray as $key=>$value) 
		{ 
			$this->wtpls[$tpl]=str_replace('{'.$key.'}', $value, $this->wtpls[$tpl]); 
		} 
		//** 
		return true; 
	} 
	//** 
	function getwparsedtext($tpl,$n) //gets the n_th part of the template
	{ 
	    if(!isset($this->pwtpls[$tpl][$n])) return false; 
	//** 
	    return $this->pwtpls[$tpl][$n]; 
	} 
	//**
	function get_cache_life_time($path_to_file)
	{
		$x=(time()-filectime($path_to_file));
		$a=(700)-$b;
		$b=(700);
		$c=(10);
		return round((-($a/($c*$x+1))+$b+$a));
	}
	//** 
	function fastwparse($tpl,$parse_array=array(),$num=0) 
	{ 
        // add to templates mass our template if it haven't existed
	    if(!isset($this->wtpls[$tpl])) 
			if($this->loadwtpl($tpl) ===false)
			{	
				echo 'Fail to load '.$tpl;//////////////////////////////////////////////////////////////////
				return false;
			}
         
	    if (is_array($parse_array)) $rarray = $parse_array;
	    else $rarray=array();
        
	    $this->wparse($rarray,$tpl,$num); 
        
	    echo $this->getwparsedtext($tpl,$num); 
	    
		return true;
	}
	//** 
	function fastparse($tpl,$parse_array=array()) 
	{ 
        // add to templates mass our template if it haven't existed
	    if(!isset($this->tpls[$tpl])) 
			if($this->loadtpl($tpl) ===false)
			{	
				echo 'Fail to load '.$tpl;//////////////////////////////////////////////////////////////////
				return false;
			}
         
	    if (is_array($parse_array)) $rarray = $parse_array;
	    else $rarray=array();
        
	    $this->parse($rarray,$tpl); 
        
	    echo $this->getparsedtext($tpl); 
	    
		return true;
	}
	//** 
	function show_arrs()
	{	
		echo '<pre>';
		echo 'wtpls=';
		print_r($this->wtpls);
		echo 'wtpls_params=';
		print_r($this->wtpls_params);
		echo 'wtpls_names=';
		print_r($this->wtpls_names);
		echo 'pwtpls=';
		print_r($this->pwtpls);
		echo '</pre>';
	}
	//** 	
	function __get($name)
	{
		if(isset($this->tpls[$name]))
			return $this->tpls[$name];
		elseif(isset($this->wtpls[$name]))
			return $this->wtpls[$name];
		else
			return false;
	}
	//** 	
	function get_names($name)
	{
		if(isset($this->wtpls_names[$name]))
			return $this->wtpls_names[$name];
		else
			return $this->wtpls_names;
	}
	//** 	
	function get_params($name)
	{
		if(isset($this->wtpls_params[$name]))
			return $this->wtpls_params[$name];
		else
			return $this->wtpls_params;
	}
}
}
?>