<?

if (isset($_POST['text'])) {
	$OpenNewsFile=fopen("links.txt",'a');
	$msg = stripslashes($_POST['text']);
    fwrite($OpenNewsFile,"<br /><br />".$msg);
	fclose($OpenNewsFile);
}

Echo "Все сделано, Димик!";
?>