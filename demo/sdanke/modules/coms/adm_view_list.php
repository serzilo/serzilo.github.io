	<? if(isset($struc['allow']['del'])):?>
	<a href="<?php echo site_host.$registry->adm_edit_name; ?>/add" class="hicon add">�������� ������� � ������ - <?php echo $registry->adm_edit_name_alt; ?></a> 
	<?endif;?>
	<h2><?php echo $registry->page_title ?></h2> 
	
	<form method="post" class="edit-add">

		<table class="parameters" cellpadding="0" border="0" cellspacing="5">
		<tr>
			<td  class="label">��������:</td> 
			<td   class="input">
			<input class="password" type="text" name="NAME" value="<?php if(isset($_SESSION['adm_search']['NAME'])) echo $_SESSION['adm_search']['NAME']; ?>"/></td>
			<td  class="label">�������� �� ���������:</td> 
			<td  class="input">
			<input class="password" type="text" name="NAME_RUS" value="<?php if(isset($_SESSION['adm_search']['NAME_RUS'])) echo $_SESSION['adm_search']['NAME_RUS']; ?>"/></td>
		
		</tr><tr>	

		<td class="label">���� �������� �� (yyyy-mm-dd):</td>

		<td class="input">
			<input class="password calendar" type="text" name="date_create_from" value="<?php if(isset($_SESSION['adm_search']['date_create_from'])) echo $_SESSION['adm_search']['date_create_from']; ?>"/>
		</td>

		<td class="label">���� �������� �� (yyyy-mm-dd):</td>

		
		<td class="input">
			<input class="password calendar" type="text" name="date_create_to" value="<?php if(isset($_SESSION['adm_search']['date_create_to'])) echo $_SESSION['adm_search']['date_create_to']; ?>"/>
		</td>
		</tr><tr>	

		<td  class="label">���� �������������� �� (yyyy-mm-dd):</td>
			
		<td class="input">
			<input class="password calendar" type="text" name="date_edit_from" value="<?php if(isset($_SESSION['adm_search']['date_edit_from'])) echo $_SESSION['adm_search']['date_edit_from']; ?>"/>
		</td>

		<td  class="label">���� �������������� �� (yyyy-mm-dd):</td>

		
		<td class="input">
			<input class="password calendar" type="text" name="date_edit_to" value="<?php if(isset($_SESSION['adm_search']['date_edit_to'])) echo $_SESSION['adm_search']['date_edit_to']; ?>"/>
		</td>
		
		</tr><tr>
		<td  class="label">���������:</td> 
		<td class="input">
			<select name="TYPE">
			<option value="-1"></option>
			<?
				if(isset($struc['TYPE']) && is_array($struc['TYPE']))
				{
					foreach($struc['TYPE'] as $type_key => $type_val)
					{
						/*if(isset($_SESSION['adm_search']['TYPE']) && $type_key == $_SESSION['adm_search']['TYPE'])
							echo '<option value="'.$type_key.'" style="background-color: '.$struc['TYPE_COLORS'][$type_key].'" selected>'.$type_val.'</option>';
						else
							echo '<option value="'.$type_key.'" style="background-color: '.$struc['TYPE_COLORS'][$type_key].'">'.$type_val.'</option>';
						//*/
						if(isset($_SESSION['adm_search']['TYPE']) && $type_key == $_SESSION['adm_search']['TYPE'])
							echo '<option value="'.$type_key.'" class="option cl'.($type_key+1).'" selected>'.$type_val.'</option>';
						else
							echo '<option value="'.$type_key.'" class="option cl'.($type_key+1).'">'.$type_val.'</option>';
					}
				}
			?>
			</select>
		</td>
		
			<td  class="label">���� ���������:</td> 
			<td class="input">
			<select name="ASSIGN">
			<option></option>
			<?
				if(isset($struc['ASSIGN']) && is_array($struc['ASSIGN']))
				{
					foreach($struc['ASSIGN'] as $ass_val)
					{
						if(isset($_SESSION['adm_search']['ASSIGN']) && $ass_val == $_SESSION['adm_search']['ASSIGN'])
							echo '<option selected>'.$ass_val.'</option>';
						else
							echo '<option>'.$ass_val.'</option>';
					}
				}
			?>
			</select>
			</td>
			</tr><tr>	
			<td colspan="4" class="submit" align="center">
			<input class="password" type="submit" name="filter" value="�����"/>
			</td>
		</tr>
		<tr>
		<td colspan="4"> <?php if($registry->list_tables_count != false) echo '������� �������: '.$registry->list_tables_count;?></td>
		</tr>
		</table>
	</form>

<table class="list" width="100%" align="center" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<td>�������� - ����� ��������</td>
					<td>��������� - ����������</td>
					<td>���� ���������</td>
					<td>����������</td>
					
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
				<tr class="cl<?=($val[$struc['sql_prefix'].'_TYPE']+1);?>">
					<td width="170">
					<?$registry->tpl->out_adm_fields($struc['list']['name'], $val, $struc['sql_prefix']);?>
					</td>
					
					<td><a href="chg/<?php echo $val[$struc['sql_prefix'].'_ID'];?>" title="��������">
					<span id="type"><?=$struc['TYPE'][$val[$struc['sql_prefix'].'_TYPE']];?></span><br/>
					<?$registry->tpl->out_adm_fields($struc['list']['cont'], $val, $struc['sql_prefix']);?>
					</a></td>
					
					<td><?$registry->tpl->out_adm_fields($struc['list']['cont2'], $val, $struc['sql_prefix']);?>
					</td>
					
					<td><span id="assign"><?=$val[$struc['sql_prefix'].'_ASSIGN'];?></span>
					</td>
					
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
		
		
		
		