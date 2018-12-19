se<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new customerHasRol();
$model = new usuarioModel();
$db = database::conectar();
$camposDesabilitados = '';
if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('statusCustomerRole',                   $_REQUEST['statusCustomerRole']);
		$usu -> _SET('terminationDate',                   $_REQUEST['terminationDate']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('statusCustomerRole',                   $_REQUEST['statusCustomerRole']);
		$usu -> _SET('terminationDate',                   $_REQUEST['terminationDate']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);

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
	}

}

?>

<!DOCTYPE html>	
<html lang="es">
<head>
	<title>
	

	</title>
	<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>
</head>
<body>
<center>
	
<div class="container">
	<h2></h2>
	<div class="panel panel-primary">
	<div class="panel-heading">ASIGNACIÓN DE ROLES</div>
	<div class="panel-body">

<form action ="" method="post">


<div class="form-group">
	<label>Tipo de Documento:</label>
	<select class="form-control" name="documentName">
	<?php
	foreach($db-> query('SELECT * FROM documentType')as $row){
	echo '<option value="'.$row['documentName'].'">'.$row['description'].'</option>';

	}
	?>


	</select>
	</div>

	

	<div class="form-group">
	<label>Identificacion:</label>
	<select class="form-control" name="documentNumber">
	<?php
	foreach($db-> query('SELECT * FROM customer')as $row){
	echo '<option value="'.$row['documentNumber'].'">'.$row['documentNumber'].'</option>';

	}
	?>
	</select>
	</div>

	

	<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusCustomerRole')?>" >Estado del Rol</label>

	<select name="statusCustomerRole" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>



    <div class="form-group">
	<label>Roles:</label>
	<select class="form-control" name="roleId">
	<?php
	foreach($db-> query('SELECT * FROM role')as $row){
	echo '<option value="'.$row['roleId'].'">'.$row['description'].'</option>';

	}
	?>

	</select>
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
					<th>Rol</th>
					<th>Estado del Rol</th>
					<th>Fecha</th>
					
				

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
			
			<td><?php if($r->_GET('roleId')=="1"){ echo "Aprendiz";

			}else if($r->_GET('roleId')=="2"){

				echo "Instructor";
			}else if($r->_GET('roleId')=="3"){

				echo "Administrador";
			}else if($r->_GET('roleId')=="4"){

				echo "Aprendiz";
			}

			?></td>
			<td><?php if($r->_GET('statusCustomerRole')=="1"){ echo "Activo";

			}else if($r->_GET('statusCustomerRole')=="0"){

				echo "Inactivo";
			}

			?></td>
			<td><?php echo $r->_GET('terminationDate');?></td>
			
				




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

</body>


</html>