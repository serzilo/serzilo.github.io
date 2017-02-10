$(document).ready(function(){
	
	//переменные
	var s_adr = "otvet.php";
	var m ="4000";
	var mes = "";
	
	//для скрола
	var itsTime = 0;
	var itsTime2 = 0;
	var number_mes = 0;
	//для скрола
	
//при фокусе делаем текст черным
$('#forma textarea').focus(function(){
	$(this).removeClass('default_value');
});

//когда фокус уходит - опять серым
$('#forma textarea').blur(function(){
		if ($(this).val()=='Здесь Вы можете оставить свое сообщение' || $(this).val()==''){
			$(this).addClass('default_value');
		}
});
  	


//на фокусе убираем дефолтные подписи и ставим их обратно, если там пусто
var mf = $('#forma textarea');
mf.focus(function(){
	if ($(this).val()=='Здесь Вы можете оставить свое сообщение'){
	$(this).val('');
	}
});
mf.blur(function(){
if ($(this).val() == ''){
	$(this).val('Здесь Вы можете оставить свое сообщение');
}


});



	
	 







		
	//отправка сообщения
  			$("#online_button").click(function() {
			
				
				var text = $('#forma textarea').val();
				
					if (text !='Здесь Вы можете оставить свое сообщение'){
				$.ajax({
					url: s_adr,
					type: "POST",
					data: {mes: text},
					success: function (data){
						}
				}); 
					$('#wait').show();
						var newVopros = "<div class=\"vopros\"><img src=\"okno/images/user.jpg\" alt=\"User\" /><p><span>20:36 - Николай - Компания &laquo;Карго-экспресс&raquo;</span>"+text+"</p><div class=\"clear\"></div><!-- .clear--></div><!-- .vopros -->";
					$('#mes_area').append(newVopros);

					$('#mes_area').scrollTo('div:last');	
					//после отправки/получения сообшения всё сбрасываем (t)
							itsTime = 0, itsTime2 = 0, number_mes = (($('#mes_area div').not('.clear').length)*650);
					//фигачим всякое для ie6
							$('#forma textarea').blur();
							$('input#hidden').focus();
					//фигачим всякое для ie6
				}
			$('textarea').val('').empty().val('Здесь Вы можете оставить свое сообщение').addClass('default_value');
			});


		
		  //получение ответа
			
			window.setInterval(function () {		// JavaScript Устанавливаем интервал запуска нашей функции
				$.ajax({
					url: s_adr, // указываем обработчик на стороне сервера
					type: "POST", // указываем метод передачи данных 
					data: {lastmes: 1}, // передаем переменные
					success: function (data) {if (data !=''){
						$('#help_block').html(data);
							var adminOtvet = $('#help_block div#data').html();
								//alert(adminOtvet);
							$('#mes_area').append(adminOtvet);
						$('#mes_area').scrollTo('div:last');
							//после отправки/получения сообшения всё сбрасываем (t)
							itsTime = 0, itsTime2 = 0, number_mes = (($('#mes_area div').not('.clear').length)*650);
						};}
				});
			}, m); // период между запусками функции







		
			
			
			
			
			
			
			
			


});




