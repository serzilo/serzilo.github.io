<?php
// requires php5
class file_graphics extends file_load
{
	// --------------------- variables
	
	private $src;
	private $type;
	
	// --------------------- method declaration
	
	function __construct() 
	{
		//if(!defined(''/'')) define (''/'', DIRECTORY_SEPARATOR);
	}

	private function LoadSrcImage($filename )
	//loads a web graphic file jpg(jpeg), gif or png into class variable
	{ 
		//echo $filename;
		
		$this->type = getimagesize($filename);
		switch ($this->type[2])
		{
			case IMAGETYPE_GIF:
				$this->src = @imagecreatefromgif($filename);
				break;
			case IMAGETYPE_JPEG:
				$this->src = @imagecreatefromjpeg($filename);
				break;
			case IMAGETYPE_PNG:
				$this->src = @imagecreatefrompng($filename);
				break;
			 default:
				$this->set_error(0, 'Проблемы с чтением file - '.$filename) ;
				return false;
		}
		return true;
	}  	
	
	private function LoadImage($filename, $targetfilename, $quality=100 )
	//loads a web graphic file jpg(jpeg), gif or png into class variable
	{ 
		if($this->LoadSrcImage($filename))
			return imagejpeg($this->src, $targetfilename, $quality); 
		imagedestroy($this->src);
		return false;
	}  	
	
	function extractImage($filename, $targetfilename, $x, $y, $sw, $sh, $dw, $dh, $quality=100 )
	//extracts a part of an image of size $sw $sh from $x $y convert it to size of $dw %dh by cutting 
	// and leaving the largest area
	{ 
		if($this->LoadSrcImage($filename))
		{
			$dest = imagecreatetruecolor($sw, $sh) or die('problem with new GD image stream'); 
			//imagecopy($dest, $src, 0, 0, 20, 13, 80, 40);
			if(!imagecopy($dest, $this->src,  0, 0, $x, $y, $sw, $sh))
			{
				$this->set_error(0, 'Проблемы с измененим размера file - '.$filename) ;
				return false;
			}			
			imagejpeg($dest, $targetfilename, 100); 
			
			return $this->cutImage($targetfilename, $targetfilename, $dw, $dh, $quality );
		}
		imagedestroy($this->src);
		return false;
		//echo "w=$w sw=$sw h=$h sh=$sh sc=$sc $sx $sy  delta =$delta<br> ";
	}  


	//------------------------------
	function cutImage($filename, $targetfilename, $dw, $dh, $quality=100)
	//cuts an image by taking out of the image the largest area of propotions defined by $dw $dh
	{ 
		if($this->LoadSrcImage($filename))
		{
			$w      = imagesx($this->src); 
			$h      = imagesy($this->src); 
			$sc     = $dw/$dh; 
			
			if($h==0 || $w==0)
			return false;
			
			if($w/$h >$sc)
			{
				//echo "w=$w h=$h sc=$sc ";
				$tw = $sc*$h;
				$delta = floor(($w-$tw)/2);
				$sx=$delta;			$sy=0;
				$sw=$tw;			$sh=$h;
			}elseif($w/$h < $sc)
			{
				//echo "w=$w h=$h sc=$sc ";
				$th = $w/$sc;
				$delta = floor(($h-$th)/2);
				$sx=0;			$sy=$delta;
				$sw=$w;			$sh=$th;
			}else
			{
				$sx=0;			$sy=0;
				$sw=$w;			$sh=$h;
			}
			
			//echo "w=$w sw=$sw h=$h sh=$sh sc=$sc $sx $sy  delta =$delta<br> ";
			
			$dest = imagecreatetruecolor($dw, $dh) or die('problem with new GD image stream'); 
			
			if(!imagecopyresampled($dest, $this->src, 0, 0, $sx, $sy, $dw, $dh, $sw, $sh))
			{
				$this->set_error(0, 'Проблемы с измененим размера file - '.$filename );
				return false;
			}			
			return imagejpeg($dest, $targetfilename, $quality); 
		}
			imagedestroy($this->src);
			return false;
	}  

	function resizeImage($filename, $targetfilename, $targetw, $targeth,  $quality=100)
	//resize image to given dimentions (image will fit into given box)
	{ 
		if($this->LoadSrcImage($filename))
		{
			$w      = imagesx($this->src); 
			$h      = imagesy($this->src); 
			$sc     = 1.0; 
			if ($w > 0)
			{ 
				$sc = ((float)$targetw)/$w; 
			} 
			//echo " w=$w h=$h  tw=$targetw  th=$targeth  sc=$sc <br />";
			
			if (($targeth < $h*$sc) && $h>0)
			{ 
				$sc = ((float)$targeth)/$h; 
			}    
			$neww=(int)($w*$sc);
			$newh=(int)($h*$sc);
			
			//echo " nw=$neww nh=$newh  sc=$sc  <br />";
			
			$dest = @imagecreatetruecolor($neww, $newh) or die('problem with new GD image stream'); 
			if(!imagecopyresampled($dest, $this->src, 0, 0, 0, 0, $neww, $newh, $w, $h))
			return false; 
		   
			return imagejpeg($dest, $targetfilename, $quality); 
		}
			imagedestroy($this->src);
			return false;
	   
	}  

	function resizeImage_bySide($filename, $targetfilename, $targetw, $targeth,  $quality=100, $side=0)
	//resizes image by on side $side =0 - height  else width
	{ 
		if($this->LoadSrcImage($filename))
		{
			$w      = imagesx($this->src); 
			$h      = imagesy($this->src); 
			$sc     = 1.0; 
			
			if ($side !=0 && $w > 0)  // resize by width
			{ 
				$sc = ((float)$targetw)/$w; 
			}elseif ($side ==0 && $h>0)   //resize by height
			{ 
				$sc = ((float)$targeth)/$h; 
			}    
			$neww=(int)($w*$sc);
			$newh=(int)($h*$sc);
			
			//echo " nw=$neww nh=$newh  sc=$sc  <br />";
			
			$dest = @imagecreatetruecolor($neww, $newh) or die('problem with new GD image stream'); 
			if(!imagecopyresampled($dest, $this->src, 0, 0, 0, 0, $neww, $newh, $w, $h))
			return false; 
		   
			return imagejpeg($dest, $targetfilename, $quality); 
		}
			imagedestroy($this->src);
			return false; 
		
	}  

	// $file could be a file path or a name of uploaded file $_FILES[$file] 
	function load_pic($file, $dir, $dw, $dh, $create_dir=false) //loads file into dir, if extra dir needed to be created its created
	{
		$f_name = $this->load($file, $dir, $create_dir);
		if($f_name)
		{
			$path=$dir;
			if(substr($path,-1) != DIRSEP) // if no '/' in path
			{
				$path .=DIRSEP;
			}
			if($this->resizeImage($path.$f_name, $path.$f_name, $dw, $dh))
				return $f_name;
			else
				return false;
		}else
			return false;
	}
	
	function load_pic_cut($file, $dir, $dw, $dh, $create_dir=false) //loads file into dir, if extra dir needed to be created its created
	{
		$f_name = $this->load($file, $dir, $create_dir);
		if($f_name)
		{
			$path=$dir;
			if(substr($path,-1) != DIRSEP) // if no '/' in path
			{
				$path .=DIRSEP;
			}
			if($this->cutImage($path.$f_name, $path.$f_name, $dw, $dh))
				return $f_name;
			else
				return false;
		}else
			return false;
	}
}
?>