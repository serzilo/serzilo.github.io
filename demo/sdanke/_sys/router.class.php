<?php
Class router 
{
	private $registry;
	private $path;
	private $args = array();

	function setPath($path) 
	{
		//$path = trim($path, '/\\');
		$path .= DIRSEP;
		if (is_dir($path) == false) 
		{

				throw new Exception('Invalid controller path: `' . $path . '`');
		}
		$this->path = $path;
	}

	function __construct($registry) 
	{
			$this->registry = $registry;
	}
	
	private function getController(&$file, &$controller, &$action, &$args) 
	{
		$route = (empty($_GET['rt'])) ? 'index' : $_GET['rt'];

		//echo "router -> $route <br>";

		// Получаем раздельные части
		$route = trim($route, '/\\');
		$parts = explode('/', $route);
		
		//print_r($parts);
		
		$index_file='';

		// Находим правильный контроллер
		$cmd_path = $this->path;
		
		foreach ($parts as $part) 
		{
			//echo " part -> $part <br>";
			
			$fullpath = $cmd_path . $part;
			//echo $fullpath.' __<br>';
			// Есть ли папка с таким путём?
			if (is_dir($fullpath)) 
			{
				$cmd_path .= $part . DIRSEP;
				if(is_file($fullpath . DIRSEP . 'index.php'))
				{
					$index_file = $fullpath . DIRSEP . 'index.php';
				}
				array_shift($parts);
				continue;
			}elseif (is_file($fullpath . '.php')) 
			{
				//$index_file = $fullpath .'.php';
				$controller=$part;
				array_shift($parts);
				//$file = $index_file;
			}
		}

		if (empty($controller)) 
		{ 	 
			if(is_file($cmd_path .  'index.php'))
			{
				$file = $cmd_path . 'index.php';
				$controller='index';
			}elseif($index_file !== '')
			{
				$file = $index_file;
				$controller='index';
			}else
			$controller = ''; 
		}else
			$file = $cmd_path . $controller . '.php';

		// Получаем действие
		
		if(!isset($parts[0]) || empty($parts[0])) { $action = 'def';}
			else $action = $parts[0];
		$args = $parts;
		$this->registry->action = $action;
	}
	
	function delegate() 
	{
		// Анализируем путь
		$this->getController($file, $controller, $action, $args);
		//echo ' 1 '.$file.' '.$controller,' '.$action;
		
		
		
		if (is_readable($file) == false) 
		{
			//echo 2;
			require_once ($this->path.'error404.class.php');
			$controller = new error404($this->registry);
			$controller->def($args);
						//die ('404 Not Found');
		}else
		{// Подключаем файл
			require_once ($file);
			//echo 3;
			// Создаём экземпляр контроллера
			$class = 'Cont_' . $controller;
			$this->registry->controller=$controller;
			$controller = new $class($this->registry);
			
			$this->registry->args=$args;
			
			$this->registry->action=$action;
			
			//$this->registry->action=$action;
			

			// Действие доступно?
			if (is_callable(array($controller, $action)) == false) 
			{
					//echo '41 '.$class.' '.$action.' '.$file.' * ';
					$controller->check_action();
					$controller->def($args);
					//echo 4;
			}else	// Выполняем действие
			{
				//echo 51;
				array_shift($args);
				//echo '-'.$action.'-';
				//print_r($args);
				//echo '-'.$action.'-';
				//echo 5;
				$controller->check_action();
				$controller->$action($args);
			}
		}
	}
}
?>