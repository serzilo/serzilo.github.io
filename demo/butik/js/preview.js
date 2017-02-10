$("body").on("click",".image-item_link",function(e){
	e.preventDefault();
	var link = this.href,
		id = this.getAttribute('data-id');
	ViewWindow.show(link,id);
});

var ViewWindow = {
	current: 0,
	imagesCount: $(".js_image-item_link").length,
	show : function(link, id){
		var body = $("body,html"),
			windowSize = ViewWindow.resizeWindow(),
			view_window = $(".view-window");

		//var bodyTopScroll = document.body.scrollTop;
		//console.log(bodyTopScroll);

		if (ViewWindow.device()){
			body.css({"height":windowSize.height+"px"});
			$(".view-window").css("position","absolute");
		}
		//view_window.css({"height":windowSize.height+"px"});

		ViewWindow.imageHeight();

		$(window).on('resize',function(){
			if ($(".ViewWindow__on").length){
				windowSize = ViewWindow.resizeWindow();

				if (ViewWindow.device()){
					body.css({"height":windowSize.height+"px"});
				}

				ViewWindow.imageHeight();

				//view_window.css({"height":windowSize.height+"px"});
			}
		});

		$("#view-window_block_Image").attr("src",link);


		$("html").addClass("ViewWindow__on");

		//document.body.scrollTop = bodyTopScroll;

		

		ViewWindow.current = parseInt(id);

		$(".view-window_shadow, #view-window_block_close").on("click", function(){
			ViewWindow.hide();
		});
	},

	hide : function(){
		if (ViewWindow.device()){
			$("body,html").css({"height":"auto"});
		}

		$("html").removeClass("ViewWindow__on");
		ViewWindow.current = 0;
	},

	nextImage: function(){
		var Current = ViewWindow.current + 1;

		if ($("a[data-id='"+Current+"']").length){
			var link = $("a[data-id='"+Current+"']");
		}else{
			var link = $("a[data-id='1']");
			Current = 1;
		}

		var href = link.attr('href');

		//console.log(href)
		$("#view-window_block_Image").attr("src",href);
		ViewWindow.current = Current;
	},

	prevImage: function(){
		var Current = ViewWindow.current - 1;

		if ($("a[data-id='"+Current+"']").length){
			var link = $("a[data-id='"+Current+"']");
		}else{
			var link = $("a[data-id='"+ViewWindow.imagesCount+"']");
			Current = ViewWindow.imagesCount;
		}

		var href = link.attr('href');

		//console.log(href)
		$("#view-window_block_Image").attr("src",href);
		ViewWindow.current = Current;
	},

	resizeWindow : function(){
		var windowEl = $(window);
		return {"width": windowEl.width(),"height":windowEl.height()}
	},

	device : function(){
		return !!navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/i);
	},

	imageHeight : function(){
		var windowHeight = ViewWindow.resizeWindow().height-30;
		if (windowHeight > 830){
			windowHeight = 830;
		}

		$("#view-window_block_Image").css({"max-height": windowHeight+"px"});
	},

	init : ((function(){
		$("#view-Image_slider__next").on("click", function(){
			ViewWindow.nextImage();
		});

		$("#view-Image_slider__prev").on("click", function(){
			ViewWindow.prevImage();
		});


	})())
}