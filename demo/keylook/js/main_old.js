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
	
	
	
	
	
	
	//
	//Slider
	//
	
	
	
	
	//количество слайдов
	var sliders_number = $('.slide_to_show').length;
	
	
	//фоны слайдов в массив
	var pictures =[];
	$('.slide_to_show').each(function(){
		//var bg_image = $(this).css('background-image');
		var bg_image = $(this).attr('style').substr(18);
		pictures.push(bg_image);
		
		
	});
	
	//меняем ширину и обертку при ресайзинге
	var slide_width, wrapper_width;
	function onresize_recount(){
		slide_width = $('body').width();
		$('.slide_item').width(slide_width+'px');
		
		wrapper_width = 3 * slide_width;
		$('#place_for_items').width(wrapper_width+'px');
	}
	
	//делаем второй слайд центральным
	var wrapper_left_offset = '-'+($('body').width())+'px';
	$('#place_for_items').css({'margin-left':wrapper_left_offset});
	
	onresize_recount();
	$(window).resize(onresize_recount);	
	
	var current_slide = -1;
	var bt, bn;
	var bz = 0;
	var trigger = 0;
	var next_slide = prev_slide = 0;
	function move_next(){
		tumbs_move_down();
		error = 0;
		next_slide = 1;
		prev_slide = 0;
		$('span#move_prev').show();
		var margin_left = slide_width * 2;
		$('#place_for_items').animate({'margin-left':'-'+ margin_left +'px' },1000,function(){
			$('#slide_block_1').css('background-image',pictures[current_slide+1]);
			$('#slide_block_2').css('background-image',pictures[current_slide+2]);
			$('#place_for_items').css({'margin-left':'-'+ slide_width +'px'});
			$('#slide_block_3').css('background-image',pictures[current_slide+3]);
			
				if(current_slide+3 == pictures.length){
					error = 1;
					
					next_slide = 0;
					$('span#move_next').hide();
					bn = window.clearInterval(bn);
					current_slide += 1;
					if (trigger == 0){
							bt = setInterval(setMoveItPrev, time);
						}
				};
			current_slide += 1;
		});
	}
	
	
	var time = 2000;
	var error = 0;
	
	function move_prev(){
		next_slide = 0;
		prev_slide = 1;
		$('span#move_next').show();
		var margin_left = 0;
		error = 0;
		tumbs_move_up();
		
		
		var item_to_animate = $('#place_for_items');
		item_to_animate.animate({'margin-left':'0px' },1000,function(){
			$('#slide_block_3').css('background-image',pictures[current_slide]);
			$('#slide_block_1').css('background-image',pictures[current_slide-2]);
			$('#slide_block_2').css('background-image',pictures[current_slide-1]);
			item_to_animate.css({'margin-left':'-'+ slide_width +'px'});
			
				if(current_slide-1 == 0){
					error = 2;
					prev_slide = 0;
					$('span#move_prev').hide();
					bt = window.clearInterval(bt);
					current_slide -= 1;
					if (trigger == 0){
								bn = setInterval(setMoveItNext, time);
						}
					
				};
			current_slide -= 1;
		});
	}
	
	var wrapper_height = $('#tumbs_big_wrapper').height();
	var wrapper_to_move = $('#wrapper_to_move');
	var tumb_add_class = 1;
	function tumbs_move_down(){
		var tumbs_wrapper_top_offset = parseInt(wrapper_to_move.css('margin-top'));
		var tumbs_height = wrapper_to_move.height();
		var new_offset = tumbs_wrapper_top_offset - 91;
		var raznost = parseInt(tumbs_height) - parseInt(wrapper_height);
		$('#tumbs_up').show();
		
		
		$('.tumb').removeClass('clicked_tumb');
		tumb_add_class +=1;

		$('#wrapper_to_move .tumb').each(function(){
			if ($(this).hasClass('number'+tumb_add_class)){
				$(this).addClass('clicked_tumb');
			}
		});
		
		
		
		if (Math.abs(new_offset) > (raznost)){
				$('#tumbs_down').hide();
				new_offset = - (raznost);
			}
		$('#wrapper_to_move').animate({'margin-top':new_offset+'px'},1000);
	}

	function tumbs_move_up(){
		var tumbs_wrapper_top_offset = parseInt(wrapper_to_move.css('margin-top'));
		var tumbs_height = wrapper_to_move.height();
		var new_offset = tumbs_wrapper_top_offset + 92;
		$('#tumbs_down').show();
		
		//$('.tumb').removeClass('clicked_tumb');
		tumb_add_class -=1;
		$('#wrapper_to_move .tumb').each(function(){
			if ($(this).hasClass('number'+tumb_add_class)){
				//$(this).addClass('clicked_tumb');
			}
		});
		
		if (new_offset > 0 || new_offset ==0){
				$('#tumbs_up').hide();
				new_offset = 0;
			}
		$('#wrapper_to_move').animate({'margin-top':new_offset+'px'},1000);
	}
	
	function setMoveItNext(){
		move_next();
	}
	
	function setMoveItPrev(){
		move_prev();
	}
	
	bn = setInterval(setMoveItNext, time);
	
	$('span#move_next').click(function(){
			bt = window.clearInterval(bt);
			bn = window.clearInterval(bn);
			$('span#move_prev').show();
			trigger = 1;
			if (prev_slide == 1){
				current_slide -= 1;
				prev_slide = 0;
			}
			
				move_next();
			
		}
	);
	
	$('span#move_prev').click(function(){
			bt = window.clearInterval(bt);
			bn = window.clearInterval(bn);
			$('span#move_next').show();
			if (next_slide == 1){
				current_slide += 1;
				next_slide = 0;
			}
			trigger = 1;
			
				move_prev();
			
			
		}
	);
	
	
	//стрелки для превьюшек
	$('#tumbs_down').click(function(){
		$('span#move_next').click();
	});
	
	$('#tumbs_up').click(function(){
		$('span#move_prev').click();
	});
	
	prev_rel = 0;
	$('#wrapper_to_move .tumb').click(function(){
		$('.tumb').removeClass('clicked_tumb');
		$(this).addClass('clicked_tumb');
		
		tumb_add_class = parseInt($(this).attr('rel'))-1;
		var tumb_add = tumb_add_class + 1;
		//tumb_add_class = 0;
		bt = window.clearInterval(bt);
		bn = window.clearInterval(bn);
		//alert(tumb_add_class +":"+prev_rel);
		
		var trigg = 0;
		if (tumb_add > prev_rel){
				$('#slide_block_3').css('background-image',pictures[tumb_add_class]);
				current_slide = tumb_add_class - 2;
				move_next();
				trigg = 1;
		}else{
				if (trigg ==1){
					current_slide +=2;
					tumb_add_class += 2;
					trig = 2;
				}
				$('#slide_block_1').css('background-image',pictures[tumb_add_class]);
				current_slide = tumb_add_class + 1;
				move_prev();

				//alert(2);
				//tumb_add_class +=2;
				//alert(tumb_add_class);
		}
		prev_rel = tumb_add-1;
		
		trigger = 1;
	});
	
	//вешаем классы на .tumbs
	var tumb_number = 1;
	$('#wrapper_to_move .tumb').each(function(){
		$(this).addClass('number'+tumb_number).attr('rel',tumb_number);
		tumb_number = tumb_number + 1;
	});
	
	
});






