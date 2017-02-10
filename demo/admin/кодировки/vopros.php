<?php

$name = $_POST['name'];
$text = $_POST['mes'];


if ($name !='' && $text !=''){
//echo "<div class=\"online_vopros\"><p><strong>".$name."</strong></p><p>".$text."</p></div>";


echo "<div class=\"vopros\">
<img src=\"okno/images/user.jpg\" alt=\"User\" />
<p><span>20:36 - Николай - Компания «Карго-экспресс»</span>".$text."</p>
<div class=\"clear\"></div><!-- .clear-->
</div><!-- .vopros -->";
}