
<?php
session_start();
$_SESSION['jurado']="0";
$_SESSION['documento']="0";
$_SESSION['instructor']="0";
$_SESSION['activo']="0";
$_SESSION['administrador']="0";
$_SESSION['aprendiz']="0";
header ('Location:../index.php');


?>
