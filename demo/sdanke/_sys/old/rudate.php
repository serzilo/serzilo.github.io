<?php

function rudate( $date) 
{
	$month_arr = array( 1 => '������', 2 => '�������', 3 => '�����', 4 => '������', 
	5 => '���', 6 => '����', 7 => '����', 8 => '�������', 9 => '��������',
	 10 => '�������', 11 => '������', 12 => '�������' );
	 
	$day   = date( 'j',strtotime($date) );
	$month = $month_arr[ date( 'n',strtotime($date) ) ];
	$year  = date( 'Y',strtotime($date) );
	return $day.' '.$month.' '.$year.' ����' ;
}

function rudate_parts( $date) 
{
	$month_arr = array( 1 => '������', 2 => '�������', 3 => '�����', 4 => '������', 
	5 => '���', 6 => '����', 7 => '����', 8 => '�������', 9 => '��������',
	 10 => '�������', 11 => '������', 12 => '�������' );

	$ans= array();
	$ans['day'] = date( 'j',strtotime($date) );
	$ans['month'] = $month_arr[ date( 'n',strtotime($date) ) ];
	$ans['month_num'] = date( 'n',strtotime($date) );
	$ans['year'] = date( 'Y',strtotime($date) );
	
	return $ans;
}

function rudate_time( $date) 
{
	$month_arr = array( 1 => '������', 2 => '�������', 3 => '�����', 4 => '������', 
	5 => '���', 6 => '����', 7 => '����', 8 => '�������', 9 => '��������',
	 10 => '�������', 11 => '������', 12 => '�������' );
	 
	$min   = date( 'i',strtotime($date) );
	$hour  = date( 'H',strtotime($date) );
	$day   = date( 'j',strtotime($date) );
	$month = $month_arr[ date( 'n',strtotime($date) ) ];
	$year  = date( 'Y',strtotime($date) );
	return $day.' '.$month.' '.$year.' ���� '.$hour.':'.$min ;
}
