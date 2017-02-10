$(".view-window_social-block_link").on("click", function(e){
	$(this).toggleClass("view-window_social-block_link__clicked");
	e.preventDefault();
	e.stopPropogation;
})