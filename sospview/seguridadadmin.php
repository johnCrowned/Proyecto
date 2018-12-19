<?php
session_start();
if($_SESSION["administrador"] !="1"){
//echo $_SESSION["habilitado"];
header ("Location: salir.php");
}
//echo $_SESSION["habilitado"];
?>
