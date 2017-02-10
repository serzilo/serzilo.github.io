$(document).ready(function(){

	
	
		
	//
	//слайдер
	//
	
	//var wrap_all_first_slides = $('.items').wrapAll('<div class="wrap_all_first_slides" />');
	var sliders_number_first = $('.dealers_slider').length;
	
	var sliders_number, slide_width, wrap_slides_width, margin_for_current_slide;
	var current_slide_number = 0;
	
	function onresize_recount(){
		sliders_number = $('.dealers_slider').length;
		slide_width = $('#for_slider_dealers_block').width();
		$('.dealers_slider').width(slide_width+'px');
		
		wrap_slides_width = sliders_number * slide_width;
		$('#main_slider_dealers_wrapper').width(wrap_slides_width+'px');
		
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
		$('#main_slider_dealers_wrapper').css({'left':'-'+margin_for_current_slide+'px'});
	}
	
	//вперед
		var time = 4000;
		var end = 'next_good';
		var check_it = 0;
	$('#next_dealer_slide').click(function(){
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
		
		$('#main_slider_dealers_wrapper').animate({'left':'-'+margin_for_current_slide+'px'},1000);
			
		}else{
			end = 'prev_good';
			
		}
		
		if (check_it+1==sliders_number){
			$('#next_dealer_slide').hide();
			$('#prev_dealer_slide').show();
		}else{
			$('#next_dealer_slidet').show();
		}
			$('#prev_dealer_slide').show();
		//alert(current_slide_number+'и'+margin_for_current_slide);

	});
	
	
	
	$('#prev_dealer_slide').click(function(){
			//alert(current_slide_number);
		if (check_it>0){
			current_slide_number = current_slide_number - 1;
			check_it = check_it - 1;
			
			onresize_recount();
			$('#main_slider_dealers_wrapper').animate({'left':'-'+margin_for_current_slide+'px'},1000);
			end = 'prev_good';
		}else{
			end = 'next_good';
		}
		//alert(current_slide_number+'и'+margin_for_current_slide);
		if (check_it==0){
			$('#prev_dealer_slide').hide();
			$('#next_dealer_slide').show();
		}else{
			$('#prev_dealer_slide').show();
		}
		$('#next_dealer_slide').show();
	});
	
	
	
	
	
	
	onresize_recount();
	$(window).resize(onresize_recount);	
	$(window).resize(resize_width);	


	//в цикл всё это
	
	
	var bn, bp;
	function move_it_next(){
		$('#next_dealer_slide').click();
		if (end !=='next_good'){
			next_clear();
			move_it_prev();
			bp = setInterval(move_it_prev, time);
		}
		
		if (check_it+1==sliders_number){
			$('#next_dealer_slide').hide();
		}else{
			$('#next_dealer_slide').show();
		}
	}
	
	function move_it_prev(){
		$('#prev_dealer_slide').click();
		if (end !=='prev_good'){
			prev_clear();
			move_it_next();
			bn = setInterval(move_it_next, time);
		}
		
		if (check_it==0){
			$('#prev_dealer_slide').hide();
		}else{
			$('#prev_dealer_slide').show();
		}
		
	}
	
	function next_clear(){
		bn = window.clearInterval(bn);
	}
	
	function prev_clear(){
		bp = window.clearInterval(bp);
	}
	
	
	
	 //bn = setInterval(move_it_next, time);
	//var bp = setInterval(move_it_prev, time);
		


	$('#prev_dealer_slide .button_block, #next_dealer_slide .button_block').click(function(){
		bp = window.clearInterval(bp);
		bn = window.clearInterval(bn);
	});

			
			
	//слайдеры в шапке
	var slider_header = $('#for_header_slides_wrap').bxSlider({
				mode: 'fade',
				auto: true,
				speed: 1000,
				pause:4000,
				controls: false
			});
			
			$('#prev_header_slide_button').click(function() {
				slider_header.goToPreviousSlide();
				return false;
			});
			
			$('#next_header_slide_button').click(function() {
				slider_header.goToNextSlide();
				return false;
			});
			
			
			
			var slider_header2 = $('#benefits_slider').bxSlider({
				auto: true,
				speed: 1000,
				pause:4000,
				displaySlideQty: 5,
				moveSlideQty: 1,
				controls: false
			});
			
			$('#prev_header_slide_button').click(function() {
				slider_header2.goToPreviousSlide();
				return false;
			});
			
			$('#next_header_slide_button').click(function() {
				slider_header2.goToNextSlide();
				return false;
			});
			
			function resize_wrap_for_second_slider() {
				if ($(window).width() < 3000 ) {
					$('#horizontal_wrapper').width(1553);
				} 
			
				if ($(window).width() < 1557 ) {
					$('#horizontal_wrapper').width(1244);
				} 
				
				if ($(window).width() < 1252 ) {
					$('#horizontal_wrapper').width(930);
				} 

			}
    
			resize_wrap_for_second_slider()
			$(window).resize(resize_wrap_for_second_slider);	
			
			
	
		
		

			
	
});






