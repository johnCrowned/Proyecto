<!DOCTYPE html>
<html">
<head>

<link rel="stylesheet" href="css/master.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
<meta charset="UTF-8"/>
<title>Validacion_login</title>
</head>

<body>

<?php

class Usuario{
		
		public function imprimirUsuario($doc, $pass){

session_start();

include ('conexion2.php');

$documento=$_POST["doc"];
$pass=$_POST["pass"];

$cont=0;
$rol=0;

$sql2="SELECT * FROM users WHERE documentNumber='$documento' AND passwordUser='$pass'";
if(!$result2 = $db->query($sql2)){
  die('Hay un error corriendo en la consulta o datos no encontrados!!! [' . $db->error . ']');
}
while($row2 = $result2->fetch_assoc())
{
	$ddocumentoev=stripslashes($row2["documentNumber"]); 
	$ccontrasenaev=stripslashes($row2["passwordUser"]); 
	$nnombresev=stripslashes($row2["mail"]); 


	$cont=$cont+1;
		
}


if ($cont==0)
{

print "<script>alert(\"Usuario y/o Password Incorrectas.\");window.location='logeo.php';</script>";

}

if ($cont!=0)
{
$_SESSION['documento']=$ddocumentoev;
$_SESSION['nombresev']=$nnombresev;
$_SESSION['activo']=1;

$sql1="SELECT roleId FROM customer_has_role WHERE documentNumber='$ddocumentoev'";

if(!$result1 = $db->query($sql1)){
  die('Hay un error corriendo en la consulta o datos no encontrados!!! [' . $db->error . ']');
}
while($row1 = $result1->fetch_assoc())
{
	$role=stripslashes($row1["roleId"]); 
	echo $role;

}

	if ($role == null)
{

print "<script>alert(\"El usuario no tiene asignado Rol\");window.location='';</script>";

}

if ($role!=0)
{

$_SESSION['instructor']=1;	
header ('Location: habilitado.php');	
}

} //fin if conteo		
			
}// finalizando el método

}//cerrando la clase
		
			
	
	$Nuevo=new Usuario();
    $Nuevo -> imprimirUsuario($_POST["doc"],$_POST["pass"]);
	
?>

</body>
</html>
