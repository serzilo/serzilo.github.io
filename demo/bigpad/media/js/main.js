$(document).ready(function(){
	$('#close_video_block').click(function(){
		var is_chrome = false, chrome_version = false;
			if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
				   is_chrome = true;
				   chrome_version = navigator.userAgent.replace(/^.*Chrome\/([\d\.]+).*$/i, '$1');
				   $('#youtube_block iframe').attr('src','media/images/1.png');
			}else{
				$('#youtube_block iframe').attr('src','media/images/1.png');
			}
	
	
	
		//$('#youtube_block iframe').attr('src','#pp');
		$('#pres_block2').fadeOut(500, function(){
			$('#pres_block1').fadeIn(500, function(){
				$('#video_tumbs_for_gallery a').removeClass('hide_it');
			});
		}); 
		
		
		return false;
	});
	
	$('#pres_block1 .video_wrap a').click(function(){
		var play_this_video = $(this).attr('href');
		var this_id = $(this).attr('id');

		
		//alert(this_id );
		$('#youtube_block iframe').attr('src',play_this_video);
		
		$('#pres_block1').fadeOut(500, function(){
			$('#pres_block2').fadeIn(500);
			$('#video_tumbs_for_gallery').find('#'+this_id).addClass('hide_it');
			
		}); 
		
		return false;
	});
	
	$('#video_tumbs_for_gallery a').live('click',function(){
		var play_this_video_now = $(this).attr('href');
		
		$('#youtube_block iframe').attr('src',play_this_video_now);
		
		return false;
	});
	
	$('#pres_block1 .video_link').clone().appendTo('#video_tumbs_for_gallery');
	
	if ( $.browser.safari ) {
		//alert( navigator.appName;);
	}
	
	//добавляем тени для 1-2 превьюшек
	if ($('.video_wrap a.video_link').length == 3){
		var bb = $('.video_wrap a.video_link');
		$(bb[2]).addClass('add_some_shadow');
	}
	
	if ($('.video_wrap a.video_link').length == 4){
		var bb = $('.video_wrap a.video_link');
		$(bb[2]).addClass('add_some_shadow');
		$(bb[3]).addClass('add_some_shadow');
	}

	
	//меняем цвета бигдов
	//черный
	$('#color_buttons button#black').click(function(){
		$('#bigpad_array').fadeOut(400, function(){
			$('#bigpad_array').css({'background-position':'0 0'}).fadeIn(400);
			
		});
		$('#picker_show_ig').css({'left':'16px'});
	});
	
	//серый
	$('#color_buttons button#grey').click(function(){
		$('#bigpad_array').fadeOut(400, function(){
			$('#bigpad_array').css({'background-position':'0 -671px'}).fadeIn(400);
		});
		$('#picker_show_ig').css({'left':'50px'});
	});
	
	//белый
	$('#color_buttons button#white').click(function(){
		$('#bigpad_array').fadeOut(400, function(){
			$('#bigpad_array').css({'background-position':'0 -1342px'}).fadeIn(400);
		});
		$('#picker_show_ig').css({'left':'89px'});
	});
	
	//красный
	$('#color_buttons button#red').click(function(){
		$('#bigpad_array').fadeOut(400, function(){
			$('#bigpad_array').css({'background-position':'0 -2013px'}).fadeIn(400);
		});
		$('#picker_show_ig').css({'left':'129px'});
	});
	
	//желтый
	$('#color_buttons button#yellow').click(function(){
		$('#bigpad_array').fadeOut(400, function(){
			$('#bigpad_array').css({'background-position':'0 -2684px'}).fadeIn(400);
		});
		$('#picker_show_ig').css({'left':'166px'});
	});
	
	//вывод названия цвета
	$('#color_buttons button').click(function(){
		var this_title = $(this).attr('title');
		$('#color_title').text(this_title);
		$('#color').val(this_title);
	});
	
	//прокрутка стран/городов
	$('.scroll-pane').jScrollPane({
		verticalDragMinHeight: 39,
		verticalDragMaxHeight: 39
	});
	
	//выводим выпадающий список
	$('.selector').click(function(){
		//$('.select_array').hide();
		$(this).parent().find('.select_array').toggle().jScrollPane({
		verticalDragMinHeight: 39,
		verticalDragMaxHeight: 39
	});
					$('html').bind('click', function(e) {
						if ($(e.target).parents().filter('.selects_wrapper').length != 1) {
							$('.select_array').hide();
							$('html').unbind('click');
						}
						
					});
		});
		
		
	//});
	
	$('.select_array span').click(function(){
		var this_text = $(this).text();
		//alert(this_text);
		$(this).parent().parent().parent().parent().find('.selector').text(this_text);
		$('.select_array').hide();
	});
	
	//textarea
	$('#your_message').focus(function(){
		$('#textarea_placeholder').hide();
	});
	
	$('#your_message').blur(function(){
		if ($(this).val() ==''){
			$('#textarea_placeholder').show();
		}
	});
	
	$('#textarea_placeholder').click(function(){
		$('#your_message').focus();
	});
	
	
	
	
	
	//проверка формы (отзывы)
			var proverka = 0;
			var trigger = 0;
			$('#send_form').click(function(){
				var reg = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
				var userEmail = $('#your_email').val();
			
				$('#errors1, #errors2, #thanks').hide();
				proverka = 0;
				
				if ($('#city_select .selector').text() == "ГОРОД"){
					$('#errors1').show();
					proverka += 1;
					
				}
				
				if ($('#country_select .selector').text() == "СТРАНА"){
					$('#errors1').show();
					proverka += 1;
					
				}
				
				
				if ($('#your_name').val() == ""){
					$('#errors1').show();
					proverka += 1;
					
				}

				if ($('#your_phone').val() == '' && $('#your_email').val() == ''){
					$('#errors1').show();
					proverka += 1;
				}
				
				if ($('#your_phone').val() != '' && $('#your_email').val() != ''){
					if (userEmail.search(reg) == -1){
					$('#errors2').show();
					proverka += 1;
					}
				}
				
				if ($('#your_phone').val() == '' && $('#your_email').val() != ''){
					if (userEmail.search(reg) == -1){
					$('#errors2').show();
					proverka += 1;
					}
				}





				if ($('#your_message').val() == ""){
					$('#errors1').show();
					proverka += 1;
					
				}
				
	
				
				

				if (proverka !=0){
					return false;
				} else {
					
					var contacts_city = $('#city_select .selector').text();
					var contacts_country = $('#country_select .selector').text();
					var contacts_name = $('#your_name').val();
					var contacts_phone = $('#your_phone').val();
					var contacts_email = $('#your_email').val();
					var color = $('#color').val();
					var contacts_message = $('#your_message').val();
					
					
					
					$.ajax({
					url: '/ajax/feedback',
					type: "POST",
					data: {contacts_city: contacts_city, contacts_country: contacts_country, contacts_name: contacts_name, contacts_phone: contacts_phone, contacts_email: contacts_email, color: color, contacts_message: contacts_message},
					success: function (data){
							$('#thanks').show();
						}

					});


				}

			});
	
	
	//прокрутка новостей
	$('#wrap_all_news').jScrollPane({
		verticalDragMinHeight: 39,
		verticalDragMaxHeight: 39
	});
	
	
	
	//
	// видео-фото галерея
	//
	
	$('.wrap_news_gallery .tumbs .wrap_video_tumb').click(function(){
		$(this).parent().find('.wrap_video_tumb').find('.active_gallery_tumb').hide();
		//подсвечиваем превьюшку
		$(this).find('.active_gallery_tumb').show();
			
		if ($(this).hasClass('image')){
			var this_src = $(this).attr('rel');
			
			
			
			$(this).parents('.right_news_block').find('.gallery_video_block').hide().find('iframe').attr({'src':'media/images/1.png'});
			$(this).parents('.right_news_block').find('.gallery_image_block').show().find('img').attr({'src':this_src});
			
		} else if 
		($(this).hasClass('youtube')){
			var this_src = $(this).attr('rel');
			
			$(this).parents('.right_news_block').find('.gallery_image_block').hide();
			$(this).parents('.right_news_block').find('.gallery_video_block').show().find('iframe').attr({'src':this_src});
			
		}
	});
	
	
	
	//вкладки
	$('.slide_wrap_content').each(function(){
		var slide_h = $(this).height() -30;
		$(this).attr({'rel':slide_h});
	});
	
	$('#apple_block, #windows_block').height('0');
	
	var app_tr = 0;
	$('#apple_trigger').click(function(){
		if (app_tr == 0){
			var new_a_h = $('#apple_block').attr('rel');
			$('#apple_block').animate({height: new_a_h}, 400);
			app_tr = 1;
		}else{
			$('#apple_block').animate({height: 0}, 400);
			app_tr = 0;
		}
	});
	
	
	var win_tr = 0;
	$('#windows_trigger').click(function(){
		if (win_tr == 0){
			var new_a_h = $('#windows_block').attr('rel');
			$('#windows_block').animate({height: new_a_h}, 400);
			win_tr = 1;
		}else{
			$('#windows_block').animate({height: 0}, 400);
			win_tr = 0;
		}
	});
	
	/*
	$('#apple_trigger').click(function(){
		var new_a_h = $('#apple_block').attr('rel');
		$('#apple_block').animate({height: new_a_h}, 400);
		$('#windows_block').animate({height: 0}, 400);
	});
	
	$('#windows_trigger').click(function(){
		var new_w_h = $('#windows_block').attr('rel');
		$('#windows_block').animate({height: new_w_h}, 400);
		$('#apple_block').animate({height: 0}, 400);
	});
	
	*/
	
	//читаем из адресной строки
	
	function getUrlVars() {
			var vars = {};
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
			});
			return vars;
			}

			var portfolio_item = getUrlVars()["show"];
			
			if (portfolio_item=="all"){
				$('#apple_trigger').click();
				$('#windows_trigger').click();
			}
	
	
	
	
	
	
	
	
	


});






