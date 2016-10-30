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
        <img src="img/FONDO-MAMALON.png" alt="fondo" style="
    height: 100%;
    width: 200%;
    position: absolute;
    z-index: 10;
">
        <img src="img/LOGO-AMARILLO.png" alt="logo" style="
    height: 12vh;
    margin-top: 25px;
    position: absolute;
    z-index: 100;
    left: 4.5vh;
    top: 7vh;
">
    </div>
    <div class="row"><!--
        <label for="txtUser" class="col-xs-1 col-xs-offset-4 control-label">Usuario:</label>-->
        <div class="col-xs-3">
            <input id="txtUser" name="usuario" type="hidden" class="form-control" value="Posicion Actual">
        </div>
    </div>
    <div class="row"><!--
        <label for="txtpass" class="col-xs-1 col-xs-offset-4 control-label">Password:</label>-->
        <div class="col-xs-3">
            <input id="txtPass" name="password" type="hidden" class="form-control" value="cachu">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 col-xs-offset-5">
            <a id="btnIngresar" class="btn btn-primary col-xs-12" onclick="ingresar()">CONTINUAR</a>
        </div>
        <div class="col-xs-12" style="text-align: center">
            <label id="lblEstatus"></label>
        </div>
    </div>
</div>
