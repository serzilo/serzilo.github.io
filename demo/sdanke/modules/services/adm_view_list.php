	<? if(isset($struc['allow']['del'])):?>
	<a href="<?php echo site_host.$registry->adm_edit_name; ?>/add" class="hicon add">�������� ������� � ������ - <?php echo $registry->adm_edit_name_alt; ?></a> 
	<?endif;?>
	<h2><?php echo $registry->page_title ?></h2> 
<table class="list" width="100%" align="center" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td>��������</td>
					<td>�����</td>
					<td width="70">��������</td>
				</tr>
			</thead>
			<tbody>
		
		<?php
		if(is_array($registry->list_tables))
			foreach($registry->list_tables as $key => $val)
			{
				$val[$struc['sql_prefix'].'_TEXT']=strip_tags($val[$struc['sql_prefix'].'_TEXT']);
				?>
				<tr>
					<td width="210">
					<?$registry->tpl->out_adm_fields($struc['list']['name'], $val, $struc['sql_prefix']);?>
					</td>
					
					<td><a href="chg/<?php echo $val[$struc['sql_prefix'].'_ID'];?>" title="��������">
					<?php echo substr($val[$struc['sql_prefix'].'_'.$struc['list']['cont'][0]], 0, 100).'...';?></a></td>
					
					<td width="70">
						<? if(isset($struc['allow']['show'])):?>
							<?if((isset($val[$struc['sql_prefix'].'_ACTIVE']) 
							&& $val[$struc['sql_prefix'].'_ACTIVE']==true) ||
							(isset($val[$struc['sql_prefix'].'_SHOW']) 
							&& $val[$struc['sql_prefix'].'_SHOW']==true)):?>
								<a href="show/<?php echo $val[$struc['sql_prefix'].'_ID'];?>" title="�� ���������� �� �����">
								<img src="<?php echo site_host; ?>icons/show.png" alt="�� ����������"  /></a>
							<?else:?>
								<a href="show/<?php echo $val[$struc['sql_prefix'].'_ID'];?>" title="�������� �� �����">
								<img src="<?php echo site_host; ?>icons/show.png" alt="��������"  /></a>
							<?endif;?>
						<?endif;?>
						<a href="chg/<?php echo $val[$struc['sql_prefix'].'_ID'];?>" title="��������">
						<img src="<?php echo site_host; ?>icons/edit.png" alt="��������" /></a>
						<? if(isset($struc['allow']['del'])):?>
							<a href="del/<?php echo $val[$struc['sql_prefix'].'_ID'];?>" title="�������">
							<img src="<?php echo site_host; ?>icons/delete.png" alt="�������"  onclick="return confirm('�� ������������� ������ �������?')"/></a>
						<?endif;?>					
					</td>
				</tr>
				<?php
			}
		?></tbody></table>