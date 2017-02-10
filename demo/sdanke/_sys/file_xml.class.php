<?php
// requires php5
class file_xml
{
	// --------------------- variables
	//data elements 
	private $data;		
	
	// --------------------- method declaration
	
	function set($arr)
	{
		$this->data = $arr;
	}
	function get()
	{
		return $this->data;
	}
	
	function parse_params($str)
	{
		$res=array();
		$tmp_entries = explode(' ',$str);
		foreach($tmp_entries as $val)
		{
			if(!empty($val))
			{
				$tmp=explode('=',$val);
				$res[$tmp[0]]=str_replace(array('"',"'"),array('',''),$tmp[1]);
			}
		}
		return $res;
	}
	
	function read ($filename)
	{
		$xml_parser = xml_parser_create();

		$data = file_get_contents($filename);
		
		//$data = iconv('UTF-8','Windows-1251',$data);
		
		$xml_row_data= explode('<',$data);
		
		$open =array();
		$content=array();
		$index=array();
		$data = array();
		
		foreach($xml_row_data as $key => $val)
		{
			$node_data= explode('>',$val);
			
			$name=explode(' ', $node_data[0],2);
			
			$attribs=$this->parse_params($name[1]);
			
			
			
		}
		
			
		
		xml_parse_into_struct($xml_parser, $data, $vals, $index);
		xml_parser_free($xml_parser);
		
		echo '<pre>';
		print_r($vals);
		print_r($index);
		echo '</pre>';
		

		$params = array();
		$level = array();
		
		
		//Исправление на кириллицу
		//for ($i=0;$i<count($vals);$i++) {
		//if (isset($vals[$i]['value'])) {$vals[$i]['value']=iconv('Windows-1251','Windows-1251',$vals[$i]['value']);}
		//}
		//
				foreach ($vals as $xml_elem) {
		  if ($xml_elem['type'] == 'open') {
			   if (array_key_exists('attributes',$xml_elem)) {
			     list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
			   } else {
				     $level[$xml_elem['level']] = $xml_elem['tag'];
			   }
		  }
		  if ($xml_elem['type'] == 'complete') {
			   $start_level = 1;
			   $php_stmt = '$params';
			   while($start_level < $xml_elem['level']) {
		    		 $php_stmt .= '[$level['.$start_level.']]';
				     $start_level++;
			   }
	 	  $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
		  eval($php_stmt);
		  }

	  }
	  
	return $params;
	}

	function write($path, $assoc_array=array())
	{
		if(!is_array($assoc_array))
		{
			if(is_arra($this->data))
				$assoc_array = $this->data;
			else
				$assoc_array = array();
		}
		
		foreach ($assoc_array as $key => $item) 
		{
			if (is_array($item)) 
			{
				$item_keys= array_keys($item);
				$diff_item=array_diff_key($item, $item_keys);

				//echo sizeof($diff_item);
				
				if(sizeof($diff_item) === 0)
				{
				$content .= '
';
					foreach ($item as  $item2) 
					{
						if(!is_array($item2))
							$content .= $key.'[] = "'.$item2.'"
';
					}
					$content .= '
';
				}else
				{
				
					$content_sec .= "
[$key]
";
					foreach ($item as $key2 => $item2) 
					{
													
						if(is_array($item2))
						{
						$content_sec .= '
';
							foreach ($item2 as  $item3) 
							{
								if(!is_array($item3))
									$content_sec .= $key2.'[] = "'.$item3.'"
';
							}
						$content_sec .= '
';
						}else
							$content_sec .= "$key2 = \"$item2\"
";
					}
					$content_sec .= '
';
				}
			}else
			{
				$content .= "$key = \"$item\"
";
			}
		}
		file_put_contents($path, $content.$content_sec);
	}
	
	public function __toString() 
	{
		return serialize($data);
	}

}
?>