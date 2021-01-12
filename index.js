
var _data=null;

function ajaxGet(url, mimeType, callback)
{
	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType(mimeType);
	xobj.open('GET', url);
	xobj.setRequestHeader('Cache-Control', 'no-cache');
	xobj.onreadystatechange = function()
	{
		if (xobj.readyState == 4 && xobj.status == "200") {
			if (callback!=null) callback(xobj.responseText);
		}
	}
	xobj.send(null);
}


function load(){

    //Load db.json
    ajaxGet("db.json","application/json", function(response){
        var data = JSON.parse(response);
        _data=data;
        refrehData();

    });	
    
}

function refrehData(){
    
    console.log(_data);
    for (var mac in _data) {
        console.log(mac + " - " + _data[mac]["description"]);
        // Add rows to table
    };


}