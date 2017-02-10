$(document).ready(function(){

/*�������*/
var slider = $('#slider').bxSlider({
				mode: 'fade',
				auto: true,
				speed: 1000,
				pause:1000,
				controls: false
			});
			
			$('#prev').click(function() {
				slider.goToPreviousSlide();
				return false;
			});
			
			$('#next').click(function() {
				slider.goToNextSlide();
				return false;
			});

			
		//���� ���� ������ 1280
			function resz() {
        if ($(window).width() < 1247 ) {
			$('p.adding_text').hide();
			$('#for_feedbacks').css({'padding-right':'20px'});
			$('#right_column').css({'width':'385px'});
			$('#left_column .float_block').css({'width':'46%'});
        } else {
			$('p.adding_text').show();
			$('#for_feedbacks').css({'padding-right':'108px'});
			$('#right_column').css({'width':'485px'});
			$('#left_column .float_block').css({'width':'40%'});
			}
		}
    
    resz();
    $(window).resize(resz);	
	
	//������ ������ �������
	function changeauthors(){
		var story_block_width = 0;
		$('.story_block1').each(function(){
			var this_height = $(this).find('p').height();
			if(this_height>story_block_width){
				story_block_width = this_height;
			}
		});
		
		$('.story_block1').css({'height': story_block_width+'px'});
			story_block_width = 0;
	}
	
	changeauthors();
	$(window).resize(changeauthors);	
	
	
	//���������� ���� � ��������
	function hideinfo() {
				$('#city').hide(0, function(){$('#main_wrapper, #footer, #wrap_blocks, #scroller, #for_blocks').unbind('click', hideinfo)});
			}
	function showinfo() {
				setTimeout(function(){$('#city').show(0, function(){$('#main_wrapper, #footer, #wrap_blocks, #scroller, #for_blocks').bind('click', hideinfo)});}, 1);
			}

	$('#region, #wrap_city').click(function(){
		showinfo();
	});	
	
	$('#close_window').click(function(){
		$('#city').hide();
	});	
	
	$('#city li a').click(function(){
		$('#city li').removeClass('active');
		$(this).parent().addClass('active');
	});
	
	
	//������
	$('input.form_fields, textarea.form_textarea').focus(function(){
		if ($(this).val() == $(this).attr('title')){
			$(this).val('');
		}
	});
	
	$('input.form_fields, textarea.form_textarea').blur(function(){
	if ($(this).val().length == 0 || $(this).val() == $(this).attr('title')){
			$(this).val($(this).attr('title'));
		}
	});
	
	//fancybox
	$("a#make_feedback, a.show_registration_window, a.map, a#make_question").fancybox(); 

	
	if ($.browser.msie && $.browser.version.substr(0,1)==8){
		$('input.form_fields').css({'padding-top':'12px','height':'31px'});
	}
	
	
	
	
	//�������� ����� (������)
			var proverka = 0;
			$('input#send_feedback_button').click(function(){
				proverka = 0;
				
				if ($('input#your_name').val() == "" || $('input#your_name').val() == $('input#your_name').attr('title')){
					$('input#your_name').addClass('error');
					proverka += 1;
				}
				
				var reg = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
				var userEmail = $('input#your_email').val();
				if (userEmail.search(reg) == -1){
					$('input#your_email').addClass('error');
					proverka += 1;
				}
				
				if ($('textarea#feedback_text').val() == "" || $('textarea#feedback_text').val() == $('textarea#feedback_text').attr('title')){
					$('textarea#feedback_text').addClass('error');
					proverka += 1;
				}
				
				if (proverka !=0){
					return false;
				}
			
			});
			
			
			$('.form_fields, .form_textarea').focus(function(){
				$(this).removeClass('error');
			});
			
	
	
	
	//�������� ����� (�����������)
			var proverka2 = 0;
			$('input#send_registration_button').click(function(){
				proverka2 = 0;
				
				if ($('input#your_name_reg').val() == "" || $('input#your_name_reg').val() == $('input#your_name_reg').attr('title')){
					$('input#your_name_reg').addClass('error');
					proverka2 += 1;
				}
				
				if ($('input#your_name_reg').val() == "" || $('input#your_last_name_reg').val() == $('input#your_last_name_reg').attr('title')){
					$('input#your_last_name_reg').addClass('error');
					proverka2 += 1;
				}
				
				if ($('input#your_phone_reg').val() == "" || $('input#your_phone_reg').val() == $('input#your_phone_reg').attr('title')){
					$('input#your_phone_reg').addClass('error');
					proverka2 += 1;
				}
				
				var reg = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
				var userEmail = $('input#your_email_reg').val();
				if (userEmail.search(reg) == -1){
					$('input#your_email_reg').addClass('error');
					proverka2 += 1;
				}
				
				
				
				if (proverka2 !=0){
					return false;
				}
			
			});
	
	
	
	
			
	//faq

		//���������
		var fa_numbers = $('#wrap_qa span.qa_number');
		var kolvo_fa = kolvo = fa_numbers.length;
		
		fa_numbers.each(function(){
			$(this).text(kolvo_fa);
			kolvo_fa -=1;
		});
		
		
		//������� �������
		var numPerPage = 5;
		var currentPage = 0;
		
		var more_than = numPerPage + 1;
		if (fa_numbers.length< more_than){
			$('#next_fa_page').hide();
		}		
		
		$('div.qa').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
		
		repaginate = function(){
			$('#wrap_qa').fadeOut('slow',function(){
				$('div.qa').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
			});
			
			$('#wrap_qa').fadeIn('slow');
		};
	
		
		//���������� �������
		var numPages = Math.ceil(kolvo / numPerPage);
		
		function fade(){
			$('#wrap_qa').fadeOut('slow');
		};
			
		$('#next_fa_page').click(function(){

				currentPage++;
				if (currentPage>numPages-1){
				currentPage=numPages-1;
		}

		//������� ������
		if (currentPage>numPages-2){
			$(this).hide();
		}
		repaginate();
		$('#prev_fa_page').show();
		return false;
		});
	
	
	
		$('#prev_fa_page').click(function(){
			currentPage--;
		if (currentPage<0){
			currentPage = 0;
			//currentPage=numPages+1;
		}
		
		//������� ������
		if (currentPage<1){
			$(this).hide();
		}
		repaginate();
		$('#next_fa_page').show();
		
		
		return false;
		});
			
	
		//�������
		$('.story_block p').click(function(){
			var link = $(this).parent().find('a.story_link').attr('href');
			window.location=link;
		});
	
	
	
		//�����
		
		window.onload = function () {
            var map = new YMaps.Map(document.getElementById("map"));
            map.setCenter(new YMaps.GeoPoint(30.41736,59.88115), 16);
			map.addControl(new YMaps.Zoom());
			//map.addOverlay(new YMaps.Placemark(new YMaps.GeoPoint(30.332712,59.95889)));
			map.addControl(new YMaps.ToolBar());
			
			// �������� ����� ��� ����������� ������
            var s = new YMaps.Style();
            s.balloonContentStyle = new YMaps.BalloonContentStyle(
                new YMaps.Template("<div style=\"color:green\">$[description]</div>")
            );

            // �������� ����� � ���������������� ������ � ���������� �� �� �����
            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(30.41736,59.88115), {style: s} );
            placemark.description = "192148 �����-���������, <br />��������������� ��������, �.36";
			placemark.setIconContent("��� ����");
            map.addOverlay(placemark);

            // �������� ������
           // placemark.openBalloon();

			map.addControl(new YMaps.TypeControl([
            YMaps.MapType.MAP,
            YMaps.MapType.SATELLITE,
            YMaps.MapType.PMAP
        ], [0, 1, 2]));

		
        }
	
	
	
	
	
	
	
	
	
	
	
	
	
});






