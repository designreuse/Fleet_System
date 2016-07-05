// JavaScript Document

function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i = 0; i < ARRcookies.length; i++)
	{
	  	x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  	y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  	x = x.replace(/^\s+|\s+$/g,"");
	  	if (x == c_name){
			return unescape(y);
		}
	 }
}

function checkCookie(cookieName){
	var cookie = getCookie(cookieName);
  	if (cookie != null && cookie != ""){
		return true;
  	}else{
  		return false;
  	}
}

function deleteCookie(cookieName){
	 document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}