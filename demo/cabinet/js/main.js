var cur = 0;
var speed = 500;

$(document).ready( function() {
    $('.input_inlinetitle').each( function() {
        if ($(this).val()=='') {
            $(this).val($(this).attr('title'));
            $(this).css('color', '#7e7157');
        } else {
            $(this).css('color', '#000');
        }
    });
    $('.input_inlinetitle').blur( function() {
        if ($(this).val()=='') {
            $(this).val($(this).attr('title'));
            $(this).css('color', '#7e7157');
        } else {
            $(this).css('color', '#000');
        }
    });
    $('.input_inlinetitle').focus( function() {
        if ($(this).val()==$(this).attr('title')) {
            $(this).val('');
            $(this).css('color', '#000');
        }
    });
    if ($('.bigthing').length) {
        $('.bigthing').hide();

        var slides = [];
        $('.bigthing').each( function() {
            slides.push($(this));
        });
        cur = Math.floor(Math.random()*slides.length);
        slides[cur].show();

        function nextSlide() {
            var old = cur;
            cur++;
            if (cur==slides.length) {
                cur = 0;

            }

            slides[cur].css('z-index', parseInt(slides[old].css('z-index'))+1);
            slides[cur].fadeIn(speed);
            setTimeout( function(slides,old) {
                slides[old].hide();
            }, speed, slides, old);
        }

        function prevSlide() {
            var old = cur;
            cur--;
            if (cur==-1)
                cur = slides.length-1;

            slides[cur].css('z-index', parseInt(slides[old].css('z-index'))+1);
            slides[cur].fadeIn(speed);
            setTimeout( function(slides,old) {
                slides[old].hide();
            }, speed, slides, old);
        }

        window.setInterval(nextSlide, 10000);
    }

	
	
	
	
	
	
	
	
	//разворачивающееся меню
	$('ul.cabinet_left_menu li ul').hide();
	$('ul.cabinet_left_menu li').toggle(function(){
		$(this).find('ul').show();
		$(this).find('span').css({'background-position': '95% 3px'});
	},function(){
		$(this).find('ul').hide();
		$(this).find('span').css({'background-position': '95% -35px'});
	});
	
	//валидация почты
	$('input#email, input#file_description').focus(function(){
		$(this).css('border-bottom','2px solid #7e7e7d').next('label').css('color','#7B7871');
	});
	
	var reg = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
	$('#edit_profile').click(function(){
		$('#hidden').focus();
		var userEmail = $('input#email').val();
		
		if (userEmail.search(reg) == -1){
		$('input#email').css('border-bottom','2px solid red').next('label').css('color','red');
		}
		
	});
	
	
		//проверка, ввел ли пользователь название для загружаемого файла
	$('#download_file').click(function(){
		
		$('#hidden').focus();
		var fileDescription = $('input#file_description').val();
		
		if (fileDescription == ''){
			$('input#file_description').css('border-bottom','2px solid red').next('label').css('color','red');
		}
		
	});
	

	
	//форма входа
		//вводим логин
	$('input#login').focus(function(){
		if ($(this).val() == $(this).attr('title')){
			$(this).val('');
		}
	});
		//вводим пароль
	$('input#password').focus(function(){
		$('.solodblock-header__login_window span').hide();
		if ($(this).val() == $(this).attr('title')){
			$(this).val('');
		}
	});
		//блур (логин)
	$('input#login').blur(function(){
	if ($(this).val().length == 0 || $(this).val() == $(this).attr('title')){
			$(this).val($(this).attr('title'));
		}
	});
	
	//возвращаем надпись пароль
	$('input#password').blur(function(){
	if ($(this).val().length == 0 || $(this).val() == $(this).attr('title')){
			$('.solodblock-header__login_window span').show();
		}
	});
	
	
	//убираем надпись пароль
	$('.solodblock-header__login_window span').click(function(){
		$(this).hide();
		$('input#password').focus();
	});
	
	//открываем / закрываем окно авторизации
	/*$('.open_login_menu').toggle(function(){
		$('.solodblock-header__login_window').show();
		return false;
	},function(){
		$('.solodblock-header__login_window').hide();
		return false;
	});*/
	
	//чтобы окно авторизации корректно работало в ie
	//if ($.browser.msie){
	//	$('.solodblock-header').css({'z-index':'99999'});
	//}
	
	
	
	
	//расставляем цифры для документов
	var ol_elements = $('ol.files li');
		ol_elements.each(function(index){
			index++;
			$(this).prepend('<span class=\"li_number\">'+index+'</span>');
			
		});
	
	
	$("#cabinet_login a").fancybox({
		'titlePosition'		: 'inside',
		'transitionIn'		: 'none',
		'transitionOut'		: 'none'});
	
	
	
	
	//заявка
	var checked_destination = $(":radio[name=otguzka]:checked").val();
			show_form(checked_destination);
		
	$(":radio[name=otguzka]").change(function(){
			var otgruzka = $(this).val();
			show_form(otgruzka);
	});
	
	//выведем выделенный пункт формы
	function show_form(otgruzka){
				switch (otgruzka){  
				case "samovivioz":  
					$('.hide_it').hide();
					$('.samovivioz').show();
				break;
				
				case "sklad":  
					$('.hide_it').hide();
					$('.sklad').show();
				break;
				}; //switch
	}
	
	
	
	//выведем выпадающий список
	
	$('.class_for_spisok').focus(function(){
		$(this).attr('disabled','disabled');
		$(this).parent().find('select').show().focus();
		}
	);
	
	$('.select_needed_item').change(function(){
		var choice = $(this).find('option:selected').text();
		$(this).parent().find('input').val(choice).removeAttr('disabled');
		$(this).hide();
		}
	).change();
	
	
	
	
		$('.select_needed_item').blur(function(){
			$(this).hide();
			$(this).parent().find('input').removeAttr('disabled');
		});

	
	
	
	
	
	
	
	
	
});
