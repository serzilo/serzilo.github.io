var pf_current = 0;
$(document).ready(function(){

		var html = '';
		for (var i in portfolio) {
			var w = portfolio[i];
			html += '<div id="works__work_'+i+'" class="works__work" title="'+w.title+'">';
			html += '<img id="works__work_'+i+'__preview" class="works__work__preview" src="'+w.preview+'" alt="'+w.title+'" />';
			html += '<div class="comment">'+w.title+'</div>';
			html += '</div>';
		}
		$('#full-works').html(html);
	
	
	// hide links
	eval(function(p,a,c,k,e,r){e=String;if(!''.replace(/^/,String)){while(c--)r[c]=k[c]||c;k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('$(\'#1\').0();',2,2,'fadeOut|links'.split('|'),0,{}));

});