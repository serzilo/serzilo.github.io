$(document).ready(function(){
		//страница услуги, выводим блоки сверху
		function resize_wrap_services() {
				if ($(window).width() < 3000 ) {
					$('#wrap_services').width(1553);
				} 
			
				if ($(window).width() < 1557 ) {
					$('#wrap_services').width(1244);
				} 
				
				if ($(window).width() < 1252 ) {
					$('#wrap_services').width(930);
				} 

			}
    
			resize_wrap_services()
			$(window).resize(resize_wrap_services);	
			
			
});