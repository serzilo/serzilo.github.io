<?php
// requires php5
class file_ini 
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
	
	function read($f_name, $type=true)
	{
		if(is_file($f_name))
			return $this->data = parse_ini_file($f_name, $type); 
		else
			return false;
	}

	function write($path, $assoc_array=array())
	{
		$space=true;
		if(!is_array($assoc_array))
		{
			if(is_arra($this->data))
				$assoc_array = $this->data;
			else
				$assoc_array = array();
		}
		$content='';
		$content_sec='';
		
		foreach ($assoc_array as $key => $item) 
		{
			if (is_array($item)) 
			{
				$item_keys= array_keys($item);
				$diff_item=array_diff_key($item, $item_keys);

				//echo sizeof($diff_item);
				
				if(sizeof($diff_item) === 0)
				{
					if(!$space)
					{
						$content = '
'; $space=true;
					}
						
					foreach ($item as  $item2) 
					{
						if(!is_array($item2))
							$content .= $key.'[] = "'.$item2.'"
';
					}
					$content = '
'; $space=true;
					
				}else
				{
				
					$content_sec .= "[$key]
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
				$space=false;
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