<?php
Class date_ru
{
	/*
	 * @registry object
	 */
	protected $data;
	protected $months_rus_low = array( 1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 
	5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября',
	 10 => 'октября', 11 => 'ноября', 12 => 'декабря' );
	 
	protected $months_rus_hi = array( 1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 
	5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября',
	 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря' );
	 
		
	private function setdate($date)
	{
		$this->date  = strtotime($date);
	}
	
	function get_date($date, $hi=false)
	{
		
		$this->setdate($date);
		$day = date( 'j',$this->date);
		if($hi)
			$month = $this->months_rus_hi[ date( 'n',$this->date ) ];
		else
			$month = $this->months_rus_low[ date( 'n',$this->date ) ];
			
		$year  = date( 'Y',$this->date );
		return $day.' '.$month.' '.$year ;
	}
	
	function get_date_arr($date, $hi=false)
	{
		$this->setdate($date);
		$day   = date( 'j',$this->date);
		if($hi)
			$month = $this->months_rus_hi[ date( 'n',$this->date ) ];
		else
			$month = $this->months_rus_low[ date( 'n',$this->date ) ];
			
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