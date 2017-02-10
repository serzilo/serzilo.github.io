<?
function LoadImage($filename, $targetfilename, $quality=100 )
{ 
    $type = getimagesize($filename  );
	switch ($type[2])
	{
		case IMAGETYPE_GIF:
			$src = @imagecreatefromgif($filename);
			break;
		case IMAGETYPE_JPEG:
			$src = @imagecreatefromjpeg($filename);
			break;
		case IMAGETYPE_PNG:
			$src = @imagecreatefrompng($filename);
			break;
		 default:
			return false;
	}
   	return imagejpeg($src, $targetfilename, $quality); 
}  

function extractImage($filename, $targetfilename, $x, $y, $sw, $sh, $dw, $dh, $quality=100 )
{ 
    $type = getimagesize($filename);

	switch ($type[2])
	{
		case IMAGETYPE_GIF:
			$src = @imagecreatefromgif($filename);
			break;
		case IMAGETYPE_JPEG:
			$src = @imagecreatefromjpeg($filename);
			break;
		case IMAGETYPE_PNG:
			$src = @imagecreatefrompng($filename);
			break;
		 default:
			return false;
	}
	
	//echo "w=$w sw=$sw h=$h sh=$sh sc=$sc $sx $sy  delta =$delta<br> ";
	
	$dest = imagecreatetruecolor($sw, $sh) or die('problem with new GD image stream'); 
	//imagecopy($dest, $src, 0, 0, 20, 13, 80, 40);
	if(!imagecopy($dest, $src,  0, 0, $x, $y, $sw, $sh))
	{
		//echo 'Проблемы с измененим размера' ;
		return false;
	}			
   
	imagejpeg($dest, $targetfilename, 100); 
	
    return cutImage($targetfilename, $targetfilename, $dw, $dh, $quality );
}  


//------------------------------
function cutImage($filename, $targetfilename, $dw, $dh, $quality=100)
{ 
    $type = getimagesize($filename  );
	switch ($type[2])
	{
		case IMAGETYPE_GIF:
			$src = @imagecreatefromgif($filename);
			break;
		case IMAGETYPE_JPEG:
			$src = @imagecreatefromjpeg($filename);
			break;
		case IMAGETYPE_PNG:
			$src = @imagecreatefrompng($filename);
			break;
		 default:
			return false;
			
	}
	
	$w      = imagesx($src); 
	$h      = imagesy($src); 
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
	
	if(!imagecopyresampled($dest, $src, 0, 0, $sx, $sy, $dw, $dh, $sw, $sh))
	{
		//echo 'Проблемы с измененим размера' ;
		return false;
	}			
   
	return imagejpeg($dest, $targetfilename, $quality); 
    
}  

function resizeImage($filename, $targetfilename, $targetw, $targeth,  $quality=100)
{ 
    $type = getimagesize($filename  );
	switch ($type[2])
	{
		case IMAGETYPE_GIF:
			$src = @imagecreatefromgif($filename);
			break;
		case IMAGETYPE_JPEG:
			$src = @imagecreatefromjpeg($filename);
			break;
		case IMAGETYPE_PNG:
			$src = @imagecreatefrompng($filename);
			break;
		 default:
			return false;
			
	}
        $w      = imagesx($src); 
        $h      = imagesy($src); 
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
        if(!imagecopyresampled($dest, $src, 0, 0, 0, 0, $neww, $newh, $w, $h))
		return false; 
       
        return imagejpeg($dest, $targetfilename, $quality); 
   
}  

function resizeImage_bySide($filename, $targetfilename, $targetw, $targeth,  $quality=100, $side=0)
{ 
    $type = getimagesize($filename  );
	switch ($type[2])
	{
		case IMAGETYPE_GIF:
			$src = @imagecreatefromgif($filename);
			break;
		case IMAGETYPE_JPEG:
			$src = @imagecreatefromjpeg($filename);
			break;
		case IMAGETYPE_PNG:
			$src = @imagecreatefrompng($filename);
			break;
		 default:
			return false;
			
	}
        $w      = imagesx($src); 
        $h      = imagesy($src); 
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
        if(!imagecopyresampled($dest, $src, 0, 0, 0, 0, $neww, $newh, $w, $h))
		return false; 
       
        return imagejpeg($dest, $targetfilename, $quality); 
    
}  
?>