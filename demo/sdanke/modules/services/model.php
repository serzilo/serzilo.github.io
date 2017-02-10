<?php
if($registry->texts_type !== 2)
	$query='SELECT * FROM TEXTS WHERE T_TYPE='.$registry->texts_type.' AND T_NAME like \''.$registry->texts_name."'";
else
	$query='SELECT * FROM TEXTS, META WHERE MT_ID=T_METS_ID AND T_TYPE='.$registry->texts_type.' AND T_NAME like \''.$registry->texts_name."'";

$row = $registry->db->query($query);

if($row == false)
{
	$tmp=$registry->db->get_error();
	file_put_contents('log_texts_model.txt', date('Y-n-j').' -> '.$query.' - '.$tmp[2].'
	', FILE_APPEND);
}

if(is_array($registry->texts_arr))
	$arr=$registry->texts_arr;
else
	$arr=array();
	
$texts_name=$registry->texts_name;

if($registry->texts_type == 1)	// a collection of texts
{
	$arr[$texts_name]=array();
	while($res=$registry->db->get_assoc())
	{
		$arr[$texts_name][]=$res;
	}
}elseif($registry->texts_type == 0)//regulat texts (text pages)
{
	$res=$registry->db->get_assoc();
	$arr[$texts_name]=$res;
}

$registry->texts_arr = $arr;

?>