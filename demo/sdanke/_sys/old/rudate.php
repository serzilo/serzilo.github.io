<?php

function rudate( $date) 
{
	$month_arr = array( 1 => '€нвар€', 2 => 'феврал€', 3 => 'марта', 4 => 'апрел€', 
	5 => 'ма€', 6 => 'июн€', 7 => 'июл€', 8 => 'августа', 9 => 'сент€бр€',
	 10 => 'окт€бр€', 11 => 'но€бр€', 12 => 'декабр€' );
	 
	$day   = date( 'j',strtotime($date) );
	$month = $month_arr[ date( 'n',strtotime($date) ) ];
	$year  = date( 'Y',strtotime($date) );
	return $day.' '.$month.' '.$year.' года' ;
}

function rudate_parts( $date) 
{
	$month_arr = array( 1 => '€нвар€', 2 => 'феврал€', 3 => 'марта', 4 => 'апрел€', 
	5 => 'ма€', 6 => 'июн€', 7 => 'июл€', 8 => 'августа', 9 => 'сент€бр€',
	 10 => 'окт€бр€', 11 => 'но€бр€', 12 => 'декабр€' );

	$ans= array();
	$ans['day'] = date( 'j',strtotime($date) );
	$ans['month'] = $month_arr[ date( 'n',strtotime($date) ) ];
	$ans['month_num'] = date( 'n',strtotime($date) );
	$ans['year'] = date( 'Y',strtotime($date) );
	
	return $ans;
}

function rudate_time( $date) 
{
	$month_arr = array( 1 => '€нвар€', 2 => 'феврал€', 3 => 'марта', 4 => 'апрел€', 
	5 => 'ма€', 6 => 'июн€', 7 => 'июл€', 8 => 'августа', 9 => 'сент€бр€',
	 10 => 'окт€бр€', 11 => 'но€бр€', 12 => 'декабр€' );
	 
	$min   = date( 'i',strtotime($date) );
	$hour  = date( 'H',strtotime($date) );
	$day   = date( 'j',strtotime($date) );
	$month = $month_arr[ date( 'n',strtotime($date) ) ];
	$year  = date( 'Y',strtotime($date) );
	return $day.' '.$month.' '.$year.' года '.$hour.':'.$min ;
}
