<?php

function c_u_folder($path)	//creates a unique directory in $path
{
	if(!file_exists($path)) //if no path (dir)
	{
		mkdir($path);
		chmod($path, 0777);
	}
	
	$dir=$path;
	if(substr($path,-1) != '/') // if no '/' in path
	{
		$dir .='/';
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

function c_u_file($path, $extention='tmp', $create=true, $chmod=0777) //finds or creates a unique file with $extention in $path with chmod
{
	if(!file_exists($path)) //if no path (dir)
	{
		mkdir($path);
		chmod($path, 0777);
	}
	$dir=$path;
	if(substr($path,-1) != '/') // if no '/' in path
	{
		$dir .='/';
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

?>