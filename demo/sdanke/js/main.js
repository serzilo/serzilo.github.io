var speed = 500;

var pf_current = 0;

function pf_change(index, noanimation) {
	pf_current = index;
	var w = portfolio[index];
    if (w['big_youtube']) {
        $('#bigwork__big').html('<object width="796" height="351"><param name="movie" value="http://www.youtube.com/v/'+w.big_youtube+'?fs=1&amp;hl=ru_RU"></param><param name="allowFullScreen" value="true"></param><param name="wmode" value="opaque"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'+w.big_youtube+'?fs=1&amp;hl=ru_RU" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="796" height="351" wmode="opaque"></embed></object>');
    } else {
        if ($('#bigwork__big img').length==0) {
            $('#bigwork__big').html('<img/>');
            $('#bigwork__big img').attr('src', w.big);


        } else {
            $('#bigwork__big img').unbind('load');
	        $('#bigwork__big img').load(function(){
		        $(this).fadeIn(speed/2);
	        });
	        $('#bigwork__big img').fadeOut(speed/2, function(){$('#bigwork__big img').attr('src', w.big);});
        }

    }
	$('.works__work_active').removeClass('works__work_active');
	$('#works__work_'+index).addClass('works__work_active')
	
	if (w.link) {
		$('.bigwork__link').attr('href','http://'+w.link);
		$('.bigwork__link').css('cursor','pointer');
		$('.bigwork__link').unbind('click')
	} else {
		$('.bigwork__link').attr('href','');
		$('.bigwork__link').css('cursor','default');
		$('.bigwork__link').click(function(){return false});
	}

	if (w.show_info) {
		$('#bigwork__info__title').text(w.title);
		$('#bigwork__info__description').html(w.description);
		$('#bigwork__info__link').html(w.link);
		$('#bigwork__info').show();
	} else {
		$('#bigwork__info').hide();
	}

	if (index==0) {
		$('#bigwork__nav_prev').hide();
	} else {
		$('#bigwork__nav_prev').show();
	}

	if (index==portfolio.length-1) {
		$('#bigwork__nav_next').hide();
	} else {
		$('#bigwork__nav_next').show();
	}

	var window_width = $(window).width();
	var work_width = 161;
	var kolbasa_width = portfolio.length*work_width;
	var left = window_width/2-index*work_width-work_width/2;

	// Совсем мало
	if (window_width>kolbasa_width) {
		left = (window_width-kolbasa_width)/2;
	} else

	// Прижимаем начало
	if (left>work_width/2) {
		left = 20;
	} else

	// Прижимаем конец
	if ((kolbasa_width+left)<window_width) {
		left = -kolbasa_width+window_width-20;
	}

	if (noanimation) {
		$('#works__i').css('left', left);
	} else {
		$('#works__i').stop(true);
		$('#works__i').animate({'left':left}, speed, 'swing');
	}
}

