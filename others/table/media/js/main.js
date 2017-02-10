$(document).ready(function(){
		
	var numPerPage = 5;
	var currentPage = 0;
	var request = [{number: 124304,name: 'Подключение к тарифу Авангард',price:1400, status:true},
					{number: 4530,name: 'Подключение к тарифу Доступный',price:400, status:false},
					{number: 49564,name: 'Подключение к тарифу Продвинутый',price:800, status:true},
					{number: 156704,name: 'Подключение к тарифу Авангард',price:1400, status:true},
					{number: 40,name: 'Подключение к тарифу Доступный',price:450, status:false},
					{number: 434,name: 'Подключение к тарифу Продвинутый',price:900, status:true},
					{number: 124304,name: 'Подключение к тарифу Простой',price:930, status:false},
					{number: 124304,name: 'Подключение к тарифу Авангард',price:1400, status:true},
					{number: 4530,name: 'Подключение к тарифу Доступный',price:400, status:false},
					{number: 49564,name: 'Подключение к тарифу Продвинутый',price:800, status:true},
					{number: 156704,name: 'Подключение к тарифу Авангард',price:1400, status:true},
					{number: 40,name: 'Подключение к тарифу Доступный',price:450, status:false},
					{number: 434,name: 'Подключение к тарифу Продвинутый',price:900, status:true},
					{number: 124304,name: 'Подключение к тарифу Простой',price:930, status:false},
					{number: 124304,name: 'Подключение к тарифу Простой',price:900, status:false}];

		
		function updateTable(){
			$("#table_wrap table").html('');
			$("#clientTemplate").tmpl(request).appendTo("#table_wrap table");
			
			$('#table_wrap table tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
			$('#table_wrap table tr').removeClass('odd_tr');
			$('#table_wrap table tr:visible:odd').addClass('odd_tr');
		}
		
		
		
		updateTable();
		
		//
		// сортировка
		//
		
		//фильтрация от меньшего к большему
		function sortNumber(i, ii) { // По имени (возрастание)
				 if (i.number > ii.number)
				 return 1;
				 else if (i.number < ii.number)
				 return -1;
				 else
				 return 0;
				}
				
		//фильтрация от большего к меньшему
		function sortNumberReverse(i, ii) { // По имени (возрастание)
				 if (i.number < ii.number)
				 return 1;
				 else if (i.number > ii.number)
				 return -1;
				 else
				 return 0;
				}

		//
		// Price
		//фильтрация от меньшего к большему
		function sortPrice(i, ii) { // По имени (возрастание)
				 if (i.price > ii.price)
				 return 1;
				 else if (i.price < ii.price)
				 return -1;
				 else
				 return 0;
				}
				
		//фильтрация от большего к меньшему
		function sortPriceReverse(i, ii) { // По имени (возрастание)
				 if (i.price < ii.price)
				 return 1;
				 else if (i.price > ii.price)
				 return -1;
				 else
				 return 0;
				}
		
		
		//
		// status
		//фильтрация от меньшего к большему
		function sortStatus(i, ii) { // По имени (возрастание)
				 if (i.status > ii.status)
				 return 1;
				 else if (i.status < ii.status)
				 return -1;
				 else
				 return 0;
				}
				
		//фильтрация от большего к меньшему
		function sortStatusReverse(i, ii) { // По имени (возрастание)
				 if (i.status < ii.status)
				 return 1;
				 else if (i.status > ii.status)
				 return -1;
				 else
				 return 0;
				}

		
		//
		//name
		//фильтрация от меньшего к большему
		function sortName(i, ii) { // По имени (возрастание)
				 if (i.name > ii.name)
				 return 1;
				 else if (i.name < ii.name)
				 return -1;
				 else
				 return 0;
				}
				
		//фильтрация от большего к меньшему
		function sortNameReverse(i, ii) { // По имени (возрастание)
				 if (i.name < ii.name)
				 return 1;
				 else if (i.name > ii.name)
				 return -1;
				 else
				 return 0;
				}
				
		
		//
		$('#toolbar table td i').on('click',function(){
			if (!$(this).hasClass('active')){
				$('#toolbar table td i').not(this).removeClass('active');
				$(this).addClass('active').removeClass('min_to_max').addClass('max_to_min');
			}
			
		});
		
		//number
		$('#toolbar table td.number i').on('click',function(){
			if ($(this).hasClass('max_to_min')){
				var this_item = $(this);
				this_item.removeClass('max_to_min');
				this_item.addClass('min_to_max');
					request.sort(sortNumber);
					updateTable();
			}else{
				var this_item = $(this);
				this_item.removeClass('min_to_max');
				this_item.addClass('max_to_min');
					request.sort(sortNumberReverse);
					updateTable();
			}
		});
		
		//name
		$('#toolbar table td.name i').on('click',function(){
			if ($(this).hasClass('max_to_min')){
				var this_item = $(this);
				this_item.removeClass('max_to_min');
				this_item.addClass('min_to_max');
					request.sort(sortName);
					updateTable();
			}else{
				var this_item = $(this);
				this_item.removeClass('min_to_max');
				this_item.addClass('max_to_min');
					request.sort(sortNameReverse);
					updateTable();
			}
		});
				
				
		//цена
		$('#toolbar table td.price i').on('click',function(){
			if ($(this).hasClass('max_to_min')){
				var this_item = $(this);
				this_item.removeClass('max_to_min');
				this_item.addClass('min_to_max');
					request.sort(sortPrice);
					updateTable();
			}else{
				var this_item = $(this);
				this_item.removeClass('min_to_max');
				this_item.addClass('max_to_min');
					request.sort(sortPriceReverse);
					updateTable();
			}
		});
		
		
		//status
		$('#toolbar table td.status i').on('click',function(){
			if ($(this).hasClass('max_to_min')){
				var this_item = $(this);
				this_item.removeClass('max_to_min');
				this_item.addClass('min_to_max');
					request.sort(sortStatus);
					updateTable();
			}else{
				var this_item = $(this);
				this_item.removeClass('min_to_max');
				this_item.addClass('max_to_min');
					request.sort(sortStatusReverse);
					updateTable();
			}
		});
		
		
		
		
		
		
		//
		// pagination
		//
		
		//сколько выводим
		
		var kolvo = $('#table_wrap table tr').length;
		
		function upadtePagination(){
			if (kolvo == numPerPage || kolvo < numPerPage){
				$('#prev_page, #next_page').hide();
			}else{
				$('#prev_page').hide();
				 $('#next_page').show();
			}
		}
		
		function repaginate(){
			$('#table_wrap table tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
			$('#table_wrap table tr').removeClass('odd_tr');
			$('#table_wrap table tr:visible:odd').addClass('odd_tr');
		};
		
		//количество выводов
		var numPages = Math.ceil(kolvo / numPerPage);
		
		$('#next_page').click(function(){

				currentPage++;
				if (currentPage>numPages-1){
				currentPage=numPages-1;
		}
				var page_selector_select_val = currentPage + 1;
				$('#page_selector select').val(page_selector_select_val);

		//убираем кнопку
		if (currentPage>numPages-2){
			$(this).hide();
		}
		
		repaginate();
		$('#prev_page').show();
		return false;
		});
	
	
	
		$('#prev_page').click(function(){
			currentPage--;
		if (currentPage<0){
			currentPage = 0;
		}
			var page_selector_select_val = currentPage + 1;
			$('#page_selector select').val(page_selector_select_val);
		
		//убираем кнопку
		if (currentPage<1){
			$(this).hide();
		}
		repaginate();
		$('#next_page').show();
		
		
		return false;
		});	


		//меняем количество ячеек на странице
		$('#select select').change(function(){
			var new_per_page = $(this).val();
			if (new_per_page == 'all'){
				numPerPage = kolvo;
				currentPage = 0;
				numPages = Math.ceil(kolvo / numPerPage);
				repaginate();
				upadtePagination()
				$('#table_wrap table tr').removeClass('odd_tr');
				$('#table_wrap table tr:visible:odd').addClass('odd_tr');
				page_selector();
			}else{
				numPerPage = new_per_page;
				currentPage = 0;
				numPages = Math.ceil(kolvo / numPerPage);
				repaginate();
				upadtePagination();
				$('#table_wrap table tr').removeClass('odd_tr');
				$('#table_wrap table tr:visible:odd').addClass('odd_tr');
				page_selector();
			}
		});
		
		//навигация по страницам
		function page_selector(){
			if (numPages > 1){
				$('#page_selector select').show();
				var selector_options = '';
				for (var i=1; i<=numPages; i++){
					selector_options += '<option value="'+i+'">'+i+'</option>';
					}
				$('#page_selector select').html(selector_options);
				
				
			$('.num_of_pages').html('из '+numPages+'').show();
				
			}else{
				$('#page_selector select, .num_of_pages').hide();
				
			}
		}
		
		page_selector();
		
		$('#page_selector select').on('change',function(){
			var page_number = $(this).val();
			currentPage = page_number - 1;
			
			if (currentPage<1){
				$('#prev_page').hide();
			}else{
				$('#prev_page').show();
			}
			
			if (currentPage>numPages-2){
				$('#next_page').hide();
			}else{
				$('#next_page').show();
			}
			
			repaginate();
		});
		
	
});






