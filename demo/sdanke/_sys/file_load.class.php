<?php
// requires php5
class file_load extends obj
{
	// --------------------- variables
	
	private $alowed_ext=array('jpg','png','gif','jpeg','doc','xls','odt','zip','rar','7z');
	
	// --------------------- method declaration
	
	function __construct() 
	{
		//if(!defined(''/'')) define (''/'', DIRECTORY_SEPARATOR);
	}
	function c_u_folder($path)	//creates a unique directory in $path
	{
		if(!file_exists($path)) //if no path (dir)
		{
			if(!mkdir($path))
			{
				$this-> set_error(0,'Wrong dir name or cannot create directory to store files! '.$path.' from c_u_folder'.'<br>'); 
				return false;
			}
			chmod($path, 0777);
		}
		$dir=$path;
		if(substr($path,-1) != DIRSEP) // if no '/' in path
		{
			$dir .=DIRSEP;
		}
		$structure=substr(md5(time()),0,10);	//name length
		if(file_exists($dir.$structure))		//name is not uniq
		{
			$i=0;
			while(file_exists($dir.$structure.$i)){$i++;} //while not found uniq name
			$structure .=$i;
		}
		if(!mkdir($dir.$structure)) // create directory
		{
			return false;
		}
		chmod($dir.$structure, 0777);
		return $structure;	//return the directory name
	}

	function c_u_file($path,  $extention='tmp', $create=true, $chmod=0777) //finds or creates a unique file with $extention in $path with chmod
	{
		if(!file_exists($path)) //if no path (dir)
		{
			if(!mkdir($path))
			{
				$this-> set_error(0,'Wrong dir name or cannot create directory to store files! '.$path.' from c_u_file'.'<br>'); 
				return false;
			}
			chmod($path, 0777);
		}
		$dir=$path;
		if(substr($path,-1) != DIRSEP) // if no '/' in path
		{
			$dir .=DIRSEP;
		}
		
		$ext=$extention;
		if(substr($ext, 0, 1) != '.') // if no '.' in extention
		{
			$ext ='.'.$ext;
		}
		$structure=substr(md5(time()),0,10);	//name length
		if(file_exists($dir.$structure.$ext))		//name is not uniq
		{
			$i=0;
			while(file_exists($dir.$structure.$i.$ext)){$i++;} //while not found uniq name
			
			$structure .=$i;
		}
		if($create)		//if needed to create file
		{
			$fh=fopen($dir.$structure.$ext, 'w'); // create file
			if(!$fh) 
			{
				return false;
			}
			fclose($fh);
			chmod($dir.$structure.$ext, $chmod);
		}
		return $structure.$ext;	//return the file name
	}
	
	function c_name_file($path,  $name='tmp.tmp', $create=true, $chmod=0777) //finds or creates a unique file with $extention in $path with chmod
	{
		if(!file_exists($path)) //if no path (dir)
		{
			if(!mkdir($path))
			{
				$this-> set_error(0,'Wrong dir name or cannot create directory to store files! '.$path.' from c_name_file'.'<br>'); 
				return false;
			}
			chmod($path, 0777);
		}
		$dir=$path;
		if(substr($path,-1) != DIRSEP) // if no '/' in path
		{
			$dir .=DIRSEP;
		}
		
		if(!file_exists($dir.$name))
		{
			$ffile=$$dir.$name;
		}else
		{
			$structure=substr(md5(time()),0,5);	//name length
			$ext ='.'.end(explode('.',$name));
			$name = $structure.substr($name, 0, -(strlen($ext)));
			
			if(file_exists($dir.$name.$ext))		//name is not uniq
			{
				$i=0;
				while(file_exists($dir.$name.$i.$ext)){$i++;} //while not found uniq name
				$name .=$i;
			}
		}
		
		if($create)		//if needed to create file
		{
			$fh=fopen($dir.$name.$ext, 'w'); // create file
			if(!$fh) 
			{
				return false;
			}
			fclose($fh);
			chmod($dir.$name.$ext, $chmod);
		}
		return $name.$ext;	//return the file name
	}

	// $file could be a file path or a name of uploaded file $_FILES[$file] 
	function load($file, $dir, $create_dir=false) //loads file into dir, if extra dir needed to be created its created
	{
		if(!file_exists($dir)) //if no path (dir)
		{
			if(!mkdir($dir))
			{
				$this-> set_error(0,'Wrong dir name or cannot create directory to store files!'.$path.' from load'.'<br>'); 
				return false;
			}
			chmod($dir, 0777);
		}	
		$ftext=new base_text(); // cleate a basic text modifier 
		if(is_file($file)) // if it is a file
		{ 
			$fname = end(explode(DIRSEP,$file));
			$tmpname = $file;
		}elseif(isset($_FILES[$file]) && $_FILES[$file]['error']==0 ) // if it is an uploaded file
		{
			$tmpname = $_FILES[$file]['tmp_name'];
			$fname = $ftext->rus_translit($_FILES[$file]['name']);
		}else 
		{
			print_r($_FILES);
			$this-> set_error(0,'Wrong file name, uploaded files present or error during upload! '.$file.'<br>');
			return false;
		}
		
		$ext=strtolower(end(explode('.',$fname)));
		if(!in_array($ext, $this->alowed_ext))
			{$this-> set_error(0,'Wrong file extention! ext -> '.$ext); return false;}
		
		$path=$dir;
		if(substr($path,-1) != DIRSEP) // if no '/' in path
		{
			$path .=DIRSEP;
		}
		//echo 'path '.$path;
			
		if($create_dir)
		{
			if(!$tmp=$this->c_u_folder($path))
			{
				//$this-> set_error(0,'Error in c_!'); 
				return false;
			}
			$path .=$tmp.'/';
		}
		
		$end_file=$path.$fname;
		
		//echo ' end_file '.$end_file;
		
		if(file_exists($end_file))
		{
			if(!$tmp=$this->c_name_file($path, $fname))
			{
				//$this-> set_error(0,'Wrong dir name or cannot create directory to store files!'); 
				return false;
			}
			$end_file = $path.$tmp;
			$ffile = $tmp;
		}else
			$ffile = $fname;
			
		//echo ' |'.$tmpname.' - '.$end_file.'| ';
		
		if(!copy($tmpname, $end_file))
		{
			$this-> set_error(0,'Error while copying file "'.$tmpname.'" to "'.$file.'<br>'); 
			return false;
		}
		return $ffile;
	}
}
?>