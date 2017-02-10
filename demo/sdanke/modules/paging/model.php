<?php
//nedded paging array (num , delta , per_page )
//echo 'Paging model ';
if(is_array($registry->paging_arr ))  // if there are no array od paging data 
	$paging_arr = $registry->paging_arr ; //create an empty array
if(($registry->args !== false) && is_array($registry->args)) //if args is set get the pg (page) number
{
	$args=$registry->args;
	$num=array_search('pg',$args);
	if($num !== false && isset($args[$num+1]))
	{
		$paging_arr['num']=$args[$num+1]; //page number
	}else
		$paging_arr['num']=1;	//if no page number found set it to 1
}else
	$paging_arr['num']=1;	//if no page number can be found set it to 1
	
	$registry->paging_arr = $paging_arr; //set global paging array

	$num=intval($registry->paging_arr['num']); //get int val of the page number
	
	$num = abs(--$num);					//get a page number -1 for use in query
		
	$per_page=10;				// def num per page 
	if(isset($registry->paging_arr['per_page'])) //if set per_page variable
		$per_page=$registry->paging_arr['per_page'];
	
	$delta=2;					// def value fo delta in paging
	if(isset($registry->paging_arr['delta'])) // if set value for paging
		$delta=intval($registry->paging_arr['delta']);
		
	$limit = 'LIMIT '.$num*$per_page.', '.$per_page*($delta*2); //forming a paging addition to query LIMIT 1,2
	$registry->paging_limit=$limit; // writing the limit info
	//echo $limit;
?>