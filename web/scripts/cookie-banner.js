function acept_cookie()
{
	document.cookie = "accept_cookie=true; path=/; expires=Tue, 19 Jan 2138 03:14:07 GMT";
	$(".cookie-banner").remove()
}