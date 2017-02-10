<?php

Class base_text 
{
	/*
	 * @registry object
	 */
	protected $text;
	
	protected $translit=array('�'=>'a','�'=>'b','�'=>'v','�'=>'g','�'=>'d','�'=>'e','�'=>'e','�'=>'j',
	'�'=>'z','�'=>'i','�'=>'y','�'=>'k','�'=>'l','�'=>'m','�'=>'n','�'=>'o','�'=>'p','�'=>'r',
	'�'=>'s','�'=>'t','�'=>'u','�'=>'f','�'=>'h','�'=>'ts','�'=>'ch','�'=>'sh','�'=>'sch',
	'�'=>'','�'=>'i','�'=>'','�'=>'e','�'=>'yu','�'=>'ya','�'=>'A','�'=>'B','�'=>'V','�'=>'G',
	'�'=>'D','�'=>'E','�'=>'E','�'=>'J','�'=>'Z','�'=>'I','�'=>'Y','�'=>'K','�'=>'L','�'=>'M',
	'�'=>'N','�'=>'O','�'=>'P','�'=>'R','�'=>'S','�'=>'T','�'=>'U','�'=>'F','�'=>'H','�'=>'TS',
	'�'=>'CH','�'=>'SH','�'=>'SCH','�'=>'','�'=>'I','�'=>'','�'=>'E','�'=>'YU','�'=>'YA',' '=>'_','"'=>'',"'"=>'');
	
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