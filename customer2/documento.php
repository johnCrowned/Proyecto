<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new persona();
$model = new usuarioModel();
$db = database::conectar();
$camposDesabilitados = '';
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
		
		if( $_FILES['archivo']['name']!= null &&  $_FILES['archivo']['name'] != ""){
			$usu -> _SET('photoaction',                   1);
		echo $usu -> _SET('photo',                   $_FILES['archivo']['name']);
		}else{
			$usu -> _SET('photoaction',                   2);
		echo $usu -> _SET('photo',                   $_REQUEST['nombreFoto']);	
		}
		

		$usu -> _SET('mail',                   $_REQUEST['mail']);
		//SET de CUSTOME_HAS_ROLE
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('statusCustomerRole',         $_REQUEST['statusCustomerRole']);
		$usu -> _SET('terminationDate',                   $_REQUEST['terminationDate']);
		

		$model->Actualizar($usu);
		//header('location: vista.php');

?> 
<script type="text/javascript">
	window.parent.location.reload();
</script>
 <?php

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
		$camposDesabilitados = 'disabled';
		break;
		case 'cargaMasiva':


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
   if($i > 0){ 





       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
       leyendo hasta que encuentre un ; */
       $datos = explode(";",$linea);
 
       //Almacenamos los datos que vamos leyendo en una variable
       //usamos la función utf8_encode para leer correctamente los caracteres especiales
       $numeroRegistro = utf8_encode($datos[0]);
       if($numeroRegistro != ''){
       	
       
       $correoEmail = utf8_encode($datos[1]);
       $clavePassword = $datos[2];
       $tipoDocumento = utf8_encode($datos[3]);
       $numeroDocumento = utf8_encode($datos[4]);
       $primerNombre = utf8_encode($datos[5]);
       $segundoNombre = utf8_encode($datos[6]);
       $primerApellido = utf8_encode($datos[7]);
       $segundoApellido = utf8_encode($datos[8]);
 
       //guardamos en base de datos la línea leida
       $usu -> _SET('documentNumber',                   $numeroDocumento);
		$usu -> _SET('firstName',                   $primerNombre);
		$usu -> _SET('secondName',                   $segundoNombre);
		$usu -> _SET('firstLastName',                   $primerApellido);
		$usu -> _SET('secondLastName',                   $segundoApellido);
		$usu -> _SET('documentName',                   $tipoDocumento);
		//SET de USERS
		$usu -> _SET('passwordUser',                   $clavePassword);
		
		$usu -> _SET('photo',                   '');
		$usu -> _SET('mail',                   $correoEmail);
		//SET de CUSTOME_HAS_ROLE
		$usu -> _SET('roleId',                   4);
		$usu -> _SET('statusCustomerRole',                   1);
		$usu -> _SET('terminationDate',                   date('d-m-y'));

		$model->registroMasivo($usu);


/////////////////////////////////// correo 

$para = 'fullint7@gmail.com';
$titulo = 'Enviando email desde PHP'; 
$mensaje = '<html>'.
	'<head><title>Email con HTML</title></head>'.
	'<body><h1>Email con HTML</h1>'.
	'Esto es un email que se envía en el formato HTML'.
	'<hr>'.
	'Enviado por mi programa en PHP'.
	'</body>'.
	'</html>';
		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras .= 'From: Mi Nombre<yo@correo.com>';
		$enviado = mail($para, $titulo, $mensaje, $cabeceras);
 
if ($enviado){

  echo 'Email enviado correctamente';
}
else{
  echo 'Error en el envío del email';
}
/////////////////////////////////// correo 


}


       //cerramos condición


   }
 $i++;




   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   
   //cerramos bucle
}




		break;



	}
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
<center>
	<h1></h1>
<div class="container">
	<div class="panel panel-primary">
	<div class="panel-heading">FORMULARIO NUEVO CLIENTE</div>
	<div class="panel-body">

<form action ="" method="post" enctype="multipart/form-data">


