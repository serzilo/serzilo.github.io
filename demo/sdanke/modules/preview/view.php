<?php
if($registry->preview=='main' && $registry->preview_show)
{
	?>
	<div class="announce">
		<span class="announce__label">Анонс</span>
		<span class="announce__date1"><?php echo $PR_DATE ?></span>
		<div class="clear"></div>
		<div class="announce__date">
			<div class="announce__date__day"><?php echo $day ?></div>
			<div class="announce__date__month"><?php echo $month ?></div>
		</div><!--announce__date-->
		<a class="announce__title" href="previews/show/<?php echo $PR_ID;?>"><span><?php echo $PR_TEXT_SHORT ?></span></a>
		<a class="announce__readmore" href="previews/all">План мероприятий</a>
	</div><!--announce-->
	<?php
}

?>