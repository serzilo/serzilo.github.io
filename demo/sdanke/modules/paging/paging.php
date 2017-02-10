<?
function paging($total, $num, $call_addr, $prefix='../', $per_page=10, $end_call='', $delta=2)
//$total - total number of elements
//$num - currently selected mark
//$call_addr - an address of link at mark
//$per_page - elements per page
//$end_call - an extra text in the address line of the mark link (...#search)
//$delta - a delta for displaying paging
{
//echo $total.', '.$num.', '.$call_addr.', '.$prefix.', '.$per_page.', '.$end_call.', '.$delta.'| ';
if($per_page < 1)
	return;
	
$tot=ceil($total/$per_page + $num-1);
//echo $tot;
if($tot <2)
	return;

if($num<=0 )
	return;

if($num==0)
	$num=1;
	
echo '<div class="pager">
';

$i=1;

if($num>1)
	echo '<a href="'.$prefix.$call_addr.'pg/'.($num-1).$end_call.'" class="arrow arrow_left" title="предыдуща€ страница">&larr;</a>
	';


//$skip=$delta;
	
if($num > $delta+1)
	echo '<a href="'.$prefix.$call_addr.'pg/'.($num-$delta-1).$end_call.'" title="предыдущий промежуток">Е</a>
	';	

for($i=$num-$delta; $i<=$num+$delta; $i++)
{
	if($i>0 && $i !=$num &&  $i<=$tot)
		echo '<a href="'.$prefix.$call_addr.'pg/'.$i.$end_call.'">'.$i.'</a>
		';	
	elseif($i ==$num)
		echo '<span class="active">'.$i.'</span>';	
}
	
if($tot > $num+$delta)
	echo '<a href="'.$prefix.$call_addr.'pg/'.($num+$delta+1).$end_call.'" title="следующий промежуток">Е</a>
	';	
	
if($tot > $num )
echo '<a href="'.$prefix.$call_addr.'pg/'.($num+1).$end_call.'" class="arrow arrow_right" title="следующа€ страница" >&rarr;</a>
';

	
echo '</div>
';	
}
?>