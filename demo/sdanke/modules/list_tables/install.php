<?php

$ini=parse_ini_file(dirname(__FILE__).DIRSEP.'mod.ini', true);

echo 'Installing mod '.$ini['name'].' - '.$ini['name_rus'].'<br>';

?>