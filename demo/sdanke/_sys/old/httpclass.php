<? 
if(!class_exists("httpclass")) 
{ 
class httpclass 
{ 
//var $cached = true;
var $head_check = "0";

//** 
function endl()
{
	echo "\r\n";
}
function NoCache()
{
	Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	Header("Cache-Control: no-cache, must-revalidate");
	Header("Pragma: no-cache");
	Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
}
function openHTML($cached=false, $text="")
{
	if(!$cashed)
	{
		$this->NoCache();
	}
	echo "<HTML>";
	echo "$text";
	$this->endl();
}
function openHEAD($text="")
{
	echo "<HEAD>";
	echo "$text";
	$this->endl();
}
function outMETA($text="")
{
	echo "<META $text>";
	$this->endl();
}
function outTITLE($text="")
{
	echo "<TITLE> $text </TITLE>";
	$this->endl();
}
function closeHEAD()
{
	echo "</HEAD>";
	$this->endl();
}
function closeHTML()
{
	echo "</HTML>";
	$this->endl();
}
function openBODY($text="", $body="")
{
	echo "<BODY $text>";
	echo "$body";
	$this->endl();
}
function closeBODY()
{
	echo "</BODY>";
	$this->endl();
}
function openSite($cached=false, $textHTML="", $textHEAD="", 
				$textMETA="", $textTITLE="", $textBODY="", $body="" )
{
	$this->openHTML($cached, $textHTML);
	$this->openHEAD($textHEAD);
	$this->outMETA($textMETA);
	$this->outTITLE($textTITLE);
	$this->closeHEAD();
	$this->openBODY($textBODY, $body);
}

function closeSite($text="")
{
	echo "$text";
	$this->closeBODY();
	$this->closeHTML();
}

function outSimpleSite($body="")
{
	$this->openSite();
	echo "$body";
	$this->endl();
	$this->closeSite();
}

function outSelect($name="select", $option_arr=array(), $selected= false, $empty=true)
{
	if (!is_array($option_arr)) return false;
	echo "<select name=\"$name\">";
	$this->endl();

	if($empty)
	{	
		echo "<option>         </option>";
		$this->endl();
	}

	if($selected === false)
	{	
		
		foreach($option_arr as $elem)
		{
			echo "<option> $elem </option>";
			$this->endl();
		}
	}
	else
	{
		foreach($option_arr as $elem)
		{
			if($elem != $selected)
			echo "<option> $elem </option>";
			else
			echo "<option selected=\"selected\"> $elem </option>";
			$this->endl();
		}
	}
	echo "</select>";
	$this->endl();
	return true;
}

function startForm($text="", $action="",$method="post", $enctype="multipart/form-data")
{
	if($text == "")
		echo "<form method=\"$method\" enctype=\"$enctype\" action=\"$action\">";
	else
		echo "<form $text>";
	
	$this->endl();
}

function endForm()
{
	echo "</form>";
$this->endl();
}
}
}
?>
