
function ajaxCall(http_method, url, mimeType, callback) {
	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType(mimeType);
	xobj.open(http_method, url);
	xobj.setRequestHeader('Cache-Control', 'no-cache');
	xobj.onreadystatechange = function () {
		if (xobj.readyState == 4 && xobj.status == "200") {
			if (callback != null) callback(xobj.responseText);
		}
	}
	xobj.send(null);
}



function escapeString(s){

	return s.replace("\'","\\\'").replace("\"","\\\"");

}