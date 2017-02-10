<?php
if(!class_exists('file_csv')) 
{ 
	class file_csv extends registry
	{ 
		// --------------------- variables
		//data elements 
		
		
		// --------------------- method declaration
		
		function __construct($length=1024, $delim=';')
		{
			$this->delim=$delim;
			$this->length=$length;
		}
		
		// --- WORK WITH CSV FILES ---

		//puts a values from array into file 
		function arr2csv($file, $arr) 
		{ 
			if(!is_array($arr))
			return false;
			
			$fp = fopen($file, 'w');
			
			if($fp != false)
			{
				foreach ($arr as $val) 
				{
					fputcsv($fp, $val,$this->delim);
				}

				fclose($fp);
			}else 
			{ 
				return false; 
			} 
			return true;
		} 
		
		
		//extract a column fron 2D array $arr an array
		//  where keys are taken from $num_key column of $arr
		//	and value are taken from column number $num_val
		function ex_col_arr($arr, $num_key, $num_val) // if num_val < 0 exit false ; if num_key < 0 count as is   
		{ 
			if($num_val < 0 or !is_array($arr)) 
			{ 
				return false;  
			}
			$res = array();
			foreach($arr as $val) //analyse the data
			{
				$data[] = $val[$num_val]; 
				
				if($num_key >= 0) 
				{ 
					$keys[] = trim($val[$num_key]);
				}
			}
			
			if($num_key >= 0 && !in_array('',$keys)) 
			{ 
				$data = array_combine($keys,$data);
			}
			
			return $data;
		}

		// import csv file to array, title can be present or not
		function csv2arr($file, $title=false) 
		{ 
			if($fdata = $this->get($file))
			{
				return $fdata['data'];
			}else
			{
				if(file_exists($file) && is_readable($file)) 
				{ 
					$handle = fopen($file, "r");

					while (($data = fgetcsv($handle, $this->length, $this->delim)) !== FALSE) 
					{
						$csv_arr[] = $data;
					}
					fclose($handle);
					
					$csv_data['title'] = $csv_arr[0];
					
					if(!$title)
						unset($csv_arr[0]);
						
					$csv_data['data'] = $csv_arr;	
					$this->$file=$csv_data;
					
					return $csv_arr;
				}else 
				{ 
					$this->last_error=' File '.$file.' is not readable or does not exist.';
					return false; 
				}
			}
		} 

		// extracts a part of csv file from file,
		// keys and vals of new array
		// title present
		function csv2arr_part($file, $keys, $vals, $title=false)
		{
			return $this->ex_col_arr($this->csv2arr($file, $title), $keys, $vals);
		}

		//extracts part of the array from csv file with title by named column
		//possible key_name if not exist than natural whole array
		//name of the data column
		function csv2arr_part_byName($file, $key_name, $name, $title=false)
		{
			//$arr ,
			$arr=$this->csv2arr($file, $title);
			$col_name = $this->$file;
			
			$keys = array_search($key_name, $col_name['title']);
			$name = array_search($name, $col_name['title']);
			if($name == false)
				return false;
			if($keys === false)
				$keys =-1;
			return $this->ex_col_arr($arr, $keys, $name);
		}


	}
}
?>