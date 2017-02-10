<? 
if(!class_exists("dataclass")) 
{ 
class dataclass 
{ 
var $data_base_name= "" ;
var $db;
var $error = "" ;
var $user="";
var $pass="";

function connect($database)
{
	if($database == "")
	{
		$error = "no data base name to connect to";
		return false;
	}	
	$data_base_name=$database;
	
	if($db= @mysql_connect('localhost',$user,$pass))
		$mysql_select_db($db, $data_base_name);
	else
	{
		$error = "error accessing the database named: $data_base_name";
		return false;
	}		
	return $db;
} 
function GetLastError()
{
	return $error;
}

function dataclass()
{}

}
}
?>