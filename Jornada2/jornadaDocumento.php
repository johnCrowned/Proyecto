<?php
require_once 'jornadaController.php';
require_once 'jornadaModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new workingDay();
$model = new jornadaModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('workingDayName',                   $_REQUEST['workingDayName']);
		$usu -> _SET('statusW',                   $_REQUEST['statusW']);
		$usu -> _SET('description',                   $_REQUEST['description']);

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('workingDayName',                   $_REQUEST['workingDayName']);
		$usu -> _SET('statusW',                   $_REQUEST['statusW']);
		$usu -> _SET('description',                   $_REQUEST['description']);

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['workingDayName']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['workingDayName']);
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
	<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
</head>
<body>
<center>
<div class="container">
	<h2></h2>
	<div class="panel panel-info">
	<div class="panel-heading">FORMUlARIO NUEVA JORNADA</div>
	<div class="panel-body">

<form action ="" method="post">


	<div class="form-group">
		<label>Nombre de la Jornada</label>
		<input type="text" name="workingDayName" value="<?php echo $usu->_GET('workingDayName')?>" class="form-control" placeholder="Inserte Nombre de la Jornada" required>
	</div>


	<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusW')?>" >Estado de la Valoracion</label>

	<select name="statusW" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
      </div>



	<div class="form-group">
		<label>Descripcion de la Jornada </label>
		<input type="text" name="description" value="<?php echo $usu->_GET('description')?>"  class="form-control" placeholder="Inserte la Descripcion" required>

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
		<h2>Consulta-Registros-Jornadas</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Estado de la Jornada</th>
					<th>Nombre de la Jornada</th>
					<th>Descripcion de la Jornada</th>

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
			<td><?php if($r->_GET('statusW')=="0"){echo "Inactivo";
			}else if ($r->_GET('statusW')=="1"){echo "Activo";
			}

			 ?></td>
			<td><?php echo $r->_GET('workingDayName');?></td>
			<td><?php echo $r->_GET('description');?></td>

			<td>
				<a href="?action=editar&workingDayName=<?php echo $r->_GET('workingDayName'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&workingDayName=<?php echo $r->_GET('workingDayName'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar esta jornada?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>


</html>