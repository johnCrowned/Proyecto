<?php
require_once 'programStatusController.php';
require_once 'programStatusModel.php';
require_once 'SOSPConexion.php';


//logica
$r = array();
$usu = new programStatus();
$model = new programStatusModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('programStatusID',                   $_REQUEST['programStatusID']);
		$usu -> _SET('idStatus',                   $_REQUEST['idStatus']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('programStatusID',                   $_REQUEST['programStatusID']);
		$usu -> _SET('idStatus',                   $_REQUEST['idStatus']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['programStatusID']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['programStatusID']);
		break;
	}
}

?>

<!DOCTYPE html>	
<html lang="es">
<head>
	<title>
	

	</title>
	<link rel="stylesheet"  href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>
</head>
<body>
<center>
<div clss="container">
	<h2>estados de formacion</h2>
	<div class="panel panel-primary">
	<div class="panel-heading">FORMULARIO ESTADOS DE FORMACION</div>
	<div class="panel-body">

<form action ="" method="post">


	<div class="form-group">
		<label>ID del Estado</label>
		<input type="text" name="programStatusID" value="<?php echo $usu->_GET('programStatusID')?>" class="form-control" placeholder="Inserte el nombre del estado" required>
	</div>

	<div class="form-group">
		<label>estado</label>
		<input type="text" name="idStatus" value="<?php echo $usu->_GET('idStatus')?>" class="form-control" placeholder="Inserte el ID del estado." required>
	</div>

	

    
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action='?action=registrar';"/>
		<input type="submit" class="btn btn-success" value="Actualizar" onclick="this.form.action='?action=Actualizar';"/>
	</div>

	</form>
	</div>
	</div>
	</div>
	<div class="container">
		<h2>Consulta-Registros-Niveles de formación</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Nombre del estado de formacion</th>
					<th>ID del estado de formacion</th>
			

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
			<td><?php echo $r->_GET('programStatusID');?></td>
			<td><?php echo $r->_GET('idStatus');?></td>
			

			<td>
				<a href="?action=editar&programStatusID=<?php echo $r->_GET('programStatusID'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&programStatusID=<?php echo $r->_GET('programStatusID'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>