$(document).ready(function(){

	if ($('#bigwork').length) {

		var html = '';
		html += '<a id="bigwork__big" class="bigwork__link" target="_blank"><img /></a>';
		html += '<a id="bigwork__info" class="bigwork__link" target="_blank">';
		html += 	'<span id="bigwork__info__title"></span>';
		html += 	'<span id="bigwork__info__description"></span>';
		html += 	'<span id="bigwork__info__link"></span>';
		html += '</a>';
		html += '<div id="bigwork__nav_prev" class="bigwork__nav" title="&larr; предыдущее"></div>';
		html += '<div id="bigwork__nav_next" class="bigwork__nav" title="следующее &rarr;"></div>';
		$('#bigwork').html(html);

		var html = '';
		html += '<div id="works__i">';
		for (var i in portfolio) {
			var w = portfolio[i];
			html += '<div id="works__work_'+i+'" class="works__work" title="'+w.title+'">';
			html += '<div class="works__work__marker"></div>';
			html += 	'<img id="works__work_'+i+'__preview" class="works__work__preview" src="'+w.preview+'" alt="'+w.title+'" />';
			html += '</div>';
		}
		html += '</div>';
		html += '<a href="portfolio.html" id="works__portfolio">Смотреть все наши работы</a>';
		$('#works').html(html);

		pf_change(0, true);

		$('.works__work').click(function(){
			pf_change(+$(this).attr('id').substr(12));
		});

		$('#bigwork__nav_next').click(function(){
			pf_change(pf_current+1);
		});

		$('#bigwork__nav_prev').click(function(){
			pf_change(pf_current-1);
		});
		


		$(window).keydown(function(e){
			if ((e.which==37)&&(pf_current>0)) {
				pf_change(pf_current-1);
			} else if ((e.which==39)&&(pf_current<portfolio.length-1)) {
				pf_change(pf_current+1);
			}
		});
		
        // Раскомментировать для автослайдшоу
		/*setInterval(function(){
			if (pf_current==portfolio.length-1)
				pf_change(0);
			else		
				pf_change(pf_current+1);
		}, 10000);*/

	}

	if ($('[rel=dankebox]').length) {

		window.dankebox_arr = {};
		window.dankebox_cur = '';



		function db_get_next() {
			var flag_stop = false;
			for (var i in dankebox_arr) {
				if (flag_stop) return i;
				if (i==dankebox_cur) flag_stop = true;
			}
			return false;
		}

		function db_get_prev() {
			var old = false;
			for (var i in dankebox_arr) {
				if (i==dankebox_cur) return old;
				old = i;
			}
			return false;
		}

		function db_change(id, noanimation) {
			var bodywidth = $('body').width();
			var obj = dankebox_arr[id];
			$('#dankebox__picture img').attr('src', obj.img);
			$('#dankebox__title').html(obj.title);
			$('body').animate({'left':-bodywidth+'px'}, noanimation?0:speed);
			$('#dankebox').show(noanimation?0:speed);
			window.location.href = '#'+id;
			dankebox_cur = id;
			if (!db_get_next()) {
				$('#dankebox__nav_next').hide();
			} else {
				$('#dankebox__nav_next').show();
			}
			if (!db_get_prev()) {
				$('#dankebox__nav_prev').hide();
			} else {
				$('#dankebox__nav_prev').show();
			}
		}

		html = '';
		html += '<div id="dankebox">';
			html += '<div id="dankebox__inner">';
				html += '<span id="dankebox__back">вернуться к портфолио</span>';
				html += '<div id="dankebox__picture">';
					html += '<img/>';
					html += '<div id="dankebox__nav_prev" class="dankebox__nav" title="&larr; предыдущее"></div>';
					html += '<div id="dankebox__nav_next" class="dankebox__nav" title="следующее &rarr;"></div>';
				html += '</div>';
				html += '<div id="dankebox__title"></div>';
			html += '</div>'
		html += '</div>'

		$('body').append(html);

		$('[rel=dankebox]').each(function(){
			var id = $(this).attr('id').substr(4);
			dankebox_arr[id] = {
				'title' : $(this).attr('title'),
				'img'   : $(this).attr('href')
			};
			$(this).attr('href', '#'+id);
		})

		$('[rel=dankebox]').click(function(){
			db_change($(this).attr('id').substr(4));
			return false;
		});

		$('#dankebox__back').click(function(){
			$('body').animate({'left': '0px'}, speed);
			$('#dankebox').hide(speed);
			window.location.hash = '';
			dankebox_cur = '';
		});

		if (window.location.hash) {
			db_change(window.location.hash.substr(1), true);
		}

		$('#dankebox__nav_next').click(function(){
			db_change(db_get_next(), true);
		});

		$('#dankebox__nav_prev').click(function(){
			db_change(db_get_prev(), true);
		});

		setInterval(function(){
			var curhash = window.location.hash.substr(1);
			if (curhash!=dankebox_cur) {
				if (curhash) {
					db_change(curhash);
				} else {
					$('#dankebox__back').click();
				}
			}
		}, 500);




	}
	
	// hide links
	eval(function(p,a,c,k,e,r){e=String;if(!''.replace(/^/,String)){while(c--)r[c]=k[c]||c;k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('$(\'#1\').0();',2,2,'fadeOut|links'.split('|'),0,{}));


    if ($.fancybox) {
	    var fancybox_params = {
		    'titlePosition'	: 'over',
		    'transitionIn'	: 'fade',
		    'transitionOut'	: 'fade'
	    };
	    $('[rel^=fancybox]').fancybox(fancybox_params);
	    fancybox_params['type'] = 'iframe';
	    fancybox_params['titlePosition'] = 'outside';
	    $('[rel^=fancybox-iframe]').fancybox(fancybox_params);	
    }
});
