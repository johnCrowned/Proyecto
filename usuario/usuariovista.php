<?php
require_once 'usuarioController.php';
require_once 'usuarioModel.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new persona();
$model = new usuarioModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('mail',                   $_REQUEST['mail']);
		$usu -> _SET('passwordUser',                   $_REQUEST['passwordUser']);
		$usu -> _SET('photo',                   $_REQUEST['photo']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('mail',                   $_REQUEST['mail']);
		$usu -> _SET('passwordUser',                   $_REQUEST['passwordUser']);
		$usu -> _SET('photo',                   $_REQUEST['photo']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);

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

//funcion para traer customer
		case 'editarr':
		$usu=$model->editar($_REQUEST['documentNumber']);
		break;
	}
}

?>

<!DOCTYPE html>	
<html lang="es">
<head>
	<title>
	

	</title>
	<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
	
</head>
<body background="#777">
<center>
<h2></h2>
<div class="container">
	
	<div class="panel panel-primary">
	<div class="panel-heading">CREAR USUARIO</div>
	<div class="panel-body">

<form action ="" method="post">


<div class="form-group" title="Escoja Aqui el Tipo de Documento." alt="TODOS LOS TIPOS DE DOCUMENTO">
	<label>Tipo de Documento:</label>
	<select class="form-control" name="documentName">
	<?php
	foreach($db-> query('SELECT * FROM documentType')as $row){
	echo '<option value="'.$row['documentName'].'">'.$row['description'].'</option>';

	}
	?>


	</select>
	</div>

	

	<div class="form-group" title="Ingrese aqui su numero de Documento.">
	<label>Identificacion:</label>
	<select class="form-control" name="documentNumber">
	<?php
	foreach($db-> query('SELECT * FROM customer')as $row){
	echo '<option value="'.$row['documentNumber'].'">'.$row['documentNumber'].'</option>';

	}
	?>
	</select>
	</div>

	<div class="form-group" title="Ingrese Aqui la Clave que decesa.">
		<label>Password:</label>
		<input type="text" name="passwordUser" value="<?php echo $usu->_GET('passwordUser')?>"  class="form-control" placeholder="Inserte su clave" >

    </div>

    <div class="form-group" title="Eliga la Foto que sera para su Perfil.">
    	<label>Foto:</label>
		<input type="text" name="photo" value="<?php echo $usu->_GET('photo')?>"  class="form-control" placeholder="Inserte foto" >
	</div>

 	<div class="form-group" title="Ingrese Aqui su correo Electronico">
    	<label>Correo Electronico:</label>
		<input type="text" name="mail" value="<?php echo $usu->_GET('mail')?>"  class="form-control" placeholder="Inserte su correo." required>
	</div>

	


	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Guardar" title="Esta Acticon Guarda todos los datos Ingresados." onclick="this.form.action='?action=registrar';"/>
		<input type="submit" class="btn btn-success" value="Actualizar" title="Esta Action Actualiza los Campos que aya Modificado." onclick="this.form.action='?action=Actualizar';"/>
	</div>

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
					<th>Correo</th>
					<th>Foto</th>
					<th>Clave</th>
				
				

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
			<td><?php echo $r->_GET('mail');?></td>
			<td><?php echo $r->_GET('photo');?></td>
			<td><?php echo $r->_GET('passwordUser');?></td>
			
			

			<td>
				<a href="?action=editar&documentNumber=<?php echo $r->_GET('documentNumber'); ?>" title="Trae Todos los datos del registro." class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&documentNumber=<?php echo $r->_GET('documentNumber'); ?>" title="Elimina El registro por Completo." class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>


	


</center>

</body>


</html>