<?php

header("Content-Type: text/html;charset=utf-8");
$db = new mysqli('localhost', 'root', '', 'db_sosp');
$acentos = $db->query("SET NAMES 'utf8'");
//servidor, ususario, passwoerd, DB
if($db->connect_error > 0){
    die('sdfsdf [' . $db->connect_error . ']');
	
}

?>