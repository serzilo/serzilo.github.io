$(document).ready(function(){
	
//��� ������ ������ ����� ������
$('#forma textarea').focus(function(){
	$(this).removeClass('default_value');
});

//����� ����� ������ - ����� �����
$('#forma textarea').blur(function(){
		if ($(this).val()=='����� �� ������ �������� ���� ���������' || $(this).val()==''){
			$(this).addClass('default_value');
		}
});
  	


//�� ������ ������� ��������� ������� � ������ �� �������, ���� ��� �����
var mf = $('#forma textarea');
mf.focus(function(){
	if ($(this).val()=='����� �� ������ �������� ���� ���������'){
	$(this).val('');
	}
});
mf.blur(function(){
if ($(this).val() == ''){
	$(this).val('����� �� ������ �������� ���� ���������');
}


});



	//������� ��������/������
	  $('#online_panel').toggle(function(){
	 	$('#button_nadpis').css({'background':'url(images/hide.png) no-repeat center center'});
	 }, function(){
	 	$('#button_nadpis').css({'background':'url(images/manager.png) no-repeat center center'});
	 });
	 



	//����������/�������� ������
    $('#online_panel').toggle(function(){
		$('#main_wrap').show('slide',{direction: 'right'},500);
        $(this).animate({'right':'287px'},500);
		$('#mes_area').scrollTo('div:last');
		
    },function(){
		$(this).animate({'right':'0'},500);
		 $('#main_wrap').hide('slide',{direction: 'right'},500);
    });



	
	//�������� ���������
  			$("#online_button").click(function() {
			
				var name = "������������ �����:";
				var text = $('#forma textarea').val();
				
					if (text !='����� �� ������ �������� ���� ���������'){
				$.ajax({
					url: "vopros.php",
					type: "POST",
					data: {name: name, text: text},
					success: function (data){
					//	alert(data.length);
						$('#mes_area').append(data);
						$('#mes_area').scrollTo('div:last');
						
						//���������� ������� "����� ������"
						$('#wait').show();
						
						//������� ������ ��� ie6
							$('#forma textarea').blur();
							$('input#hidden').focus();
						//������� ������ ��� ie6
						
						}
					
				}); }
			$('textarea').val('').empty().val('����� �� ������ �������� ���� ���������').addClass('default_value');
			});


		
		  //��������� ������
			
			window.setInterval(function () {		// JavaScript ������������� �������� ������� ����� �������
				$.ajax({
					url: "otvet.php", // ��������� ���������� �� ������� �������
					type: "POST", // ��������� ����� �������� ������ 
					data: {lastmes: 1}, // �������� ����������
					success: function (data) {if (data !=''){
						$('#mes_area').append(data);
						$('#mes_area').scrollTo('div:last');
						};}
				});
			}, 50000); // ������ ����� ��������� �������





		var mytime = 0;
		function timer(){
			mytime = mytime+600;;
			return mytime;
		};
				



			//������ ������
			//�����
			$('#button_up').hover(function(){
				var timeHover = setInterval('timer()',1000);
				var tt =0, tt = tt + timeHover;
				var number_mes = 0;
				number_mes = ($('#mes_area div').not('.clear').length)*600;
				$('#mes_area').scrollTo('div:first',number_mes-tt);
				return tt;
				
				//alert(number_mes);
			},function(){
				$('#mes_area').stop();
			});

			//���
			$('#button_down').hover(function(){
				var timeHover = setInterval('timer()',1000);
				var tt =0, tt = tt + timeHover;
				var number_mes = 0;
				var number_mes = ($('#mes_area div').not('.clear').length)*600;
				$('#mes_area').scrollTo('div:last',number_mes-tt);
				//alert(number_mes);
			},function(){
				$('#mes_area').stop();
			});


			
			
			







});




