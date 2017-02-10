$(document).ready(function(){

	//зименение отступов блоков в шапке
	function resize_window(){
		if ($(window).width()<1250){
			$('#header_logo').css({'left':'8px'});
			$('#bracket_menu').removeClass('bracket_menu');
		}else{
			$('#header_logo').css({'left':'66px'});
			$('#bracket_menu').addClass('bracket_menu');
			}
		}

	resize_window()
	$(window).resize(resize_window);
	
	//убираем фон у первой новости
	$('.news').first().css({'background':'none'});
	
	//video
	/*$("a#video_block_link").click(function(){
		$('#wrapper_for_video_block').removeClass('hide_it');
		$('#wrapper_for_video_block_shadow').removeClass('hide_it');
	}); 
	
	$('#wrapper_for_video_block_shadow').click(function(){
		$(this).addClass('hide_it');
		$('#wrapper_for_video_block').addClass('hide_it');
	})*/
	
	//высота линии на главной
	var left_column_height = $('.left_column_height').height();
	$('#right_vertical_dotted_line').height(left_column_height);
	
	//video
	//$('#video_block_link').fancybox();
	
	//close video
	$('#close_video_window').live('click', function(){
		$('#fancybox-overlay').click();
		return false;
	});
	
			//страница услуги, выводим блоки сверху
			function resize_wrap_services() {
				if ($(window).width() < 3000 ) {
					$('#wrap_services').width(1553);
				} 
				if ($(window).width() < 1557 ) {
					$('#wrap_services').width(1244);
				} 
				
				if ($(window).width() < 1330 ) {
					$('#wrap_services').width(969);
				}
				
				if ($(window).width() < 1070 ) {
					$('#wrap_services').width(800);
				}
			}
    
			resize_wrap_services()
			$(window).resize(resize_wrap_services);	
			
			
			//меняем зеленых блоков
	function changeauthors(){
		var story_block_width = 0;
		$('.service').each(function(){
			var this_height = $(this).find('i').height();
			if(this_height>story_block_width){
				story_block_width = this_height;
			}
		});
		
		$('.service i').css({'height': story_block_width+'px'});
			story_block_width = 0;
	}
	
	changeauthors();	
			
			
			
			//высота блоков на главной
			function changeBenefits(){
		var story_block_width = 0;
		$('.benefits_slide').each(function(){
			var this_height = $(this).find('i').height();
			if(this_height>story_block_width){
				story_block_width = this_height;
			}
		});
		
		$('.benefits_slide i').css({'height': story_block_width+'px'});
			story_block_width = 0;
	}
	
	changeBenefits();	
			
			
			
			
			
			
	//faq

		//нумерация
		var fa_numbers = $('#wrap_qa span.qa_number');
		var kolvo_fa = kolvo = fa_numbers.length;
		
		fa_numbers.each(function(){
			$(this).text(kolvo_fa);
			kolvo_fa -=1;
		});
		
		
		//сколько выводим
		var numPerPage = 5;
		var currentPage = 0;
		
		var more_than = numPerPage + 1;
		if (fa_numbers.length< more_than){
			$('#next_fa_page').hide();
		}		
		
		$('div.qa').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
		
		repaginate = function(){
			$('#wrap_qa').fadeOut('slow',function(){
				$('div.qa').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
			});
			
			$('#wrap_qa').fadeIn('slow');
		};
	
		
		//количество выводов
		var numPages = Math.ceil(kolvo / numPerPage);
		
		function fade(){
			$('#wrap_qa').fadeOut('slow');
		};
			
		$('#next_fa_page').click(function(){

				currentPage++;
				if (currentPage>numPages-1){
				currentPage=numPages-1;
		}

		//убираем кнопку
		if (currentPage>numPages-2){
			$(this).hide();
		}
		repaginate();
		$('#prev_fa_page').show();
		return false;
		});
	
	
	
		$('#prev_fa_page').click(function(){
			currentPage--;
		if (currentPage<0){
			currentPage = 0;
			//currentPage=numPages+1;
		}
		
		//убираем кнопку
		if (currentPage<1){
			$(this).hide();
		}
		repaginate();
		$('#next_fa_page').show();
		
		
		return false;
		});		
			
			
			
			
			
			
			
	
});