<?php
require_once 'rolController.php';
require_once 'rolModel.php';
require_once 'SOSPConexion.php';


//logica
$r = array();
$usu = new role();
$model = new rolModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('description',                   $_REQUEST['description']);
		$usu -> _SET('statusRole',                   $_REQUEST['statusRole']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('description',                   $_REQUEST['description']);
		$usu -> _SET('statusRole',                   $_REQUEST['statusRole']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['roleId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['roleId']);
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
	<h2>Rol</h2>
	<div class="panel panel-primary">
	<div class="panel-heading">Tipos de Rol</div>
	<div class="panel-body">

<form action ="" method="post">


	

	<div class="form-group">
		<label>Id del Rol</label>
		<input type="text" name="roleId" value="<?php echo $usu->_GET('roleId')?>" class="form-control" placeholder="Inserte Id del Rol." required>
	</div>

<div class="form-group">
		<label>Estado del rol</label>
		<input type="text" name="statusRole" value="<?php echo $usu->_GET('statusRole')?>" class="form-control" placeholder="Inserte el estado del Rol" required>
	</div>

	<div class="form-group">
		<label>Descripcion del rol</label>
		<input type="text" name="description" value="<?php echo $usu->_GET('description')?>" class="form-control" placeholder="Inserte la Descripcion del Rol" required>
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
					<th>Id del Rol</th>
					<th>Estado del Rol</th>
					<th>Descripcion del Rol</th>
			

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
			<td><?php echo $r->_GET('roleId');?></td>
			<td><?php echo $r->_GET('statusRole');?></td>
			<td><?php echo $r->_GET('description');?></td>
			

			<td>
				<a href="?action=editar&roleId=<?php echo $r->_GET('roleId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&roleId=<?php echo $r->_GET('roleId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Rol.?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>