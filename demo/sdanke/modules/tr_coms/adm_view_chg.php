<?php
//if exists item_data array
if($registry->item_data && is_array($registry->item_data))
{
//get the data and common settings 
$item_data = $registry->item_data;    $com = $registry->common;

}	
?>



	<?//------------------------------------------------------------------------------------------------?>
<div class="cntr-block">
<form method="post" id="form_company"> 
  <h2>���������� ����������</h2>
        <hr />
    <p> 
        <label>�������� ��������:</label> 
        <input class="form_input_big" type="text" name="TR_NAME" value="<?=$item_data['TR_NAME']?>" /> 
    </p>
    <p> 
        <label>���������� ����:</label> 
        <input class="form_input_big" type="text" name="TR_CONTACT_NAME" value="<?=$item_data['TR_CONTACT_NAME']?>" /> 
    </p>
    <p> 
        <label>���������� �������:</label> 
        <input class="form_input_big" type="text" name="TR_CONTACT_TEL" value="<?=$item_data['TR_CONTACT_TEL']?>" /> 
    </p>
    <p> 
        <label>E-mail:</label> 
        <input class="form_input_big" type="text" name="TR_E_MAIL" value="<?=$item_data['TR_E_MAIL']?>" /> 
    </p>
    <p> 
        <label>�����:</label> 
	    <select name="TR_CITY">
            <option<?if($item_data['TR_CITY'] == '�����-���������') echo ' selected';?>>�����-���������</option>
            <option<?if($item_data['TR_CITY'] == '������') echo ' selected';?>>������</option>
            </select> 
    </p>

<h2>������</h2>
        <hr />
    <p> 
        <label>������� �����:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_SITE" value="1" <?if($item_data['TR_SITE']) echo 'checked="checked"';?> >
        </span>

  
        <label>������� ������������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_CALC"  value="1" <?if($item_data['TR_CALC']) echo 'checked="checked"';?> >
        </span>

    </p>
    <p> 
        <label>��-���� ������ (����� �������� �����):</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_FORM"  value="1" <?if($item_data['TR_ORDER_FORM']) echo 'checked="checked"';?> >
        </span>

    <label>��-���� ������ (� ���� ���������):</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_DOC"  value="1" <?if($item_data['TR_ORDER_DOC']) echo 'checked="checked"';?> >
        </span>
    </p>
    <p> 
        <label>��������� �������� �� ������.������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_YANDEX"  value="1" <?if($item_data['TR_YANDEX']) echo 'checked="checked"';?> >
        </span>
    </p>
<br clear="all" />
<h2>���������� �� �������</h2>
        <hr />
<p> 
        <label>������� ������������ �����������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_OFFER"  value="1" <?if($item_data['TR_OFFER']) echo 'checked="checked"';?> >
        </span>

  
        <label>�������� ������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_FAX"  value="1" <?if($item_data['TR_ORDER_FAX']) echo 'checked="checked"';?> >
        </span>

    </p>
    <p> 
        <label>������� �����:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_COLLECT"  value="1" <?if($item_data['TR_COLLECT']) echo 'checked="checked"';?> >
        </span>

    <label>������ �� e-mail:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_E_MAIL"  value="1" <?if($item_data['TR_ORDER_E_MAIL']) echo 'checked="checked"';?> >
        </span>
    </p>
    <br clear="all" />
    <p>
        <h2>����������:</h2>
      <div align="center">
        <textarea name="TR_COMENT"><?=$item_data['TR_COMENT']?></textarea>
      </div>
    </p>  

	<p>
      <input type="submit" name="chg_item" value="��������" />
    </p>  	
</form>
</div>