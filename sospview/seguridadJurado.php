<?php
session_start();
if($_SESSION["jurado"] !="1"){
//echo $_SESSION["habilitado"];
header ("Location: salir.php");
}
//echo $_SESSION["habilitado"];
?>
