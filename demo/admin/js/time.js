function startTime() {
	var tm=new Date(),
		h=tm.getHours(),
		m=tm.getMinutes(),
		ms=tm.getMilliseconds();

	h=checkTime(h);
	m=checkTime(m);

	document.getElementById('now_this_time').innerHTML =  ( ms <= 499 ) ? h+":" : h+" ";	
	document.getElementById('now_this_time2').innerHTML = m;
	t=setTimeout('startTime()',500);
}

function checkTime(i) {
	return ( i < 10 ) ? "0"+i : i;
}
