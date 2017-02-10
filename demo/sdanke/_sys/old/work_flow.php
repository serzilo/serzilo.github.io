<?
// version 1.0
//
//Обязательная часть
include_once 'glyuktpl.php';
include_once 'php_funcs.php';
include_once 'sql_funcs.php';

global $sql_error;
	global $db_connect;
	
function omit_parts($data, $tpl, $tpl_cur, $arr, $name_order)
{
	$delim = '<!--del-->';
	if(isset($data['omit_delimiter']))
		$delim = $data['omit_delimiter'];
		
	$tmp_txt =$tpl->fastwparse($tpl_cur,$arr, $name_order,false,false);
	$tmp_text= explode($delim, $tmp_txt);
	
	//omiting the data if omit_cond is true
	foreach($data['omit_cond'] as $key => $val)
	{
		$tmp_answer = eval($val);
		if($tmp_answer)
		{
			$tmp_num = $data["omit_$key"];
			foreach($tmp_num as $elem)
				$tmp_text[$elem]='';
			
		}
	}
	
	$tmp_txt = implode('', $tmp_text);
	return $tmp_txt;
						
}

function work_flow($ini, $ini_common = '', $start_part = '', $return_part = '',$start_arr=array())
{
	$global_comand='';
	$global_data='';
	
	$dysplay = false;
	if($start_part == '')
		$dysplay = true;
	
	$tpl = new glyuktpl();

	//require_once ("_sys/start_page.php");

	$first =$start_arr;
	
	if(file_exists($ini) && is_readable($ini))
		$struc = parse_ini_file($ini, true); 
	else
	{
		$exe_error = ' No correct Initialization file ->'.$ini.' ... ';
		return false;
	}
	
	$common = array();
	if($ini_common != '' && file_exists($ini_common) && is_readable($ini_common))
		$common = parse_ini_file($ini_common); 
	
	$tpl_arr = $struc['templates'];
	if(isset($struc['execution']['start_tpl']))
	{
		$tpl_cur = $tpl_arr[$struc['execution']['start_tpl']];
		$cur_tpl_name = $struc['execution']['start_tpl'];
	}
	else
	{
		$tpl_cur = $tpl_arr['main'];
		$cur_tpl_name = 'main';
	}

	$start_page = $struc['execution']['start_page'];
	if((!isset($execution) || $execution == 'main') && file_exists($start_page) && is_readable($start_page)) 
		require_once ($start_page);

	if(isset($struc['change']))
		$chg0 = array_merge($common,$struc['change'],$_POST,$_COOKIE);
	else
		$chg0 = array_merge($common,$_POST,$_COOKIE);
	
	// if the connection is needed
	if($struc['contents']['db'] == 'db' )
	{
		$db_con = 'db/connect.php';
		if(isset($struc['contents']['db_connect_script']))
			$db_con = $struc['contents']['db_connect_script'];
		require ($db_con);
		global $db_connect;
		$db_connect= true;
		//echo $db_con.' '.$db_connect;
	}
	
	if($struc['contents']['db'] == 'file' && isset($struc['contents']['db_connect_script']))
	{
		require($struc['contents']['db_connect_script']);
		$db_file_connect= true;
	}

	//ob_start();

	// if order if set
	if(isset($struc['order']))
	{
		$name_order = $struc['order'];
	}else
	{
		$tpl->loadwtpl($tpl_cur);
		$n_tmp = $tpl->get_names();
		$name_order = $n_tmp[$tpl_cur];
	}

	// common commands to start the page
	if(isset($struc['comands']))
	{
		if(isset($struc['comands']['clear_cookies']))
		{
			clear_cookies($struc['comands']['cookies_exept']);
		}

	}


	$first = array_merge($first, $chg0);
	$multiple= array();

	// - main cycle
	$count = 0;
	$i=0;
	$do_output=true;
	while($do_output and $count<100)
	{
		$count++; // just in case of wrong typing
		//echo ' count is '.$count.' <br />';
		
		if($i==count($name_order)) // stop cycle
		{	
			$do_output = false;
			echo $name_order[$i].' count name order*** '.count($name_order).' '.$count.' '.$i;
			break;
		}
		
		if($name_order[$i] === 'footer' ) // stop cycle
		{	
			$do_output = false;
			//echo $name_order[$i].' footer *** '.count($name_order).' '.$count.' '.$i;
		}
		
		if(!$dysplay)
		{
			if($start_part == $name_order[$i])
				$dysplay = true;
			else
			{
				$i++;
				continue;
			}
		}
			
		$arr = array_merge($first, $chg0);	//get some starting replacement arrays
		
		if(isset($struc[$name_order[$i]])) // if there are some commands
		{
			//checking for multiple use of one blok for different instructions
			$cur_part_name = $name_order[$i];
			if(isset($multiple[$cur_part_name]))
			{
				$_tmp = $multiple[$cur_part_name] +1;
				if(isset($struc[$cur_part_name.'.'.$_tmp]))
					$data = $struc[$cur_part_name.'.'.$_tmp];
				else
					$data = $struc[$name_order[$i]];
				
			}else
			{
				$multiple[$cur_part_name]=0;
				$data = $struc[$name_order[$i]];
			}
			
			
			// Check if current commands are for this tpl, if not then simply output
			// if yes then proccede with commands
			if(isset($data['tpl']) && $data['tpl'] != $cur_tpl_name)
			{
				
				$tpl->fastwparse($tpl_cur,$arr, $name_order[$i],false);
				$i++;
				continue;
			}
			
			$arr = array_merge($arr, $data);
			
			if(isset($data['import_pre'])) // if there is a pre import 
			{
				//echo $data['import_pre'];
				if(isset($data['import_pre_num']))
				{
					foreach($data['import_pre_num'] as $elem)
						$tpl->fastwparse($data['import_pre'],$arr, $elem, false);
				}
				else
				{
					if($tpl->fastwparse($data['import_pre'],$arr,0) === false)
					{
						echo 'Problemms with import ';
					}
				}
			}
			//else echo 'No Import';
			
			
			
			if(isset($data['src_script_pre_ini']))// if there is a pre script initialization
				eval($data['src_script_pre_ini']);
				
				//print_r($data);
					
			if(isset($data['src_script_pre']) && file_exists($data['src_script_pre'])) // if there is a pre script 
			{
				include($data['src_script_pre']);
				if($global_comand !== '')
				{
					switch($global_comand)
					{
						case 'continue' : 
						{
							$i++;
							continue;
						}
						case 'return' 	: return $global_data;
						case 'add_data_array' : 
						{
							if(is_array($global_data))
							$arr= array_merge($arr, $global_data);
						}
						default : ;
					}
				}
			}
			
			
			if(isset($data['db_src']) && $data['db_src']=='db') // if there is a source of data and the source is DB 
			{
				$ans = db_select($data); // do the data extraction
				
				//echo '<pre> data =';			print_r($data);				echo 'ans =';		var_dump($ans);		echo '</pre>';
				
				
				if($ans !== false)
				{
					$num_lines = mysql_num_rows($ans);
					$count_lines=0; //count lines from result of query to db
					while($res = mysql_fetch_assoc($ans))
					{
						$count_lines++;
						
						$db_res = $res;
						
						//print_r($data);
						//print_r($db_res);
						if(isset($data['db_chg_code']))
						// if there is a change to do to the result
						{
							$last_line = ($num_lines == $count_lines)?true:false;
							eval($data['db_chg_code']);
							
						}		
						
						if(isset($data['db_chg_script']) && $data['db_chg_script'])
						// if there is a change to do to the result
						{
							include($data['db_chg_script']);
						}	
						
						//print_r($db_res);
						$arr = array_merge($arr, $db_res);
						
						//-- omiting if nesesaraly
						if( isset($data['omit_cond']) )
						{
							$tmp_txt = omit_parts($data, $tpl, $tpl_cur, $arr, $name_order[$i]);
							echo $tmp_txt;
						}else
						$tpl->fastwparse($tpl_cur,$arr, $name_order[$i],false);
					}
				}else
				{
					echo '<pre>  Problems with db, result ='.$ans.' <br /> data=';
					print_r($data);
					echo ' *** ';
					echo mysql_errno();
					echo '    ';
					echo mysql_error();
					echo ' !!! </pre>';
				}
			}
			else
			{
				//-- omiting if nesesaraly
				if( isset($data['omit_cond']) )
				{
					$tmp_txt = omit_parts($data, $tpl, $tpl_cur, $arr, $name_order[$i]);
					echo $tmp_txt;
				}else
				
					$tpl->fastwparse($tpl_cur,$arr, $name_order[$i],false);
			}
			
			if(isset($data['import_post'])) // if there is a pre import 
			{
				if(isset($data['import_post_num']))
				{
					foreach($data['import_post_num'] as $elem)
						$tpl->fastwparse($data['import_post'],$arr, $elem, false);
				}
				else
				$tpl->fastwparse($data['import_post'],$arr);
			}
			
			
			
			if(isset($data['src_script_post_ini']))// if there is a post initializatio 
				eval($data['src_script_post_ini']);
			
			if(isset($data['src_script_post'])) // if there is a post script 
			{
				include($data['src_script_post']);
				if($global_comand !== '')
				{
					switch($global_comand)
					{
						case 'continue' : continue;
						case 'return' 	: return $global_data;
						default : ;
					}
				}
			}
			
			// -- if the end of output is here then break
			if($return_part === $name_order[$i])
			{
				$dysplay = false;
				//echo 'ret_path break inside';
				break;
			}
			
			//-- changing tpl if needed
			if(isset($data['change_tpl']))
			{
				$cur_tpl_name = $data['change_tpl'];
				$tpl_cur_tmp = $struc['templates'][$cur_tpl_name];
				
				if($tpl->loadwtpl($tpl_cur_tmp) == false)
				{	
					echo 'error loading tpl '.$tpl_cur_tmp;
					return false;
				}
				$tpl_cur = $tpl_cur_tmp;
				$n_tmp = $tpl->get_names();
				//print_r($n_tmp);
				$name_order = $n_tmp[$tpl_cur];
				
				//print_r($name_order);
				
				$i=-1;
				if(isset($data['new_tpl_part']))
				{
					$part_name = $data['new_tpl_part'];
					$tmp = array_search($part_name, $name_order);//search the place to start from
					
					//echo "switching to $tpl_cur  . $tmp . $part_name   ";
					if($tmp !== false)
						$i=$tmp - 1;
						
					//echo "switching to $tpl_cur  . $tmp . $part_name   ";
					
					
				}
				
			}		
			
		}else	
		{
			$tpl->fastwparse($tpl_cur,$arr, $name_order[$i],false);
		}
		
		//echo $i;
		
		$i++;
		//echo $i;
		
		if($return_part === $name_order[$i])
		{
			$dysplay = false;
			//echo 'ret_path break';
			break;
		}
		

	}
		//echo "<hr> <!-- ******************************************************************-->";
		
		//$tpl->show_arrs();
		//echo "<hr> <!-- ******************************************************************-->";

	if($db_connect == true && (!isset($execution) || $execution == 'main'))
	{
		mysql_close($db);
	}
	
	//echo $i.'  ';
	//echo $count;

		return true;
}
?>