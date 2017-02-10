<?php

Class base_text 
{
	/*
	 * @registry object
	 */
	protected $text;
	
	protected $translit=array('à'=>'a','á'=>'b','â'=>'v','ã'=>'g','ä'=>'d','å'=>'e','¸'=>'e','æ'=>'j',
	'ç'=>'z','è'=>'i','é'=>'y','ê'=>'k','ë'=>'l','ì'=>'m','í'=>'n','î'=>'o','ï'=>'p','ð'=>'r',
	'ñ'=>'s','ò'=>'t','ó'=>'u','ô'=>'f','õ'=>'h','ö'=>'ts','÷'=>'ch','ø'=>'sh','ù'=>'sch',
	'ú'=>'','û'=>'i','ü'=>'','ý'=>'e','þ'=>'yu','ÿ'=>'ya','À'=>'A','Á'=>'B','Â'=>'V','Ã'=>'G',
	'Ä'=>'D','Å'=>'E','¨'=>'E','Æ'=>'J','Ç'=>'Z','È'=>'I','É'=>'Y','Ê'=>'K','Ë'=>'L','Ì'=>'M',
	'Í'=>'N','Î'=>'O','Ï'=>'P','Ð'=>'R','Ñ'=>'S','Ò'=>'T','Ó'=>'U','Ô'=>'F','Õ'=>'H','Ö'=>'TS',
	'×'=>'CH','Ø'=>'SH','Ù'=>'SCH','Ú'=>'','Û'=>'I','Ü'=>'','Ý'=>'E','Þ'=>'YU','ß'=>'YA',' '=>'_','"'=>'',"'"=>'');
	
	protected $space_quotes=array(' '=>'_','"'=>'',"'"=>'');
	
	function __construct($text='') 
	{
		$this->text = $text;
	}
	
	function rus_translit($content)
	{
		$translit = array_merge ($this->translit, $this->space_quotes);
		//replace:
		$string=str_replace(array_keys($translit),array_values($translit),$content);
		return $string;
	}

	function strip_quotes($content)
	{
		$translit=array('"'=>'',"'"=>'');
		//replace:
		$string=str_replace(array_keys($translit),array_values($translit),$content);
		return $string;
	}
}

?>