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
        <!--<a class="btn btn-default" onclick="websocket()">WebSocket</a>--><!--
        <a class="btn btn-default" onclick="distancia()">Obtener Distancia</a>-->
    </div>
    <input type="hidden" value="1" id="ubicacion">
</form>
<div class="container">
    <div class="row">
        <label for="enCamino">Abordo:</label>
        <input data-toggle="toggle" type="checkbox" id="enCamino" value="0">
    </div>
</div>
<form id="frmSocket" action="index.php" method="post" class="container">
    <input type="hidden" value="socket" name="mod">
</form>
<script>
    var segundos = 40;

    $(function () {
        cargarUsuarios();
        initMap();
        cargarCoordenadas(<?php echo $_SESSION["usuario"]?>);
        setInterval(function () {
            cargarCoordenadas(<?= $_SESSION["usuario"]?>)
        }, segundos * 1000);
        $('#enCamino').change(function () {
            var value = $(this).val();
            if (value == 0) {
                $(this).val(1);
            }
            else if (value == 1) {
                $(this).val(0);
            }
            cargarCoordenadas(3);
        });
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
    <div id="users" class="row" style="position: relative;text-align: right;right: 70px;bottom: 37px;"></div>
</div>