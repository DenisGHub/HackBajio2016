<?php
/**
 * Created by PhpStorm.
 * User: Memo
 * Date: 03/jun/2016
 * Time: 03:15 PM
 */

session_start();
require "bd.php";
$bd = new bd;

if (isset($_POST["ajaxAccion"])) {
    switch ($_POST["ajaxAccion"]) {
        case "ingresar":
            echo ingresar();
            break;
        case "logout":
            logout();
            break;
        case "cargarCoordenadas":
            echo cargarCoordenadas();
            break;
        case "cargarUsuarios":
            echo cargarUsuarios();
            break;
        case "focusMarker":
            $_SESSION["marker"] = $_POST["id"];
            break;
        case "getDistancia":
            echo getDistancia();
            break;
        case "saveOnDB":
            echo json_encode(saveOnDB());
            break;
    }
}

function saveOnDB()
{
    $vars = array("res" => true);

    try {
        global $bd;

        $txt = "select id_coordenada id from coordenada where id_usuario=3";
        $sql = $bd->consulta($txt);
        $consulta = $bd->siguiente($sql);
        $id = $consulta["id"];
        $coord = hexToStr($_POST["data"]);
        if ($coord[0] == "A") {
            $coord = substr($coord, 1);
            $txt = "update coordenada set latitud_coordenada=$coord where id_coordenada=$id";
            $sql = $bd->consulta($txt);
        }
        if ($coord[0] == "O") {
            $coord = substr($coord, 1);
            $txt = "update coordenada set longitud_coordenada = $coord where id_coordenada=$id";
            $sql = $bd->consulta($txt);
        }
    } catch (Exception $ex) {
        $vars["res"] = $ex->getMessage();
    }

    return $vars;
}


function hexToStr($hex)
{
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}

function getDistancia()
{
    $apiKey = "AIzaSyAf0sWyWt1ZsHRAGCQGhKeeGgbT9V0kpBU";
    $origins = $_POST["origin"]["lat"] . "," . $_POST["origin"]["lng"];//Camion
    if (!isset($_POST["dest"])) {
        $destinations = $origins;
    } else
        $destinations = $_POST["dest"]["lat"] . "," . $_POST["dest"]["lng"];//Actual
    $json = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origins&destinations=$destinations&language=es-MX&key=$apiKey");
    return $json;
}

function inicio()
{
    global $bd;

    $consulta = $bd->consulta("SELECT * FROM usuario;");
    $siguiente = $bd->siguiente($consulta);
    echo $siguiente["nombre_usuario"];
}

function ingresar()
{
    global $bd;
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if ($user == "" || $pass == "") {
        return "Llene todos los campos";
    }

    $txt = "select id_usuario id, nivel_usuario nivel from usuario where nombre_usuario='$user' and pass_usuario='$pass'";
    $sql = $bd->consulta($txt);
    $consulta = $bd->siguiente($sql);
    if ($consulta == null) {
        return "Datos Incorrectos";
    }
    if ($consulta["nivel"] != 1) {
        return "No puedes acceder con esta cuenta. Contacta al administrador";
    }
    if ($sql->num_rows > 0) {
        $_SESSION["usuario"] = $consulta["id"];
        return "true";
    }

    return "Error general";
}

function logout()
{
    session_destroy();
}

function cargarCoordenadas()
{
    global $bd;
    $id = isset($_SESSION["marker"]) ? $_SESSION["marker"] : $_POST["id"];
    $coord = array();

    $consulta = $bd->consulta("SELECT id_usuario id, latitud_coordenada lat, longitud_coordenada lng FROM coordenada ORDER BY FIELD(id_usuario, $id) ASC ");

    foreach ($consulta as $reg) {
        $coord['id' . $reg["id"]]["nombre"] = $bd->siguiente($bd->consulta("SELECT nombre_usuario nombre FROM usuario WHERE id_usuario=" . $reg["id"]))["nombre"];
        $coord['id' . $reg["id"]]["lat"] = $reg["lat"] * 1;
        $coord['id' . $reg["id"]]["lng"] = $reg["lng"] * 1;
    }

    return json_encode($coord);
}

function cargarUsuarios()
{
    global $bd;
    $usuarios = "";
    $consulta = $bd->consulta("SELECT * FROM usuario where nivel_usuario=1");
    foreach ($consulta as $reg) {
        $usuarios .= '<a id="btnId' . $reg["id_usuario"] . '" class="btn btn-primary" onclick="mostrarUbicacion(' . $reg["id_usuario"] . ')"><i class="fa fa-location-arrow"></i><!--' . $reg["nombre_usuario"] . '--></a> ';
    }

    return $usuarios;
}

?>