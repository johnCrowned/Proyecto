<?php
session_start();
if($_SESSION["instructor"] !="1"){

header ("Location: salir.php");
}
//echo $_SESSION["habilitado"];
?>
