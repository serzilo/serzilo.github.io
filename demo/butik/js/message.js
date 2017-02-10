var MessageCounter = {
	timer_id: null,
	textarea: $("#comment-form_textarea"),

	MaxSymCount: function(){
		/*var datalen = document.getElementById(scS).value.length;
		if(datalen > maxlen){
			document.getElementById(scR).style.color = "#FF0000";
			this.FormDisabler(true);
		}else{
			document.getElementById(scR).style.color = "";
			this.FormDisabler(false);
		}
		document.getElementById(scR).innerHTML = datalen;
		*/
		var text = MessageCounter.textarea.val()+"\n"+"&nbsp;";
		var height = $("#comment-form_textarea_counter").html(text).height()+10;

		console.log(text)

		MessageCounter.textarea.css("height",height+"px");
	},

	StartTimer: function(){
		if (MessageCounter.timer_id !== null){
			return; 
		}

		MessageCounter.timer_id = setInterval(function(){MessageCounter.MaxSymCount();}, 200);
		console.log(1)
	},

	StopTimer: function(){
		if (MessageCounter.timer_id === null){
			return; 
		}

		clearInterval(MessageCounter.timer_id); 
		MessageCounter.timer_id = null; 
		console.log(2)
	}
}


$("#comment-form_textarea").on("focus", function () {
	MessageCounter.StartTimer();
})

$("#comment-form_textarea").on("blur", function () {
	MessageCounter.StopTimer();
})