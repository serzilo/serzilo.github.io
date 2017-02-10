<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);

//print_r($_GET);
//echo $_SERVER['HTTP_HOST'];
if(!isset($_GET['rt']))
{
	if(file_exists('index.html'))
		echo file_get_contents('index.html');
	else
		header('Location: ./');
}else
{
	$parts = explode('/', $_GET['rt']);
	if(count($parts)>1)
		header('Location: ../'.$parts[0]);
	if(file_exists($parts[0].'.html'))
		echo file_get_contents($parts[0].'.html');
	else
		header('Location: ./');
}

?>