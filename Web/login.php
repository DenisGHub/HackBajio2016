<?php
/**
 * Created by PhpStorm.
 * User: Memo
 * Date: 03/jun/2016
 * Time: 03:19 PM
 */
if (!isset($_SESSION)) {
    header('Location: index.php');
}
?>
<script>
    var segundos = 6;
    $(function () {
        setInterval(function () {
            $("#splashScreen").hide();
        }, segundos * 1000);
    });
</script>
<form id="frmLogin" action="index.php" method="post">
    <input type="hidden" value="mapa" name="mod">
</form>
<div class="form-horizontal">
    <div id="splashScreen">
        <img src="images/bus.png" alt="splash" style="
    height: 20vh;
    margin-top: 25px;
    position: absolute;
    z-index: 100;
">
    </div>
    <div class="row"><!--
        <label for="txtUser" class="col-md-1 col-md-offset-4 control-label">Usuario:</label>-->
        <div class="col-md-3">
            <input id="txtUser" name="usuario" type="hidden" class="form-control" value="Posicion Actual">
        </div>
    </div>
    <div class="row"><!--
        <label for="txtpass" class="col-md-1 col-md-offset-4 control-label">Password:</label>-->
        <div class="col-md-3">
            <input id="txtPass" name="password" type="hidden" class="form-control" value="cachu">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <a id="btnIngresar" class="btn btn-primary col-md-12" onclick="ingresar()">Ingresar</a>
        </div>
        <div class="col-md-12" style="text-align: center">
            <label id="lblEstatus"></label>
        </div>
    </div>
</div>
