(function($) {

	// jQuery plugin definition
	$.fn.TextAreaExpander = function(minHeight, maxHeight) {

		var hCheck = !($.browser.msie || $.browser.opera);

		// resize a textarea
		function ResizeTextarea(e) {

			// event or initialize element?
			e = e.target || e;

			// find content length and box width
			var vlen = e.value.length, ewidth = e.offsetWidth;
			if (vlen != e.valLength || ewidth != e.boxWidth) {

				if (hCheck && (vlen < e.valLength || ewidth != e.boxWidth)) e.style.height = "0px";
				var h = Math.max(e.expandMin, Math.min(e.scrollHeight, e.expandMax));

				e.style.overflow = (e.scrollHeight > h ? "auto" : "hidden");
				e.style.height = h + "px";

				e.valLength = vlen;
				e.boxWidth = ewidth;
			}

			return true;
		};

		// initialize
		this.each(function() {

			// is a textarea?
			if (this.nodeName.toLowerCase() != "textarea") return;

			// set height restrictions
			var p = this.className.match(/expand(\d+)\-*(\d+)*/i);
			this.expandMin = minHeight || (p ? parseInt('0'+p[1], 10) : 0);
			this.expandMax = maxHeight || (p ? parseInt('0'+p[2], 10) : 99999);

			// initial resize
			ResizeTextarea(this);

			// zero vertical padding and add events
			if (!this.Initialized) {
				this.Initialized = true;
				$(this).css("padding-top", 0).css("padding-bottom", '4px');
				$(this).bind("keyup", ResizeTextarea).bind("focus", ResizeTextarea);
			}
		});

		return this;
	};

})(jQuery);

$(document).ready(function(){
	$('.select select').css('opacity', '0');

	$('.select select').change(function(){
		$(this).siblings('span').text($(this).children(':selected').text());
	});

	$('textarea.text_autoheight').TextAreaExpander();

	function countLines(strtocount, cols) {
		var hard_lines = 0;
		var last = 0;
		while ( true ) {
			last = strtocount.indexOf("\n", last+1);
			hard_lines ++;
			if ( last == -1 ) break;
			}
		var soft_lines = Math.ceil(strtocount.length / (cols-1));
		var hard = eval("hard_lines " + unescape(">") + "soft_lines;");
		if ( hard ) soft_lines = hard_lines;
		return soft_lines;
	}


});
