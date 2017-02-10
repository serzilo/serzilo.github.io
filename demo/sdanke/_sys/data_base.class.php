<?php

//PDO('mysql:host='.$db_ini['host'].';dbname='.$db_ini['db_name'], $db_ini['login'], $db_ini['pass']);
//class to display the data with the view component
Class data_base {

	private $query;
	private $result;
	private $error;
	
	private $results=array();
	
	private $data = array();

	function __construct($host, $dbname, $login, $pass) 
	{
		if($db = @mysql_connect($host , $login, $pass))
		{
			if(! @mysql_select_db($dbname, $db))
			{
				$err = mysql_errno();
				throw new Exception('Selection failed * |'.$dbname.'| error: $err');
			}
			
			@mysql_query("SET NAMES 'cp1251'");
		}
		else
		{
			$err = mysql_error();
			throw new Exception('Connection fail '. $host.' : '. $login.' - $err ');
		}
	}
	
	function exec($query)
	{
		$this->query=$query;
		$result = mysql_query($query);
		if($result === false)
		{
			//throw new Exception('mysql_error '.$query.' -> '.mysql_error());
			$this->error = mysql_error();
			return false;
		}
		return mysql_affected_rows();
	}
	
	function query($query)
	{
		$this->query=$query;
		$result = mysql_query($query);
		if($result === false)
		{
			//throw new Exception('mysql_error '.$query.' -> '.mysql_error());
			$this->error = mysql_error();
			unset($this->result);
			return false;
		}
		
		if(is_resource($result)) 
		{
			$this->result = $result;
			return mysql_num_rows($result);
		}
		unset($this->result);
		return false;
	}
	
	function get_error()
	{
		return $this->error;
	}
	
	function push_res()
	{
		array_push($this->results, $this->result);
	}
	
	function pop_res()
	{
		if(count($this->results) >0)
			$this->result = array_pop($this->results);
		else
			return false;
		return true;			
	}
	
	function get_result()
	{
		return $this->result;
	}
	
	function get_assoc()
	{
		if(isset($this->result))
			return mysql_fetch_assoc($this->result);
		return false;
	}
	
	function get_assoc_html_decode()
	{
		if(isset($this->result))
		{
			$res =  mysql_fetch_assoc($this->result);
			foreach($res as $key=>$val)
			{
				$res_arr[$key]= htmlspecialchars_decode($res_arr[$key], ENT_QUOTES);
			}
			return $res_arr;
		}
		return false;
	}

	function get_real_strs($arr)
	{
		$res_arr=array();
		foreach($arr as $key=>$val)
		{
			if(!is_array($val))
			{
				$res_arr[$key]= stripslashes($val);
				$res_arr[$key]= str_replace(array('\\',"'"),array('/','`'),$res_arr[$key]);

				$res_arr[$key]= mysql_real_escape_string($res_arr[$key]);
			}
		}
		return $res_arr;
	}
	
	function html_decode($arr)
	{
		$res_arr=array();
		foreach($arr as $key=>$val)
		{
			if(!is_array($val))
			{
				$res_arr[$key]= htmlspecialchars_decode($val, ENT_QUOTES);
			}
		}
		return $res_arr;
	}
	
	function strip_prefix($arr)
	{
		$tmp_arr;
		foreach($arr as $key=>$val)
		{
			$tmp=explode('_', $key,2);
			if(isset($tmp[1]))
				$tmp_arr[$tmp[1]]=$val;
		}
		return $tmp_arr;
	}
	
	function strip_prefix_mult($arr) // strip_prefix from araay af arrays
	{
		$tmp_arr;
		foreach($arr as $key=>$val)
		{
			$tmp_arr[$key]=$this->strip_prefix($val);
		}
		return $tmp_arr;
	}
	
	function quote_smart($value)
	{
		// если magic_quotes_gpc включена - используем stripslashes
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		// Если переменная - число, то экранировать её не нужно
		// если нет - то окружем её кавычками, и экранируем
		if (!is_numeric($value)) {
			$value = "'" . mysql_real_escape_string($value) . "'";
		}
		return $value;
	}
	//------------------------------------------------------------------------------------
	//private functions
}
?>