$(document).ready(function(){
	
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



	//надписи показать/скрыть
	  $('#online_panel').toggle(function(){
	 	$('#button_nadpis').css({'background':'url(images/hide.png) no-repeat center center'});
	 }, function(){
	 	$('#button_nadpis').css({'background':'url(images/manager.png) no-repeat center center'});
	 });
	 



	//показываем/скрываем панель
    $('#online_panel').toggle(function(){
		$('#main_wrap').show('slide',{direction: 'right'},500);
        $(this).animate({'right':'287px'},500);
		$('#mes_area').scrollTo('div:last');
		
    },function(){
		$(this).animate({'right':'0'},500);
		 $('#main_wrap').hide('slide',{direction: 'right'},500);
    });



	
	//отправка сообщения
  			$("#online_button").click(function() {
			
				var name = "Пользователь пишет:";
				var text = $('#forma textarea').val();
				
					if (text !='Здесь Вы можете оставить свое сообщение'){
				$.ajax({
					url: "vopros.php",
					type: "POST",
					data: {name: name, text: text},
					success: function (data){
					//	alert(data.length);
						$('#mes_area').append(data);
						$('#mes_area').scrollTo('div:last');
						
						//показываем надпись "Ждите ответа"
						$('#wait').show();
						
						//фигачим всякое для ie6
							$('#forma textarea').blur();
							$('input#hidden').focus();
						//фигачим всякое для ie6
						
						}
					
				}); }
			$('textarea').val('').empty().val('Здесь Вы можете оставить свое сообщение').addClass('default_value');
			});


		
		  //получение ответа
			
			window.setInterval(function () {		// JavaScript Устанавливаем интервал запуска нашей функции
				$.ajax({
					url: "otvet.php", // указываем обработчик на стороне сервера
					type: "POST", // указываем метод передачи данных 
					data: {lastmes: 1}, // передаем переменные
					success: function (data) {if (data !=''){
						$('#mes_area').append(data);
						$('#mes_area').scrollTo('div:last');
						};}
				});
			}, 50000); // период между запусками функции





		var mytime = 0;
		function timer(){
			mytime = mytime+600;;
			return mytime;
		};
				



			//делаем скролл
			//вверх
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

			//низ
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




