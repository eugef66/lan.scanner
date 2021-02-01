
var _data = null;

function ajaxGet(url, mimeType, callback) {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType(mimeType);
    xobj.open('GET', url);
    xobj.setRequestHeader('Cache-Control', 'no-cache');
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == "200") {
            if (callback != null) callback(xobj.responseText);
        }
    }
    xobj.send(null);
}


function load() {

    //Load db.json
    ajaxGet("db.json", "application/json", function (response) {
        var data = JSON.parse(response);
        _data = data;
        //sort data by IP


        //Convert Dict to Array
        _data = Object.keys(_data).map(function (mac) {
            //Get last digit of IP and convert to Number
            var ip = _data[mac]["ip"]
            var s = ip.lastIndexOf(".") + 1;
            var l = ip.length;
            var ip_last = Number(ip.substring(s, l));

            return {
                "mac": mac
                , "ip": _data[mac]["ip"]
                , "is_online": _data[mac]["is_online"]
                , "description": _data[mac]["description"]
                , "vendor": _data[mac]["vendor"]
                ,"ip_last":ip_last
                ,"hostname":_data[mac]["hostname"]
            };
        }
        );

        
        // Sort data array by IP
        _data = _data.sort(function (a, b) {

            //console.log(aip + " " + bip);
            return (a.ip_last <= b.ip_last ? -1 : 1);
        });
        console.log(_data);

        refrehData();

    });

}

function refrehData() {

    //console.log(_data);
    for (var i in _data) {
        //console.log(mac + " - " + _data[mac]["description"]);
        var table = document.getElementById("mainTable");
        var tr = document.createElement("TR");
        if (_data[i].ip_last > 50) tr.classList.add("table-warning");
        var td = document.createElement("TD");
        if (_data[i]["is_online"] == 1) td.innerHTML = "<i class='bi bi-circle-fill' style='color: rgb(119, 206, 119);'></i>";
        tr.appendChild(td)
        td = document.createElement("TD");
        td.innerHTML = _data[i].description;
        tr.appendChild(td);
        td = document.createElement("TD");
        td.innerHTML = _data[i].ip;
        tr.appendChild(td);
        td = document.createElement("TD");
        td.innerHTML = _data[i].mac;
        tr.appendChild(td);
        
        td = document.createElement("TD");
        td.innerHTML = _data[i].hostname;
        tr.appendChild(td);
        td = document.createElement("TD");
        td.innerHTML = _data[i].vendor;
        tr.appendChild(td);

        table.appendChild(tr);
    };


}