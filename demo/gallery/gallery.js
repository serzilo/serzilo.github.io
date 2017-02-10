var GALLERY = (function(){

	var images = document.getElementsByClassName("g_link"),
		images_cnt = images.length,
		imagesData = [],
		i = 0,
		current = 0,
		open = false;

	function openGallery(event,id){
		if (event){
			//current = event.currentTarget.getAttribute("imageid");
			current = id;
		}
		
		var mainImage = document.getElementById("galleryImage"),
			advancepage = document.getElementById("g_advancepage"),
			dloadlink = document.getElementById("g_dloadlink");

		//console.log(current);
		//console.log(imagesData[current]);

		
		mainImage.src = imagesData[current].originalimage;
		advancepage.href = imagesData[current].advancepage;
		dloadlink.href = imagesData[current].dloadlink;

		
		if (!open){
			open = true;

			resizer();
			document.getElementById("Gallery").style.top = getBodyScrollTop() + "px";

			window.onresize = function(){
				resizer();
			}

			addClass(document.body, "open_gallery");
			event.stopPropogation;
			event.preventDefault();
			
		}
	}

	function exit(){
		removeClass(document.body, "open_gallery");
		document.body.style.height = "auto";
		document.getElementById("wrap_all").style.height = "auto";
		open = false;
	}


	function anotherImage(direction){
		if (direction == 1){
			//âïåðåä
			if (imagesData[current+1]){
				current = current + 1;
			}else{
				current = 0;
			}
		}else{
			//íàçàä
			if (imagesData[current-1]){
				current = current - 1;
			}else{
				current = images_cnt - 1;
			}
		}
		openGallery();
	}

	function resizer(){
		if (open){
			document.getElementById("Gallery").style.height = window.innerHeight + "px";
			document.getElementById("wrap_all").style.height = window.innerHeight + "px";
			document.body.style.height = window.innerHeight + "px";
		}
	}

	function getBodyScrollTop(){
	  return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
	}
		
	function initModule(){
		for (i=0; i < images_cnt; i++){
			var dataObj = new Object(),
				element = images[i];
				//element.setAttribute("imageid",i);
				
				(function(Element,id){
					Element.onclick = function(event){
						openGallery(event,id);
					};
				})(element,i)
			
			dataObj.originalimage = element.getAttribute("originalimage");
			dataObj.advancepage = element.getAttribute("advancepage");
			dataObj.dloadlink = element.getAttribute("dloadlink");

			imagesData[i] = dataObj;
		}

		var html = String()
			//+ '<div class="gallery" id="Gallery">'
			+ 	'<div class="gallery__shadow"></div>'
			
			+ 	'<div class="gallery__button gallery__button_prev" id="gallery__button_prev">'
			+		'<div class="gallery__button-arrow gallery__button-arrow_prev"></div>'
			+   '</div>'

			+ 	'<div class="gallery__button gallery__button_next" id="gallery__button_next">'
			+		'<div class="gallery__button-arrow gallery__button-arrow_next"></div>'
			+   '</div>'

			+ 	'<div class="gallery__exit" id="gallery__exit"></div>'
			
			+ 	'<img src="" alt="" id="galleryImage" class="gallery__image" />'
			
			+ 	'<div class="gallery__bottom">'
			+ 		'<a class="gallery__link" href="" id="g_advancepage">Страница файла</a>'
			+ 		'<a class="gallery__link" href="" id="g_dloadlink">Скачать</a>'
			+ 	'</div>'
			//+ '</div>';

			var galleryWindow = document.createElement('div');
			galleryWindow.id = "Gallery";
			galleryWindow.className = "gallery";
			galleryWindow.innerHTML = html;

			(document.body).appendChild(galleryWindow);

			/*
			document.getElementById("gallery__button_prev").onClick = function(){
				GALLERY.anotherImage(0);
			}

			document.getElementById("gallery__button_next").onClick = function(){
				GALLERY.anotherImage(1);
			}*/

			document.getElementById("gallery__button_prev").addEventListener( "click", function(){anotherImage(0)}, false);
			document.getElementById("gallery__button_next").addEventListener( "click", function(){anotherImage(1)}, false);

			document.getElementById("gallery__exit").addEventListener( "click", function(){exit()}, false);



	}

	//console.log(imagesData);

	function addClass(o, c){
	    var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g")
	    if (re.test(o.className)) return
	    o.className = (o.className + " " + c).replace(/\s+/g, " ").replace(/(^ | $)/g, "")
	}
		  
	function removeClass(o, c){
	    var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g")
	    o.className = o.className.replace(re, "$1").replace(/\s+/g, " ").replace(/(^ | $)/g, "")
	}

	

	


	return {
		initModule : initModule
	}





})();