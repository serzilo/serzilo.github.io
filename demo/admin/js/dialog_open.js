$(document).ready(function(){
//		$('td.dialog a').attr('target','_blank');
		$('td.dialog a').click(function(){
			window.open(
				'okno.html', 
				'okno', 
				'menubar = no, resizable = no, width = 350, height = 250, left = 100, top = 100'
			);
		});
});
