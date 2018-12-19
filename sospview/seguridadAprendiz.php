<?php
session_start();
if($_SESSION["aprendiz"] !="1"){
//echo $_SESSION["habilitado"];
header ("Location: salir.php");
}
//echo $_SESSION["habilitado"];
?>
