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
<style>
    body{
        font-family: 'Open Sans Condensed', sans-serif;
    }
    p {
        font-size: 35px;
    }
    h1{
        font-size: 70px;
    }
    hr{
        border-top: 2px solid;
    }
</style>
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
<div class="form-horizontal container">
    <div id="splashScreen">
        <img src="img/FONDO-MAMALON.png" alt="fondo" style="
    height: 100%;
    width: 200%;
    position: absolute;
    z-index: 10;
    left:0;
">
        <img src="img/LOGO-AMARILLO.png" alt="logo" style="
    height: 665px;
    margin-top: 25px;
    position: absolute;
    z-index: 100;
    left: 165px;
    top: 400px;
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
        <div class="col-xs-9 col-xs-offset-3">
            <img src="img/LOGO-SF-GRIS.png" alt="logo" style="height:445px">
        </div>
        <div class="col-xs-12">
            <h1 style="color:#99FF00;text-align: center;font-weight: bold;">Gracias por permitirnos ser parte de tu vida</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-1">
            <img src="img/VEC-CAMION-GRIS.png" alt="camion" style="height:120px">
        </div>
        <div class="col-xs-6">
            <p>Conocer las rutas urbanas sera fácil</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-1">
            <img src="img/VEC-RELOJ.png" alt="camion" style="height:120px">
        </div>
        <div class="col-xs-6">
            <p>No te preocuparas por perder el camion</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-4 col-xs-offset-1">
            <img src="img/VEC-RUTA-VACIO.png" alt="camion" style="height:120px">
        </div>
        <div class="col-xs-6">
            <p>No te preocuparas por perder el camion</p>
        </div>
    </div>
    <hr>
    <div class="col-xs-8 col-xs-offset-2">
        <a id="btnIngresar" class="btn col-xs-12" onclick="ingresar()"><img style="height: 55px;" src="img/BTN-CONTINUAR.png" alt="continuar"></a>
    </div>
    <div class="col-xs-12" style="text-align: center">
        <label id="lblEstatus"></label>
    </div>
</div>
