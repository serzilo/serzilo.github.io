<?php
Class date_en
{
	/*
	 * @registry object
	 */
	protected $date;
	 
	protected $months_low = array( 1 => 'january', 2 => 'february', 3 => 'march', 4 => 'april', 
	5 => 'may', 6 => 'june', 7 => 'july', 8 => 'august', 9 => 'september',
	 10 => 'october', 11 => 'hovember', 12 => 'december' );
	
	protected $months_hi = array( 1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
	5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September',
	 10 => 'October', 11 => 'Hovember', 12 => 'December' );
	
	private function setdate($date)
	{
		$this->date  = strtotime($date);
	}
	
	function get_date($date, $hi=false)
	{
		$this->setdate($date);
		$day   = date( 'j',$this->date);
		if($hi)
			$month = $this->months_hi[ date( 'n',$this->date ) ];
		else
			$month = $this->months_low[ date( 'n',$this->date ) ];
			
		$year  = date( 'Y',$this->date );
		return $day.' '.$month.' '.$year ;
	}
	
	function get_date_arr($date, $hi=false)
	{
		$this->setdate($date);
		$day   = date( 'j',$this->date);
		if($hi)
			$month = $this->months_hi[ date( 'n',$this->date ) ];
		else
			$month = $this->months_low[ date( 'n',$this->date ) ];
			
		$year  = date( 'Y',$this->date );
		return array('day'=>$day, 'month'=>$month, 'year'=>$year) ;
	}
	
	function get_time($date, $hi=false)
	{
		$this->setdate($date);
		$min   = date( 'i',$this->date );
		$hour  = date( 'H',$this->date );
		return $hour.':'.$min ;
	}
	
	
}
?>