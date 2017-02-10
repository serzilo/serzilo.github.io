$(document).ready(function(){
	//social buttons
	$(".news_item_comms a").on('click', function(){
		var el = $(this);
		if (el.hasClass('active')){
			el.removeClass('active');
			var cols = parseInt(el.find('span').text())-1;
			if (cols == 0){
				cols = '';
			}
			el.find('span').text(cols);
		}else{
			el.addClass('active');
			var cols = parseInt(el.find('span').text());
			if (isNaN(cols)){
				cols = 0;
			}
			el.find('span').text(cols+1);
		}
		return false;
	});
	
	
	//gallery
	var images_length = $(".gallery_preview ul li").length;
	var current_image = 0;
	
	$(".gallery_nav input").on('click',function(){
		$(".gallery_preview ul li[data-id="+current_image+"]").addClass('hide');
		var el = $(this);
		
		if (el.hasClass("right_button")){
			current_image+=1;
			if (current_image>=images_length){
				current_image=0;
			}
		}else{
			current_image-=1;
			if (current_image<0){
				current_image=images_length-1;
			}
		}
		
		$(".gallery_preview ul li[data-id="+current_image+"]").removeClass('hide');
		
		$(".gallery_nav .cols").text((current_image+1)+"/"+images_length);
	})
	
});