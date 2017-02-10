$(document).ready(function(){

	//зименение отступов блоков в шапке
	function resize_window(){
		if ($(window).width()<1250){
			$('#header_logo').css({'left':'8px'});
		}else{
			$('#header_logo').css({'left':'66px'});
			}
		}

	resize_window()
	$(window).resize(resize_window);
	
	
	//добавляем классы к превьюшкам
	var tumb_number = group_number = 1;
	$('#wrapper_to_move .tumb').each(function(){
		$(this).attr('rel','slide_group'+tumb_number);
		tumb_number +=1;
	});
	
	$('#hided_groups .group').each(function(){
		$(this).addClass('slide_group'+group_number);
		group_number +=1;
	});
	
	
		
	//
	//слайдер
	//
	
	//var wrap_all_first_slides = $('.items').wrapAll('<div class="wrap_all_first_slides" />');
	var sliders_number_first = $('#place_for_items .slide_item').length;
	
		if (sliders_number_first < 2){
			$('#move_next').hide();
		}
	
	var sliders_number, slide_width, wrap_slides_width, margin_for_current_slide;
	var current_slide_number = 0;
	
	function onresize_recount(){
		sliders_number = $('#place_for_items .slide_item').length;
		if (sliders_number == 0){
			$('#move_next').hide();
		}
		slide_width = $('body').first().width();
		$('#place_for_items .slide_item').width(slide_width+'px');
		
		wrap_slides_width = sliders_number * slide_width;
		$('#place_for_items').width(wrap_slides_width+'px');
		
		//margin_for_current_slide = slide_width*current_slide_number;
		if (current_slide_number==0){
			margin_for_current_slide = 0;
		}else{
			margin_for_current_slide = slide_width*current_slide_number;
		//alert(margin_for_current_slide);
		//$('#wrap_slides').css({'left':'-'+margin_for_current_slide-slide_width+'px'});
		}
	}
	
	
	function resize_width(){
		$('#place_for_items').css({'left':'-'+margin_for_current_slide+'px'});
	}
	
	//вперед
		var time = 4000;
		var end = 'next_good';
		var check_it = 0;
	$('#move_next').click(function(){
		//alert(check_it);
		//
		//check_it = check_it + 1;
		
		//alert(check_it);
		//if(sliders_number%current_slide_number !=0){
		
		if (check_it+1<sliders_number){
			current_slide_number = current_slide_number + 1;
			check_it = check_it + 1;
			onresize_recount();
			
			end = 'next_good';
		//$('#wrap_slides').css({'left':'-'+slide_width+'px'});
		//var left_margin = parseInt($('#wrap_slides').css('left'));
		
		$('#place_for_items').animate({'left':'-'+margin_for_current_slide+'px'},1000);
			
		}else{
			end = 'prev_good';
			
		}
		
		if (check_it+1==sliders_number){
			$('#move_next').hide();
			$('#move_prev').show();
		}else{
			$('#move_next').show();
		}
			$('#move_prev').show();
		//alert(current_slide_number+'и'+margin_for_current_slide);

	});
	
	
	
	$('#move_prev').click(function(){
			//alert(current_slide_number);
		if (check_it>0){
			current_slide_number = current_slide_number - 1;
			check_it = check_it - 1;
			
			onresize_recount();
			$('#place_for_items').animate({'left':'-'+margin_for_current_slide+'px'},1000);
			end = 'prev_good';
		}else{
			end = 'next_good';
		}
		//alert(current_slide_number+'и'+margin_for_current_slide);
		if (check_it==0){
			$('#move_prev').hide();
			$('#move_next').show();
		}else{
			$('#move_prev').show();
		}
		$('#move_next').show();
	});
	
	
	
	
	
	
	onresize_recount();
	$(window).resize(onresize_recount);	
	$(window).resize(resize_width);	


	//в цикл всё это
	
	
	var bn, bp;
	function move_it_next(){
		$('#move_next').click();
		if (end !=='next_good'){
			next_clear();
			move_it_prev();
			bp = setInterval(move_it_prev, time);
		}
		
		if (check_it+1==sliders_number){
			$('#move_next').hide();
		}else{
			$('#move_next').show();
		}
	}
	
	function move_it_prev(){
		$('#move_prev').click();
		if (end !=='prev_good'){
			prev_clear();
			move_it_next();
			bn = setInterval(move_it_next, time);
		}
		
		if (check_it==0){
			$('#move_prev').hide();
		}else{
			$('#move_prev').show();
		}
		
	}
	
	function next_clear(){
		bn = window.clearInterval(bn);
	}
	
	function prev_clear(){
		bp = window.clearInterval(bp);
	}
	
	
	
	// bn = setInterval(move_it_next, time);
	//var bp = setInterval(move_it_prev, time);
		


	$('#move_prev .button_block, #move_prev .button_block').click(function(){
		bp = window.clearInterval(bp);
		bn = window.clearInterval(bn);
	});

			
			
	//кликаем на превьюшки
	$('#tumbs_big_wrapper .tumb').click(function(){
		if (!$(this).hasClass('clicked_tumb')){
		
		$('.tumb').removeClass('clicked_tumb');
		$(this).addClass('clicked_tumb');
		
		var this_rel = $(this).attr('rel');
		var to_paste_block = $('.'+this_rel);
		$('#place_for_items').empty();
		$(to_paste_block).clone().prependTo('#place_for_items');
		
		end = 'next_good';
		current_slide_number = 0;
		check_it = 0;
		margin_for_current_slide = 0;
		
		
		
		slide_width = $('body').first().width();
		$('#place_for_items .slide_item').width(slide_width+'px');
		
		wrap_slides_width = sliders_number * slide_width;
		$('#place_for_items').width(wrap_slides_width+'px');
		
		onresize_recount();
		resize_width();
		
		$('#move_prev').hide();
		$('#move_next').show();
		
		sliders_number = $('#place_for_items .slide_item').length;
		if (sliders_number < 2){
			$('#move_next').hide();
		}
		
		}
	});
	
	var tumbs_count = $('.tumb').length;
	if (tumbs_count > 6){
		$('#tumbs_down').show();
	}
	var clicked_counts_number = 0;
	var margin_top_for_tumbs = 92;
	
	//стрелки / вниз
	$('#tumbs_down').click(function(){
		$('#tumbs_up').show();
		clicked_counts_number +=1;
		tumbs_offset_top = clicked_counts_number * margin_top_for_tumbs
		$('#wrapper_to_move').animate({'margin-top': '-'+tumbs_offset_top + 'px'},500);
		
		if (tumbs_count - clicked_counts_number  == 6){
			$('#tumbs_down').hide();
		}
	});
	
	//стрелки / вврех
	$('#tumbs_up').click(function(){
		$('#tumbs_down').show();
		clicked_counts_number -=1;
		tumbs_offset_top = clicked_counts_number * margin_top_for_tumbs
		$('#wrapper_to_move').animate({'margin-top': '-'+tumbs_offset_top + 'px'},500);
		
		if (clicked_counts_number == 0){
			$('#tumbs_up').hide();
		}
	});
	
	//спрятать превьюшки
	$('#hide_tumbs').toggle(function(){
		$(this).text('показать');
		$('#this_will_be_hided').hide();
		$('#move_prev').css({'left':'80px'});
	},function(){
		$(this).text('скрыть');
		$('#move_prev').css({'left':'265px'});
		$('#this_will_be_hided').show();
	});
	

			
	
});






