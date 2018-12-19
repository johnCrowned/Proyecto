<?php
/*require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new persona();
$model = new usuarioModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		$usu -> _SET('firstName',                   $_REQUEST['firstName']);
		$usu -> _SET('secondName',                   $_REQUEST['secondName']);
		$usu -> _SET('firstLastName',                   $_REQUEST['firstLastName']);
		$usu -> _SET('secondLastName',                   $_REQUEST['secondLastName']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		//SET de USERS
		$usu -> _SET('passwordUser',                   $_REQUEST['passwordUser']);
		$usu -> _SET('photo',                   $_FILES['archivo']['name']);
		$usu -> _SET('mail',                   $_REQUEST['mail']);
		//SET de CUSTOME_HAS_ROLE
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('statusCustomerRole',         $_REQUEST['statusCustomerRole']);
		$usu -> _SET('terminationDate',                   $_REQUEST['terminationDate']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		$usu -> _SET('firstName',                   $_REQUEST['firstName']);
		$usu -> _SET('secondName',                   $_REQUEST['secondName']);
		$usu -> _SET('firstLastName',                   $_REQUEST['firstLastName']);
		$usu -> _SET('secondLastName',                   $_REQUEST['secondLastName']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		//SET de USERS
		$usu -> _SET('passwordUser',                   $_REQUEST['passwordUser']);
		
		$usu -> _SET('photo',                   $_FILES['archivo']['name']);
		$usu -> _SET('mail',                   $_REQUEST['mail']);
		//SET de CUSTOME_HAS_ROLE
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('statusCustomerRole',                   $_REQUEST['statusCustomerRole']);
		$usu -> _SET('terminationDate',                   $_REQUEST['terminationDate']);
		
		



		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['documentNumber']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['documentNumber']);
		break;
	}
}*/



//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];
 
$tamanio = $_FILES['archivo']['size'];
 
$archivotmp = $_FILES['archivo']['tmp_name'];
 
//cargamos el archivo
$lineas = file($archivotmp);
 
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i=0;
 
//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{ 
   //abrimos bucle
   /*si es diferente a 0 significa que no se encuentra en la primera línea 
   (con los títulos de las columnas) y por lo tanto puede leerla*/
   if($i != 0) 
   { 
       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
       leyendo hasta que encuentre un ; */
       $datos = explode(";",$linea);
 
       //Almacenamos los datos que vamos leyendo en una variable
       //usamos la función utf8_encode para leer correctamente los caracteres especiales
       $nombre = utf8_encode($datos[0]);
       $edad = $datos[1];
       $profesion = utf8_encode($datos[2]);
 
       //guardamos en base de datos la línea leida
       echo "INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion') <br>";
 
       //cerramos condición
   }
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle
}



?>

<!DOCTYPE html>	
<html lang="es">
<head>
	<title>
	

	</title>
	<link rel="stylesheet"  href="../sospview/css/master.css">
	<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>
</head>
<script type="text/javascript">
function on(){
   document.getElementById("archivo").click();
 }
</script>
<style type="text/css">
	.div_foto{
	border: 1px solid #b9b9b9;
    width: 125px;
    height: 140px;
    float: left;
    margin-top: 13px;
    border-radius: 5px;
    margin-bottom: 10px;

}
.thumb {
width: 100%;
height: 100%
}
</style>
<body>

<form action="" enctype="multipart/form-data" method="post">
   <input id="archivo" accept=".csv" name="archivo" type="file" /> 
   <input name="MAX_FILE_SIZE" type="hidden" value="20000" /> 
   <input name="enviar" type="submit" value="Importar" />
</form>

</body>


</html>