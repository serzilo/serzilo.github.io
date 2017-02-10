<?
echo " , ".ini_get(max_execution_time);
echo " , ".ini_get(max_input_time);
echo " , ".ini_get(memory_limit);

ini_set(max_execution_time, 600);
ini_set(max_input_time, 600);
ini_set(memory_limit, 6000000);

echo " , ".ini_get(max_execution_time);
echo " , ".ini_get(max_input_time);
echo " , ".ini_get(memory_limit);
?>