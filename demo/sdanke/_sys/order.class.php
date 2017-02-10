<?php
if(!class_exists('order')) 
{ 
	class order 
	{ 
		// --------------------- variables
		//data elements 
		private $m= array();		
		private $v= array();
		private $c= array();
		
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
		
		//public function __toString() 
		//{
		//	return serialize($els);
		//}

	}
}
?>