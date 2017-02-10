$(document).ready(function(){
	//выпадающие списки в поисковой строке
	$('.search_control').click(function(){
		$(this).find('ul').toggle();
	});
	
	//выбираем подрубрики
	$('.filed_block i').click(function(){
		var add_class_item = $(this).parent();
		if (add_class_item.hasClass('first_item')){
			add_class_item.addClass('first_clicked_item');
		}else{
			add_class_item.addClass('clicked_item');
		};
	});
	
	//прячем-показываем выбор рубрик
	$('#field_chooser .hide_choice').click(function(){
		$(this).toggleClass('show_choice');
		$('#fileds_block_hide').slideToggle('show_choice');
		if ($('#field_chooser .hide_choice').text() == 'Свернуть'){
			$('#field_chooser .hide_choice').text('Развернуть');
		}else{
			$('#field_chooser .hide_choice').text('Свернуть');
		}
	});
	
	//сбросить выбор рубрик
	$('#field_chooser .reset').click(function(){
		$('#fileds_block_hide span').removeClass('clicked_item').removeClass('first_clicked_item');
		
	});
	
	//
	$('#filed h2').click(function(){
		$('#field_chooser .hide_choice').click();
	});
	
});






