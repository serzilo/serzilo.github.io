<?php
define ('DIRSEP', DIRECTORY_SEPARATOR);

// ”знаЄм путь до файлов сайта

$site_path = realpath(dirname(__FILE__) . DIRSEP . '..'. DIRSEP) . DIRSEP;

define ('site_path', $site_path);
//echo site_path;

$host = $_SERVER['SERVER_NAME'];
if(isset($_GET['rt']))
	$slug = str_replace($_GET['rt'],'',$_SERVER['REQUEST_URI']);
else
	$slug = $_SERVER['REQUEST_URI'];

//echo $_SERVER['REQUEST_URI'];

define ('site_host', 'http://'.$host.$slug);

include ('php4_5.php');
?>