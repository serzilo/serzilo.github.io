<?php
Class date_ru
{
	/*
	 * @registry object
	 */
	protected $data;
	protected $months_rus_low = array( 1 => '������', 2 => '�������', 3 => '�����', 4 => '������', 
	5 => '���', 6 => '����', 7 => '����', 8 => '�������', 9 => '��������',
	 10 => '�������', 11 => '������', 12 => '�������' );
	 
	protected $months_rus_hi = array( 1 => '������', 2 => '�������', 3 => '�����', 4 => '������', 
	5 => '���', 6 => '����', 7 => '����', 8 => '�������', 9 => '��������',
	 10 => '�������', 11 => '������', 12 => '�������' );
	 
		
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