$(document).ready(function(){
//		$('td.dialog a').attr('target','_blank');

		$('td.dialog a').click(function(){			
				openWindow(this.href,'wind',450,573)
				return false;
		});
});

function openWindow(document,name,width,height) {
  opened_window = window.open(document,name,'width='+width+',height='+height+',scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=300,top=300', true);
  opened_window.focus();
} 
