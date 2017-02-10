<?php

$name = $_POST['name'];
$text = $_POST['text'];


$name = "Админ пишет:"; $text = "ваша заявка будет рассмотрена в самое ближайшее время.";

if ($name !='' && $text !=''){

echo "<div id=\"sec\">Служебное</sec>
<div id=\"data\">
<div class=\"vopros\">
<img src=\"okno/images/user.jpg\" alt=\"User\" />
<p><span>20:36 - Админ - Компания &laquo;Say Danke&raquo;</span>".$text."</p>
<div class=\"clear\"></div><!-- .clear-->
</div><!-- .vopros -->
</div><!-- #data -->";
}