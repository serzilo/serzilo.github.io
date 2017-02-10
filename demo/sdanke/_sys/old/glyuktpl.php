<? 
if(!class_exists("glyuktpl")) 
{ 
class glyuktpl 
{ 
	var $replace_to = array("&copy;","&laquo;","&raquo;","&euro;","&sect;","&copy;","&reg;","&deg;","&plusm;",'<h3>','</h3>','<ol>','<li>','</ol>',"</p><p>",'<div align="right" class="nose">',"</div>",'<h3>','</h3>','</p><p>','<b>','</b>');
	var $replace_for =array('©','«','»','ˆ','§','©','®','°','±','[h3]','[/h3]','[u]','[+]','[/u]',"\r\n","[right]","[/right]",'[h3]','[/h3]','\r\n','[b]','[/b]');
	
	var $tpls=array(); //template by whole
	var $ptpls=array(); //parsed templates; 
	var $wtpls=array(); //while templates (blocks, used many times) templates by parts 
	var $wtpls_params=array(); //while templates (blocks, used many times) templates by parts 
	var $wtpls_names=array(); //while templates (blocks, used many times) templates by parts 
	
	
	var $pwtpls=array(); //parsed while templates 
//** 
	function rus_quote($s) { 
		  $s = preg_replace(array("/(^|\s+|\(|\<|\{\[\|)\"/ms", "/\"(\s+|\.|\,|\!|\?|\)|\>|\}|\]|\||$)/ms",),array("\\1&laquo;","&raquo;\\1",), $s); return $s;
	}
	
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
	
	
    //* parts of our template, delimited in content of $delimiter  
	function loadwtpl($tpl,$delimiter="<!--delimiter-->") //load templates by parts, separated by delimiter
	{ 
	    if($result=$this->file2string($tpl)) 
	    { 
	        $parts = explode($delimiter, $result); //split by delimiter 
			$vals = array();
			$params = '';
			
			
			//echo count($parts);
			
			//echo '$parts=';
			//print_r($parts);
			$params = '';
			
			for($i=0; $i<count($parts); $i++)
			{
				$tmp=explode('-->', $parts[$i],2);
				$tmp1=explode('<!--', $parts[$i],2);
				//echo ' $tmp1=';
				//print_r($tmp1);
				
				
				if(count($tmp)==2 && (trim($tmp1[0]) == ''))
				{
					$tpp = explode('<!--', $tmp[0],2);
					
					//echo '$tpp=';
					//print_r($tpp);
					
					if(trim($tpp[0])=='')
					{
						$val_str = $tmp[1];
						$param = $tpp[1];
						$t_name = explode('name=', $tmp[0],2);
						
						//echo '$t_name=';
						//print_r($t_name);
						
						if(count($t_name) == 2)
						{
							$st_name = explode('&', $t_name[1],2);
							
							//echo '$st_name=';
							//print_r($st_name);
														
							if(strpos( trim($st_name[0]), '"' ) === 0)
								$key = substr($st_name[0], 1, -1);
							else
								$key = $st_name[0];
								
							//echo "  _key=$key_ ";
								
						
						}else
						$key = $i;
					}else
					{
					$key = $i;
					$val_str = $tmp[0];
					}
				}else
				{
					$key = $i;
					$val_str = $parts[$i];
				}
				
				$vals[$key]= $val_str;
				$params[$key] = $param;
				$names[$i] = $key;
				
			 }

			$this->wtpls[$tpl]=$vals; 
			$this->wtpls_params[$tpl] = $params;
			$this->wtpls_names[$tpl] = $names;
			
	        return true; 
	    } 
	    return false; 
	} 
	
	
	function wparse($rarray,$tpl,$n,$quots) //
	{ 
	    if(!isset($this->wtpls[$tpl][$n]) or !is_array($rarray)) return false; 
	    //** 
	    $tpltxt/*template text*/=$this->wtpls[$tpl][$n]; 
	    //*do replacements* 
	    foreach($rarray as $key=>$value) 
	    {
	        if ($quots=="true"){
                $value = $this->rus_quote($value);
	            $a=chr(169);
	            $value = str_replace($this->replace_for,$this->replace_to,$value);
	            $value = str_replace("<br><br>","</p><p>",$value);
	        }
	        $value = preg_replace("#\[link=([^]]+)\]((?:(?!\[/link]).)+)\[/link]#",'<a href=\\1>\\2</a>',$value);
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
	function getwparsedtext($tpl,$n) 
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
	
	/*
	function fastparse($tpl,$parse_array=0,$cashe = true,$echo=true) 
	{ 
	if(!isset($this->tpls[$tpl])) $this->loadtpl($tpl); 
	$rarray = array();
		if($cashe) {
		 $url=$GLOBALS['REQUEST_URI'];
		 $crc=md5($url);
		 $modif=time() - @filemtime ("cashe/$crc");
		 if (is_array($parse_array)) $rarray =$parse_array; else return false;
			$this->parse($rarray,$tpl); 
			if ($modif>600 || !file_exists("cashe/$crc")) { 
			  if($echo) { 
			  ob_start ();
			  echo $this->getparsedtext($tpl);
			  $cach = ob_get_contents();
			  ob_end_clean ();
			  echo $cach;
			  $fp = @fopen ("cashe/$crc", "w");
		   	  @fwrite ($fp, $cach);
			  @fclose ($fp); 
			  }else return $this->getparsedtext($tpl); 
			exit();	} else {
			echo $this->file2string("cashe/$crc");
			exit();
	       }
		   
		} else {
			if (is_array($parse_array)) $rarray =$parse_array;  else return false;
			$this->parse($rarray,$tpl); 
			echo $this->getparsedtext($tpl);
			} 
	}
	//*/
	//** 
	function fastwparse($tpl,$parse_array,$num=0,$quots=false,$echo=true) 
	{ 
        // add to templates mass our template if it haven't existed
	    if(!isset($this->wtpls[$tpl])) 
			if($this->loadwtpl($tpl) ===false)
				return false;
         
	    if (is_array($parse_array)) $rarray = $parse_array;
	    else return false;
        
	    $this->wparse($rarray,$tpl,$num,$quots); 
        
	    if($echo) echo $this->getwparsedtext($tpl,$num); 
	    else return $this->getwparsedtext($tpl,$num); 
		return true;
	}
	
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
	function get_names()
	{
		return $this->wtpls_names;
	}

	}
}
?>