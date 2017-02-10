<?php
class obj
{ 
	// --------------------- variables
	//data elements 
	private $err_nums= array();
	private $errors= array();
	private $error='';
	
	// --------------------- method declaration
	
	function get_last_error()
	{
		return $this->error;
	}
	
	function get_error()
	{
		return $this->error;
	}
	
	function get_errors()
	{
		return $this->errors;
	}
	
	function get_nums()
	{
		return $this->err_nums;
	}
	
	function get_last_num()
	{
		return end($this->err_nums);
	}
	
	function set_error($error, $num=0)
	{
		$this->error = $error;
		$this->errors[] = $error;
		$this->err_nums[] = $num;
	}
	
	function add_error($error, $num=0)
	{
		$this->set_error($error, $num);
	}
	function db_error($error, $num='db')
	{
		$this->set_error($error, $num);
	}

}
?>