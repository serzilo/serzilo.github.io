

	<?//------------------------------------------------------------------------------------------------?>
<div class="cntr-block">
<form method="post" id="form_company"> 
  <h2>���������� ����������</h2>
        <hr />
    <p> 
        <label>�������� ��������:</label> 
        <input class="form_input_big" type="text" name="TR_NAME" value="" /> 
    </p>
    <p> 
        <label>���������� ����:</label> 
        <input class="form_input_big" type="text" name="TR_CONTACT_NAME" value="" /> 
    </p>
    <p> 
        <label>���������� �������:</label> 
        <input class="form_input_big" type="text" name="TR_CONTACT_TEL" value="" /> 
    </p>
    <p> 
        <label>E-mail:</label> 
        <input class="form_input_big" type="text" name="TR_E_MAIL" value="" /> 
    </p>
    <p> 
        <label>�����:</label> 
	    <select name="TR_CITY">
            <option>�����-���������</option>
            <option>������</option>
            </select> 
    </p>

<h2>������</h2>
        <hr />
    <p> 
        <label>������� �����:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_SITE" value="1" />
        </span>

  
        <label>������� ������������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_CALC" value="1" />
        </span>

    </p>
    <p> 
        <label>��-���� ������ (����� �������� �����):</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_FORM" value="1" />
        </span>

    <label>��-���� ������ (� ���� ���������):</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_DOC" value="1" />
        </span>
    </p>
    <p> 
        <label>��������� �������� �� ������.������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_YANDEX" value="1" />
        </span>
    </p>
<br clear="all" />
<h2>���������� �� �������</h2>
        <hr />
<p> 
        <label>������� ������������ �����������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_OFFER" value="1" />
        </span>

  
        <label>�������� ������:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_FAX" value="1" />
        </span>

    </p>
    <p> 
        <label>������� �����:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_COLLECT" value="1" />
        </span>

    <label>������ �� e-mail:</label> 
        <span class="form_calc__checkbox">
        	<input type="checkbox" name="TR_ORDER_E_MAIL" value="1" />
        </span>
    </p>
    <br clear="all" />
    <p>
        <h2>����������:</h2>
      <div align="center">
        <textarea name="TR_COMENT"></textarea>
      </div>
    </p>  

    <p>
      <input type="submit" name="add_item" value="��������" />
    </p>  
	
</form>
</div>