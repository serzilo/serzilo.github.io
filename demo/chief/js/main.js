$(document).ready(function(){
	//
	/*$('#menu ul li').last().css({'background':'none','width':'187px'}).addClass('last_button');

	if ($.browser.msie && $.browser.version.substr(0,1)==9){
		$('#menu ul li').last().css({'padding-left':'26.5px','padding-right':'27px'});
	}
	
	if ($.browser.mozilla && $.browser.version.substr(0,1)==5){
		$('#menu ul li').last().css({'width':'185px'});
		
	}
	*/
	
	//логин/пароль/поиск
	$('input#login, input#pass, input#search').focus(function(){
		if ($(this).val() == $(this).attr('title')){
			$(this).parent().find('label').hide();
		}
	});
	
	$('input#login, input#pass, input#search').blur(function(){
	if ($(this).val().length == 0 || $(this).val() == $(this).attr('title')){
			$(this).parent().find('label').show();
		}
	});

	$('.wrap_input_elements label').click(function(){
		$(this).parent().find('input').focus();
	});
	
	if ($.browser.msie && $.browser.version.substr(0,1)==9){
		$('#menu ul li a').css({'padding-left':'26.5px','padding-right':'27px'});
	}
	
	if ($.browser.mozilla && $.browser.version.substr(0,1)==5){
		$('#menu ul li a').css({'padding-left':'27px','padding-right':'27px'});
	}
	
	//новый номер
	$('.hot_number').click(function(){
		window.location='new.html';
	});
	
	
	//
	$('#add_some_pictures').click(function(){
		$('#preview_block img.hide_it').first().removeClass('hide_it');
		if ($('#preview_block img.hide_it').length ==0){
			$('#add_some_pictures').hide();
		}
	});
	
	//fancybox
	$('.archive_link').fancybox();
	
	
	

	
});






