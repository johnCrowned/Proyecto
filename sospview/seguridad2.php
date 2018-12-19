<?php
header("Content-Type: text/html;charset=utf-8");
session_start();  //arrancan todas las variables

$instructor=$_SESSION['instructor'];

if ($instructor!="1")
{
	header ('Location: index.php');
}


?>
