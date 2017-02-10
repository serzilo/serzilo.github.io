<?
	if(mysql_errno!= 0)
	{
		echo "Select Error " .mysql_error();
		exit;
	}
	if(!$result)
	{
		echo "Fail To SELECT";
		exit;
	}
	
?>