<div class="form-group">
	<label>Tipo de Documento:</label>
	<select class="form-control" name="documentName"  >
	<?php
	foreach($db-> query('SELECT * FROM documentType')as $row){
	echo '<option value="'.$row['documentName'].'">'.$row['description'].'</option>';

	}
	?>


	</select>
	</div>

	<div class="form-group">
		<label>Identificacion:</label>
		<input  type="number" name="documentNumber" value="<?php echo $usu->_GET('documentNumber')?>" class="form-control" placeholder="Inserte Identificaion" required>
	</div>

	<div class="form-group">
		<label>Primer Nombre:</label>
		<input type="text" name="firstName" value="<?php echo $usu->_GET('firstName')?>"  class="form-control" placeholder="Inserte nombres" required>

    </div>

    <div class="form-group">
    	<label>Segundo Nombre:</label>
		<input type="text" name="secondName" value="<?php echo $usu->_GET('secondName')?>"  class="form-control" placeholder="Inserte Segundo nombre" >
	</div>

 	<div class="form-group">
    	<label>Primer Apellido:</label>
		<input type="text" name="firstLastName" value="<?php echo $usu->_GET('firstLastName')?>"  class="form-control" placeholder="Inserte su Apellido." required>
	</div>

	 <div class="form-group">
    	<label>Segundo Apellido:</label>
		<input type="text" name="secondLastName" value="<?php echo $usu->_GET('secondLastName')?>"  class="form-control" placeholder="Inserte su segundo apellido." >
	</div>

	<div class="form-group">
    	<label>Clave:</label>
		<input type="text" name="passwordUser" value="<?php echo $usu->_GET('passwordUser')?>"  class="form-control" placeholder="Inserte su Clave." required>
	</div>




	<div class="form-group" >
	<label>Tipos Rol:</label>
	<select class="form-control" name="roleId"  >
	<?php
	foreach($db-> query('SELECT * FROM role')as $row){
	echo '<option value="'.$row['roleId'].'">'.$row['description'].'</option>';

	}
	?>


	</select>
	</div>

	<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusCustomerRole')?>" >Estado del Rol</label>

	<select name="statusCustomerRole" class="form-control" id="select" value="<?php echo $usu->_GET('statusCustomerRole')?>">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
	
<div class="form-group">

    	<div class="divFotoo" id="lista_imagenes" onclick="on()"><strong><h4>DE CLIK PARA SUBIR SU FOTO:
    		<h4><strong><img class="divFotoo" src="../img/<?php echo $usu->_GET('photo')?>">
    	</div>
    	<input type="hidden" name="nombreFoto" value="<?php echo $usu->_GET('photo')?>">
    	<input type="file" id="archivo" class="file" name="archivo" style="visibility: hidden;"> 
	</div>
<br>
<br>
<div class="form-group">
<label>Mail:</label>

		<input type="text" name="mail" value="<?php echo $usu->_GET('mail')?>"  class="form-control" placeholder="Inserte su segundo correo." required>
	</div>

	<div class="form-group">
    	<label>Fecha:</label>
		<input type="date" name="terminationDate" value="<?php echo $usu->_GET('terminationDate')?>"  class="form-control" placeholder="Inserte su fheca." required>
	</div>





	<div class="form-group">
		<?php if($camposDesabilitados != 'disabled'){ ?>
		<input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action='?action=registrar';"/>
		<?php } ?>
		<input type="submit" class="btn btn-success" value="Actualizar" onclick="this.form.action='?action=Actualizar';"/>
		<input type="hidden" name="desabilitados" value="<?php echo $camposDesabilitados; ?>">
	</div>

	<div class="form-group">
	<p><a href="../customerHasRol2/documento.php">Siguiente</a></p>
</div>


	</form>


<form action="" enctype="multipart/form-data" method="post">
<input id="archivo" accept=".csv" name="archivo" type="file" /> 
   		<input name="MAX_FILE_SIZE" type="hidden" value="20000" />
		<input type="submit" class="btn btn-success" value="Carga Masiva" onClick="this.form.action='?action=cargaMasiva';"/>
</form>

	</div>
	</div>
	</div>
	<div class="container">
		<h2>Consulta-Registros</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Tipo Identificacion</th>
					<th>Identificacion</th>
					<th>Primer Nombre</th>
					<th>Segundo Nombre</th>
					<th>Primer Apellido</th>
					<th>Segundo Apellido</th>
				

					<th>Editar</th>
					<th>Eliminar</th>
					</tr>

			</thead>

		<?php 
         //sirve para debug
		 count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>

			<tr>
			<td><?php echo $r->_GET('documentName');?></td>
			<td><?php echo $r->_GET('documentNumber');?></td>
			<td><?php echo $r->_GET('firstName');?></td>
			<td><?php echo $r->_GET('secondName');?></td>
			<td><?php echo $r->_GET('firstLastName');?></td>
			<td><?php echo $r->_GET('secondLastName');?></td>
			

<td>


<a href="?action=editar&documentNumber=<?php echo $r->_GET('documentNumber'); ?>" class="btn btn-warning">Editar</a>
</td>
<td>
<a href="?action=eliminar&documentNumber=<?php echo $r->_GET('documentNumber'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

</td>
</tr>
<?php } ?>
</table>
</div>
</div>

</center>


<script>
              function archivo(evt) {
                  var files = evt.target.files; // FileList object

                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }

                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("lista_imagenes").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);

                    reader.readAsDataURL(f);
                  }
              }

              document.getElementById('archivo').addEventListener('change', archivo, true);
      </script>

</body>


</html>