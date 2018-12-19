<?php
require_once 'estadoController.php';
require_once 'estadoModel.php';
require_once 'SOSPConexion.php';


//logica
$r = array();
$usu = new estado();
$model = new estadoInfo();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('statusId',                   $_REQUEST['statusId']);
		$usu -> _SET('statusF',                   $_REQUEST['statusF']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('statusId',                   $_REQUEST['statusId']);
		$usu -> _SET('statusF',                   $_REQUEST['statusF']);
		


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['statusId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['statusId']);
		break;
	}
}

?>

<!DOCTYPE html>	
<html lang="es">
<head>
	<title>
	

	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>
</head>
<body>
<center>
<div clss="container">

	<div class="panel panel-primary">
	<div class="panel-heading">Estado de Formacion.</div>
	<div class="panel-body">

<form action ="" method="post">


	

	<div class="form-group">
		<label>Id del Estado de Formacion</label>
		<input type="text" name="statusId" value="<?php echo $usu->_GET('statusId')?>" class="form-control" placeholder="Inserte Id del Rol." required>
	</div>

<div class="form-group">
		<label>Descricion estado de formacion</label>
		<input type="text" name="statusF" value="<?php echo $usu->_GET('statusF')?>" class="form-control" placeholder="Inserte la descricion del estado de formacion a crear." required>
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
		<h2>Consulta-Rol</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Estado de formacion </th>
					<th>Descricion estadode formacion</th>
					
			

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
			<td><?php echo $r->_GET('estatusId');?></td>
			<td><?php echo $r->_GET('estatusF');?></td>
			
			

			<td>
				<a href="?action=editar&roleId=<?php echo $r->_GET('estatusId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&roleId=<?php echo $r->_GET('estatusId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Rol.?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>