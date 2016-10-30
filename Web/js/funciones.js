/**
 * Created by Memo on 04/jun/2016.
 */
var markers = [];
var map;

function ingresar() {
    var user = $("#txtUser").val();
    var pass = $("#txtPass").val();

    $("#lblEstatus").html("");
    $("#btnIngresar").attr("disabled", true);
    $.post(
        "ajax.php",
        {
            ajaxAccion: "ingresar",
            user: user,
            pass: pass
        },
        function (out) {
            if (out != "true") {
                $("#lblEstatus").html(out);
            }
            else {
                $("#frmLogin").submit();
            }
            $("#btnIngresar").attr("disabled", false);
        });
}
function logout() {
    $.post(
        "ajax.php",
        {
            ajaxAccion: "logout"
        },
        function (out) {
            $("#frmMapa").submit();
        }
    )
}
function cargarCoordenadas(id) {
    setMapOnAll(null);
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    $.post(
        "ajax.php",
        {
            ajaxAccion: "cargarCoordenadas",
            id: id
        },
        function (out) {
            var obj = JSON.parse(out);
            var actual, camion;
            $.each(obj, function (index, value) {
                if (index == "id1") {
                    actual = {lat: value.lat, lng: value.lng};
                }
                else if (index == "id2") {
                    camion = {lat: value.lat, lng: value.lng};
                }
            });
            calculateAndDisplayRoute(directionsService, directionsDisplay, camion, actual);
            console.log(obj);
            $.each(obj, function (index, value) {
                var myLatLng = {lat: value.lat, lng: value.lng};
                setMarker(value.nombre, myLatLng, index);
            });

        }
    )

}
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function initMap(label, lat, lng) {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17
    });
}
function setMarker(label, myLatLng, index) {
    var icon;
    if (index == "id1") {
        icon = {
            path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
            scale: 10
        };
    }
    else if (index == "id2") {
        icon = {
            url: "images/bus.png",
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0, 0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
    }

    var marker = new google.maps.Marker({
        position: myLatLng,
        title: label,
        icon: icon
    });
    markers.push(marker);
    marker.setMap(map);
    map.setCenter(marker.getPosition());
}
function calculateAndDisplayRoute(directionsService, directionsDisplay, myLatLng, destination) {
    initMap();
    directionsDisplay.setMap(map);
    directionsService.route({
        origin: myLatLng.lat + "," + myLatLng.lng,
        destination: destination.lat + "," + destination.lng,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
    distancia();
}
function cargarUsuarios() {
    $.post(
        "ajax.php",
        {
            ajaxAccion: "cargarUsuarios"
        },
        function (out) {
            $("#users").html(out);
        }
    )
}
function focusMarker(id) {
    $.post(
        "ajax.php",
        {
            ajaxAccion: "focusMarker",
            id: id
        },
        function (out) {
            cargarCoordenadas(id);
        }
    )
}
function websocket() {
    $("#frmSocket").submit();
}
function distancia() {
    $.post(
        "ajax.php",
        {
            ajaxAccion: "getDistancia"
        },
        function (out) {
            var vars = JSON.parse(out);
            console.log(vars);
            var estimado = "Distancia: " + vars.rows[0].elements[0].distance.text + " Tiempo: " + vars.rows[0].elements[0].duration.text;
            /*alert();*/
            $("#ruta").html(estimado);
        }
    )
}

var wsUri = "wss://us1.loriot.io/app?id=BE7E0034&token=b6y6qkydnUs7sYey9H3NuA";
var output;

function init() {
    output = document.getElementById("output");
    testWebSocket();
    saveOnDB('686f6c61');
}

function testWebSocket() {
    websocket = new WebSocket(wsUri);

    websocket.onopen = function (evt) {
        onOpen(evt);
    };

    websocket.onmessage = function (evt) {
        onMessage(evt);
    };

    websocket.onerror = function (evt) {
        onError(evt);
        console.log(evt);
    };
}

function onOpen(evt) {
    console.log("CONNECTED");
    //doSend("WebSocket rocks");
}

function onMessage(evt) {
    console.log(evt);
    writeToScreen('<span style = "color: blue;">RESPONSE: ' +
        evt.data + '</span>');
    websocket.close();
    saveOnDB(evt.data);
}

function onError(evt) {
    writeToScreen('<span style="color: red;">ERROR:</span> ' + evt.data);
}

function doSend(message) {
    writeToScreen("SENT: " + message);
    websocket.send(message);
}

function writeToScreen(message) {
    /*var pre = document.createElement("p");
     pre.style.wordWrap = "break-word";
     pre.innerHTML = message;
     output.appendChild(pre);*/
    alert(message);
}

window.addEventListener("load", init, false);

function saveOnDB(data) {
    $.post(
        "ajax.php",
        {
            ajaxAccion: "saveOnDB",
            data: data
        },
        function (out) {
            var vars = JSON.parse(out);
            if ($.type(vars.res) === "string") {
                alert(vars.res);
            }
            else {
                // alert("Guardado");
            }
        });
}