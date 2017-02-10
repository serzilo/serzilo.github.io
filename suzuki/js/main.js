$(document).ready(function(){
	//gallery
	$(".gallery_nav a").on('click',function(){
		var el = $(this);
		$(".gallery_nav a").removeClass('active');
		el.addClass('active');
		
		$(".gallery_pics a").hide();
		var toShow = el.data('id');
		
		console.log(toShow);
		$('#'+toShow).show();
		
		return false;
	});
	
	//inner_gallery_tumbs
	$(".inner_gallery_tumbs a").on('click',function(){
		var el = $(this);
		
		if (!el.hasClass('active')){
			$(".inner_gallery_tumbs a").removeClass('active');
			el.addClass('active');
			
			var el_href = el.attr('href');
			console.log(el_href);
			
			$('#full_image').attr('src',el_href);
		}
		return false;
	});
	
	//city selector
	$(".selected_city").on('click',function(){
		if ($('.cities').hasClass('hide')){
			$('.cities').removeClass('hide');
		}else{
			$('.cities').addClass('hide');
		}
	});
	
});