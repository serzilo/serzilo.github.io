<?php
class registry extends obj
{ 
	// --------------------- variables
	//data elements 
	private $els= array();

	// --------------------- method declaration
	
	public function __set($name, $x)
	{
		$this->els[$name]=$x;
	}
	
	public function set($name, $x)
	{
		$this->els[$name]=$x;
	}
	
	public function __get($name)
	{
		if(isset($this->els[$name]))
			return $this->els[$name];
		else
			return false;
	}
	
	public function merge_arr($x)
	{
		$this->els=array_merge($x, $this->els);
	}
	
	public function add_arr($name, $x)
	{
		$this->els[$name][]=$x;
	}
	
	public function set_arr($name, $key, $x)
	{
		$this->els[$name][$key]=$x;
	}
	
	public function get_arr($name, $key)
	{
		if(isset($this->els[$name]))
			return $this->els[$name][$key];
		else
			return false;
	}
	
	public function get($name)
	{
		if(isset($this->els[$name]))
			return $this->els[$name];
		else
			return false;
	}
	
	function remove($key) 
	{
		unset($this->els[$key]);
	}
	
	function clear($key) 
	{
		if(isset($this->els[$key]))
		{
			$cl=get_class($this->els[$key]);
			unset($this->els[$key]);
			$this->els[$key]=new $cl($this);
		
		}
	}
	
	//public function __toString() 
	//{
	//	return serialize($els);
	//}
}
?>