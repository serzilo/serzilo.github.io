function clear(id, text)
{	
	var obj=document.getElementById(id);
	if(obj.value==text)
		obj.value="";
};

function restore(id, text)
{	
	var obj=document.getElementById(id);
	if(obj.value=="")
		obj.value=text;
};

var areaText;

function clear_ta(id, text)
{	
	var obj=document.getElementById(id);
	if(obj.value==areaText)
		obj.value="";
};

function restore_ta(id, text)
{	
	var obj=document.getElementById(id);
	if(obj.value=="")
		obj.value=areaText;
};

function init()
{
areaText=document.getElementById("text-area").value;
document.getElementById("btn-name").onfocus=function(){clear("btn-name", "Ваше имя");};
document.getElementById("btn-name").onblur=function(){restore("btn-name", "Ваше имя");};
document.getElementById("btn-phone").onfocus=function(){clear("btn-phone", "Ваш контактный телефон");};
document.getElementById("btn-phone").onblur=function(){restore("btn-phone", "Ваш контактный телефон");};
document.getElementById("btn-email").onfocus=function(){clear("btn-email", "Ваш E-mail");};
document.getElementById("btn-email").onblur=function(){restore("btn-email", "Ваш E-mail");};
document.getElementById("text-area").onfocus=function(){clear_ta("text-area");};
document.getElementById("text-area").onblur=function(){restore_ta("text-area");};
}
