<?php
$f_name=$_GET['fe'];

if (function_exists($f_name)) {
    echo $f_name." functions are available.<br />\n";
} else {
    echo $f_name." functions are not available.<br />\n";
}
?>