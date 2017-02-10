<?php
function __autoload($class_name) 
{
    if(file_exists($class_name.'.class.php'))
		require_once $class_name . '.php';
	elseif(file_exists(site_path.'_sys'.DIRSEP.$class_name.'.class.php'))
		require_once site_path.'_sys'.DIRSEP.$class_name . '.class.php';
	elseif(file_exists(site_path.'controller'.DIRSEP.$class_name.'.class.php'))
		require_once site_path.'controller'.DIRSEP.$class_name . '.class.php';
	elseif(file_exists(site_path.'model'.DIRSEP.$class_name.'.class.php'))
		require_once site_path.'model'.DIRSEP.$class_name . '.class.php';
	elseif(file_exists(site_path.'view'.DIRSEP.$class_name.'.class.php'))
		require_once site_path.'view'.DIRSEP.$class_name . '.class.php';
	elseif(file_exists(site_path.'src'.DIRSEP.$class_name.'.class.php'))
		require_once site_path.'src'.DIRSEP.$class_name . '.class.php';
		
	elseif(file_exists(site_path.'_sys'.DIRSEP.$class_name.'.php'))
		require_once site_path.'_sys'.DIRSEP.$class_name . '.php';
	elseif(file_exists(site_path.'controller'.DIRSEP.$class_name.'.php'))
		require_once site_path.'controller'.DIRSEP.$class_name . '.php';
	elseif(file_exists(site_path.'model'.DIRSEP.$class_name.'.php'))
		require_once site_path.'model'.DIRSEP.$class_name . '.php';
	elseif(file_exists(site_path.'view'.DIRSEP.$class_name.'.php'))
		require_once site_path.'view'.DIRSEP.$class_name . '.php';
	elseif(file_exists(site_path.'src'.DIRSEP.$class_name.'.php'))
		require_once site_path.'src'.DIRSEP.$class_name . '.php';
	
}
?>