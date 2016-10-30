<?php
/**
 * Created by PhpStorm.
 * User: Memo
 * Date: 03/jun/2016
 * Time: 02:32 PM
 */
session_start();
?>
<html>
<head>
    <title>Urban-lora</title>
    <style type="text/css">
    body { background-size: cover;
	background-image: url(img/FONDO-MAMALON.png);
   
}
    </style>
    <?php include "scripts.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="
    overflow-x: hidden;
    overflow-y: auto;
">
<h3>&nbsp;</h3>
<div class="col-sm-8 col-sm-offset-3" style="position: relative"><img src="img/LOGO-AMARILLO.png" alt="" width="410" height="400" onClick= "location.href='2.php'"></div>


<?php
63
if (!isset($_SESSION["usuario"])) {
    include "login.php";
} else {
    $_SESSION["mod"] = isset($_POST["mod"]) ? $_POST["mod"] : $_SESSION["mod"];
    switch ($_SESSION["mod"]) {
        case "mapa":
            include "mapa.php";
            break;
        case "socket":
            include "websocket.php";
            break;
        default:
            include "login.php";
            break;
    }
}
?>
</body>
</html>
