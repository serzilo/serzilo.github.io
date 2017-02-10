<h2>Добавить элемент в раздел - <?php echo $registry->adm_edit_name_alt; ?> </h2> 
<form method="post" class="edit-add" enctype="multipart/form-data">

<table class="parameters" cellpadding="0" border="0" cellspacing="5">
	<tr>
		<td class="label" width="10%">Название текста:</td> 
		<td colspan="3">
			<input type="test" class="big" name="T_NAME"/>
		</td>
		
		</tr><tr>
		<td class="label">Заглавие текста:</td> 
		<td colspan="3">
			<input type="text" class="big" name="T_TITLE"/>
		</td>
		
		</tr><tr>
		<td class="label">Текст:</td> 
		<td class="input" colspan="3">
		<textarea class="big editor" rows="5" cols="10" name="T_TEXT"></textarea>
		</td>
		
		
	</tr>
	</table><input type="submit" value="Добавить" class="submit" name="add_dept" />
</form>