$(document).ready(function(){
	
		//поиск
			$('#search').focus(function(){
				if ($(this).val() =='ПОИСК'){
					$(this).val('');
				}
				$(this).removeClass('empty');
			}).blur(function(){
				if ($(this).val() =='ПОИСК' || $(this).val() ==''){
					$(this).val('ПОИСК');
					$(this).addClass('empty');
				}
			});
	
		//ввод логина
		$('#login_input').focus(
			function(){
				if ($(this).val() =='имя'){
					$(this).val('');
				}
			}
		).blur(function(){
				if ($(this).val() =='имя' || $(this).val() ==''){
					$(this).val('имя');
				}
			});
	
	
		//ввод пароля
		$('#password_input').focus(
			function(){
				$(this).get('0').setAttribute('type', 'password');
				if ($(this).val() =='пароль'){
					$(this).val('');
				}
			}
		).blur(function(){
				if ($(this).val() =='пароль' || $(this).val() ==''){
					$(this).get('0').setAttribute('type', 'text');
					$(this).val('пароль');
				}
			});
			
		
		//если ie7-8
		if ($.browser.msie && $.browser.version.substr(0,1)<9){
			var new_password = '<input type="password" id="password_input" value="пароль" />';
			$('.password_input_wrap').html(new_password);
			
			$('#password_input').focus(
			function(){
				if ($(this).val() =='пароль'){
					$(this).val('');
				}
			}
			).blur(function(){
				if ($(this).val() =='пароль' || $(this).val() ==''){
					$(this).val('пароль');
				}
			});
		}
		
		if ($.browser.msie && $.browser.version.substr(0,1)<8){
			$('#footer_wrap').appendTo('#bg');
		}
			
			
			
		//прокрутка
		
	
		//если категорий больше 11 то включаем прокрутку
		if ($('#categories_menu_ul_wrapper li').length > 11){

			// двигаем колесико по меню
			$('#categories_menu_ul_wrapper').mousewheel(scrollSubMenu);

			//кнопка вверх
			$('#move_up_button').click(function () {
				scrollSubMenu(false, 1);
			});

			// кнопка вниз
			$('#move_down_button').click(function () {
				scrollSubMenu(false, -1);
			})
		
		}else{
			$('#move_down_button').hide();
		}
		
		
		
		function enableSubMenuButtons (up, down) {
	    var upButton = $('#move_up_button'),
	        downButton = $('#move_down_button');

	    if (up !== null) (up) ? upButton.removeClass('disabled_button') : upButton.addClass('disabled_button');
	    if (down !== null)(down) ? downButton.removeClass('disabled_button') : downButton.addClass('disabled_button');
		}
		
		

		function scrollSubMenu (event, delta) {
	    if (event) event.preventDefault();

     //   var content = $('.active').next('#categories_menu_ul_wrapper').find('ul'),
        var content = $('#categories_menu_ul_wrapper').find('ul'),
            newMarginTop = parseInt(content.css('margin-top')) + delta * 30,
            containerHeight = $("#categories_menu_ul_wrapper").height(),
           // contentHeight = $('.active').next('#categories_menu_ul_wrapper').find('ul').innerHeight(),
            contentHeight = $('#categories_menu_ul_wrapper').find('ul').innerHeight(),
            minMarginTop;

            if (containerHeight < contentHeight) {
                minMarginTop = containerHeight - contentHeight;
            } else {
                minMarginTop = 0;
            }

        if (newMarginTop < minMarginTop) {
            newMarginTop = minMarginTop;
        } else if (newMarginTop > 0) {
            newMarginTop = 0;
        }

        // РґРµР°РєС‚РёРІРёСЂРѕРІР°С‚СЊ РєРЅРѕРїРєРё РєРѕРіРґР° РїРѕРґРјРµРЅСЋ РїСЂРѕРєСЂСѓС‡РµРЅРѕ РґРѕ РІРµСЂС…Р°/РЅРёР·Р°
        if (newMarginTop == 0) {
            enableSubMenuButtons(false, null);
        } else {
            enableSubMenuButtons(true, null);
        }

        if (newMarginTop == minMarginTop) {
            enableSubMenuButtons(null, false);
        } else {
            enableSubMenuButtons(null, true);
        }

        content.css('margin-top', newMarginTop + 'px');
    }
			
			
			
		//top slider
		 var slider = $('#top_slider_block').bxSlider({
			 auto: true,
			 pause: 6000,
			 controls: false
		});
		
		 $('#go_prev').click(function(){
			slider.goToPreviousSlide();
		return false;
		});

		$('#go_next').click(function(){
			slider.goToNextSlide();
		return false;
		});
		
		
		 var slider2 = $('#bottom_slider_block').bxSlider({
			 auto: true,
			 pause: 4000,
			 controls: false
		});
		
		 $('#go_prev2').click(function(){
			slider2.goToPreviousSlide();
		return false;
		});

		$('#go_next2').click(function(){
			slider2.goToNextSlide();
		return false;
		});
		
		
		
		
		//
		// выпадающие списки в каталоге
		//
			
		$('.top_item_choose').toggle(function(){
			$(this).addClass('up_arrow');
			
			$(this).parent().find('.top_item_links_array').removeClass('hide_it');
		}, function(){
			$(this).removeClass('up_arrow');
			
			$(this).parent().find('.top_item_links_array').addClass('hide_it');
		});
			
			
		//
		// прокрутка на странице товара
		//
		
		$('#scroll_categories').jScrollPane();
		function move_scroll_bar(){
			if ($('.jspVerticalBar').length){
				$('.jspVerticalBar').prependTo('#wrap_scroll_categories');
				clearInterval(start_check_scroll);
			}
		}
		
		var start_check_scroll = setInterval(move_scroll_bar,100);
			
			
		//
		// РАБОТА С ОКНАМИ
		//
		
			//закрытие окна
			$('.close_window').click(function(){
				$(this).parent().hide();
			});
			

			function open_window_check_position(){
				if (!navigator.userAgent.match(/iPad/i)){
				$('.open_window_check').each(function(){
					
					var this_element = $(this);
					
					
					
						var this_element_width = this_element.width();
						
						if (this_element.hasClass('application_min_to_big')){
							var this_element_height = this_element.height() + 76;
						}else{
							var this_element_height = this_element.height();
						}
						
						
						
						
						var body_height = $('body').height();
						
						if (this_element_height < body_height){
							var new_top = (body_height - this_element_height ) / 2;
							this_element.css({'top':new_top + 'px'});
						}else{
							this_element.css({'top':'0'});
						}
					
				});
			}else{
				$('.open_window_check').css({'top':'50px'});
			}
			
			}
			
			open_window_check_position();
			$(window).resize(open_window_check_position);
			
			
			//
			// открытие окна с регистрацией
			//
			
			$('#top_registration_link, #to_open_full_registration2').click(function(){
				$('.open_window_check').hide();
				$('#registration_full').show();
				
				return false;
			});
			
			
			//
			// открываем быструю регистрацию из заявки
			//
			
			$('a.fast_reg').click(function(){
				$('#only_reg_people').addClass('hide_it');
				$('#fast_registration_block').removeClass('hide_it');
				open_window_check_position();
				return false;
			});
			
			
			//добавление темы для заявки
			$('.submit_your_application').click(function(){
				var this_element = $(this);
				var this_text = "Заявка на катридж " + this_element.parents('li').find('a.top_item_title').text();
				$('#application_min_to_big_title').val(this_text);
				$('#application_min_to_big').show();
				return false
			});
			
			
			//валидация форajhv
			$('.send_form').click(function(){
				$(this).parents('.open_window_check').find('label i').hide();
				var check_trigger = 0;
				var pass_num = 0;
				var pass = '';
				$(this).parents('.open_window_check').find('.required').each(function(){
					if ($(this).val() == ''){
						$(this).prev('label').find('i').not('.bad_password').show();
						check_trigger = 1;
					}
					
					if ($(this).hasClass('email')){
						var reg = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
						var userEmail = $(this).val();
							if (userEmail.search(reg) == -1){
								$(this).prev('label').find('i').hide();
								$(this).prev('label').find('i.bad_email').show();
								check_trigger = 1;
							}
							
							if ($(this).val() == ''){
								$(this).prev('label').find('i').show();
								$(this).prev('label').find('i.bad_email').hide();
								check_trigger = 1;
							}
					}
					
					if ($(this).hasClass('password_check')){
						if (pass_num == 0){
							pass = $(this).val();
							pass_num++;
						}else{
							if ($(this).val() != pass){
								$(this).parents('.open_window_check').find('.pass_empty').hide();
								$(this).parents('.open_window_check').find('.bad_password').show();
								check_trigger = 1;
							}
						}
					}
					
					
					if ($(this).hasClass('textarea_check')){
						if ($(this).val()=='Ваше сообщение'){
							$(this).addClass('textarea_error');
							check_trigger = 1;
						}
					}
					
				});
				
				
				
				if (check_trigger != 0){
					return false;
				}
			});
			
			
			//ввод сообщения в текстовое поле
			$('.textarea_check').focus(function(){
					$(this).removeClass('textarea_error');
				if ($(this).val() == '' || $(this).val() == 'Ваше сообщение'){
					$(this).val('');
				}
				
			}).blur(function(){
				if ($(this).val() == '' || $(this).val() == 'Ваше сообщение'){
					$(this).val('Ваше сообщение');
				}
				
			});
	
});






