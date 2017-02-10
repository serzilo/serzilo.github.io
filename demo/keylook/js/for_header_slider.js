$(document).ready(function(){

	//
	//слайдер
	//
	
	//расставляем контролы
	function resize_window_header_slide_controls(){
		if ($(window).width()<1250){
			$('#next_header_slide').css({'right':'35px'});
			$('#prev_header_slide').css({'left':'35px'});
			$('span.inner_header_slider_content').css({'margin-top':'0px'});
		}else{
			$('#next_header_slide').css({'right':'116px'});
			$('#prev_header_slide').css({'left':'116px'});
			$('span.inner_header_slider_content').css({'margin-top':'27px'});
			}
		}

	resize_window_header_slide_controls()
	$(window).resize(resize_window_header_slide_controls);
	
	//var wrap_all_first_slides = $('.items').wrapAll('<div class="wrap_all_first_slides" />');
	var sliders_number_first = $('.items').length;
	
	var sliders_number, slide_width, wrap_slides_width, margin_for_current_slide;
	var current_slide_number = 0;
	
	function onresize_recount(){
		sliders_number = $('.items').length;
		slide_width = $('#for_header_slider').first().width();
		$('.items').width(slide_width+'px');
		
		wrap_slides_width = sliders_number * slide_width;
		$('#wrap_slides').width(wrap_slides_width+'px');
		
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
		$('#wrap_slides').css({'left':'-'+margin_for_current_slide+'px'});
	}
	
	//вперед
		var time = 4000;
		var end = 'next_good';
		var check_it = 0;
	$('#next_header_slide').click(function(){
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
		
		$('#wrap_slides').animate({'left':'-'+margin_for_current_slide+'px'},1000);
			
		}else{
			end = 'prev_good';
			
		}
		
		if (check_it+1==sliders_number){
			$('#next_header_slide').hide();
			$('#prev_header_slide').show();
		}else{
			$('#next_header_slide').show();
		}
			$('#prev_header_slide').show();
		//alert(current_slide_number+'и'+margin_for_current_slide);

	});
	
	
	
	$('#prev_header_slide').click(function(){
			//alert(current_slide_number);
		if (check_it>0){
			current_slide_number = current_slide_number - 1;
			check_it = check_it - 1;
			
			onresize_recount();
			$('#wrap_slides').animate({'left':'-'+margin_for_current_slide+'px'},1000);
			end = 'prev_good';
		}else{
			end = 'next_good';
		}
		//alert(current_slide_number+'и'+margin_for_current_slide);
		if (check_it==0){
			$('#prev_header_slide').hide();
			$('#next_header_slide').show();
		}else{
			$('#prev_header_slide').show();
		}
		$('#next_header_slide').show();
	});
	
	
	
	
	
	
	onresize_recount();
	$(window).resize(onresize_recount);	
	$(window).resize(resize_width);	


	//в цикл всё это
	
	
	var bn, bp;
	function move_it_next(){
		$('#next_header_slide').click();
		if (end !=='next_good'){
			next_clear();
			move_it_prev();
			bp = setInterval(move_it_prev, time);
		}
		
		if (check_it+1==sliders_number){
			$('#next_header_slide').hide();
		}else{
			$('#next_header_slide').show();
		}
	}
	
	function move_it_prev(){
		$('#prev_header_slide').click();
		if (end !=='prev_good'){
			prev_clear();
			move_it_next();
			bn = setInterval(move_it_next, time);
		}
		
		if (check_it==0){
			$('#prev_header_slide').hide();
		}else{
			$('#prev_header_slide').show();
		}
		
	}
	
	function next_clear(){
		bn = window.clearInterval(bn);
	}
	
	function prev_clear(){
		bp = window.clearInterval(bp);
	}
	
	
	
	 bn = setInterval(move_it_next, time);
	//var bp = setInterval(move_it_prev, time);
		


	$('#prev_header_slide .button_block, #next_header_slide .button_block').click(function(){
		bp = window.clearInterval(bp);
		bn = window.clearInterval(bn);
	});

});	