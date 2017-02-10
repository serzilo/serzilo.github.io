<?
function db_select($sel)
{
	global $sql_error;
	global $db_connect;
	
	if($db_connect != true)
	{
		$sql_error = ' Нет соединения с базой ';
		return false;
	}
	
	if(!isset($sel['table']))
	{
		$sql_error = ' Таблица неуказана! ';
		return false;
		
	}
	
	$query = 'SELECT * FROM '.$sel['table'];
	
	if(isset($sel['restriction']) and !empty($sel['restriction']))
	$query .= ' WHERE '.$sel['restriction'];
	
	if(isset($sel['order_by']) and !empty($sel['order_by']))
	$query .= ' ORDER BY '.$sel['order_by'];
	
	if(isset($sel['limit']) and !empty($sel['limit']))
	$query .= ' LIMIT '.$sel['limit'];
	
	$query .=';';
	
	//echo $query;
	
	$result = mysql_query($query);
	
	if($result == false)
	{
		global $sql_error;
		$sql_error = mysql_error();
		return false;
	}
	$sql_error = '';
	return $result;

}

//--------------------------------------------------------------------
function db_insert($table, $ins)
{
	global $sql_error;
	global $db_connect;
	
	if($db_connect != true)
	{
		$sql_error = ' Нет соединения с базой ';
		return false;
	}
	
	if(!isset($table))
	{
		$sql_error = ' Таблица неуказана! ';
		return false;
		
	}
	
	$query = "INSERT INTO $table (";
	
	$tmp ='';
	
	foreach($ins as $el => $val)
	{
		$tmp .= " $val,";
		$query .= " $el,";
	}
	
	$query = substr($query, 0, -1);
	$tmp = substr($tmp, 0, -1);
	$query .= ') VALUES('.$tmp.')';
	
	//echo $query;
	
	$result = mysql_query($query);
	
	if($result == false)
	{
		$sql_error = mysql_error();
		return false;
	}
	$sql_error = '';
	return $result;

}

//----------------------------------------------------------------
function db_update($table, $up, $restrictions)
{
	global $sql_error;
	global $db_connect;
	
	if($db_connect != true)
	{
		$sql_error = ' Нет соединения с базой ';
		return false;
	}
	
	if(!isset($table))
	{
		$sql_error = ' Таблица неуказана! ';
		return false;
		
	}
	
	$query = "UPDATE $table SET ";
	
	$tmp ='';
	
	foreach($ins as $el => $val)
	{
		$tmp .= " $el = '$val',";
		
	}
	
	$tmp = substr($tmp, 0, -1);
	$query .= "$tmp WHERE $restrictions";
	
	
	
	//echo $query;
	
	$result = mysql_query($query);
	
	if($result == false)
	{
		$sql_error = mysql_error();
		return false;
	}
	$sql_error = '';
	return $result;

}
	

?>