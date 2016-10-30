<?php
/**
 * Created by PhpStorm.
 * User: Memo
 * Date: 03/jun/2016
 * Time: 04:45 PM
 */
if (!isset($_SESSION)) {
    header('Location: index.php');
}
?>
<form id="frmMapa" action="index.php" method="post" class="container">
    <div class="row">
        <a class="btn btn-default" onclick="logout()">Cerrar Sesión</a>
        <!--<a class="btn btn-default" onclick="websocket()">WebSocket</a>-->
        <a class="btn btn-default" onclick="distancia()">Obtener Distancia</a>
    </div>
    <div id="users" class="row"></div>
</form>
<form id="frmSocket" action="index.php" method="post" class="container">
    <input type="hidden" value="socket" name="mod">
</form>
<script>
    var segundos = 10;

    $(function () {
        cargarUsuarios();
        initMap();
        cargarCoordenadas(<?php echo $_SESSION["usuario"]?>);
        setInterval(function () {
            cargarCoordenadas(<?php echo $_SESSION["usuario"]?>)
        }, segundos * 1000);
    });
</script>
<div>
    <div style="height: 60vh">
        <div id="map">
        </div>
    </div>
    <footer style="position: relative;">
        <h3 id="ruta"></h3>
    </footer>
</div>