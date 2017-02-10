$(document).ready(function(){
	//определяем количество файлов
	var files_length = $('.preview_attached_file').length;
		$('#all_count').text(files_length);
	
	//обрабатываем клик по ссылке Просмотреть
	$('a.show_hide_content').click(function(){
		var this_link = $(this);
		
		if ($(this_link).hasClass('clicked_link')){
			$('#show_block').hide();
			this_link.removeClass('clicked_link');
		}else{
			var this_id = this_link.data('id-link');
			
			var showPreviewContent = $('.preview_attached_file[data-id='+this_id+']').html();
			
			$('#show_block_content').html(showPreviewContent);
			
			$('#this_count').text(this_id);
			
			var pasteTo = this_link.parent().parent();
			$('#show_block').appendTo(pasteTo).show();
			
			$('a.show_hide_content').removeClass('clicked_link');
			this_link.addClass('clicked_link');
		}
		
		return false;
		
		
	});
	
	
	//обрабатываем клик по ссылкам назад/вперед
	$('#next_link').click(function(){
		var current_state = parseInt($('#this_count').text());
		
		if (current_state +1 > files_length){
			current_state = 1;
		}else{
			current_state +=1;
		}
		
		showNewAttach(current_state);
		
		return false;
	});
	
	
	
	$('#prev_link').click(function(){
		var current_state = parseInt($('#this_count').text());
		
		if (current_state -1 < 1){
			current_state = files_length;
		}else{
			current_state -=1;
		}
		
		showNewAttach(current_state);
		
		return false;
	});
	
	
	function showNewAttach(current_state){
		var current_stateShow = $('.preview_attached_file[data-id='+current_state+']').html();
		$('#this_count').text(current_state);
		$('#show_block_content').html(current_stateShow);
	}

});