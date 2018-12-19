<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new fichaInstructor();
$model = new fichaInstructorClass();
$db = database::conectar();
$camposDesabilitados = '';
if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('trimesterId',                   $_REQUEST['trimesterId']);
		$usu -> _SET('workingDayName',                   $_REQUEST['workingDayName']);
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		$usu -> _SET('insTypeId',                   $_REQUEST['insTypeId']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('documentNumber',                   $_REQUEST['documentNumber']);
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('trimesterId',                   $_REQUEST['trimesterId']);
		$usu -> _SET('workingDayName',                   $_REQUEST['workingDayName']);
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		$usu -> _SET('insTypeId',                   $_REQUEST['insTypeId']);

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
	<h1></h1>
<div class="container">
	<h2></h2>
	<div class="panel panel-primary">
	<div class="panel-heading">FICHA INSTRUCTOR</div>
	<div class="panel-body">

<form action ="" method="post">


<div class="form-group">
	<label>Tipo de Documento:</label>
	<select class="form-control" name="documentName">
	<?php
	foreach($db-> query('SELECT documentName FROM customer where documentNumber="1022997832"')as $row){
	echo '<option value="'.$row['documentName'].'">'.$row['documentName'].'</option>';

	}
	?>


	</select>
	</div>

	<div class="form-group">
	<label>Numero de Docuento:</label>
	<select class="form-control" name="documentNumber">
	<?php
	foreach($db-> query('SELECT documentNumber FROM customer_has_role where roleId=2 ')as $row){
	echo '<option value="'.$row['documentNumber'].'">'.$row['documentNumber'].'</option>';

	}
	?>

	</select>
	</div>


	<div class="form-group">
	<label>Numero de Ficha:</label>
	<select class="form-control" name="fichaNumber">
	<?php
	foreach($db-> query('SELECT * FROM ficha')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'-'.$row['workingDayName'].'</option>';

	}
	?>

	</select>
	</div>


    <div class="form-group">
	<label>ID del trimestre</label>
	<select class="form-control" name="trimesterId">
	<?php
	foreach($db-> query('SELECT * FROM trimester')as $row){
	echo '<option value="'.$row['trimesterId'].'">'.$row['trimesterId'].'-Trimestre-'.$row['workingDayName'].'</option>';

	}
	?>

	</select>
	</div>


	<div class="form-group">
	<label>Jornada de formacion</label>
	<select class="form-control" name="workingDayName">
	<?php
	foreach($db-> query('SELECT * FROM trimester')as $row){
	echo '<option value="'.$row['workingDayName'].'">'.$row['workingDayName'].'</option>';

	}
	?>

	</select>
	</div>



	<div class="form-group">
	<label>Nivel de Formacion</label>
	<select class="form-control" name="idLevelTraining">
	<?php
	foreach($db-> query('SELECT * FROM trimester')as $row){
	echo '<option value="'.$row['idLevelTraining'].'">'.$row['idLevelTraining'].'</option>';

	}
	?>

	</select>
	</div>


	<div class="form-group">
	<label>Tipo de Instructor:</label>
	<select class="form-control" name="insTypeId">
	<?php
	foreach($db-> query('SELECT * FROM instructortype')as $row){
	echo '<option value="'.$row['insTypeId'].'">'.$row['insTypeId'].'</option>';

	}
	?>

	</select>
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
					<th>ficha</th>
					<th>trimestre</th>
					<th>jornada</th>
					<th>Nivel de Formacion</th>
					<th>intructor de la ficha</th>
					
				

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
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php echo $r->_GET('trimesterId');?></td>
			<td><?php echo $r->_GET('workingDayName');?></td>
			<td><?php  if ($r->_GET('idLevelTraining')==1)
			{ 
				 echo "Tecnologo";


			}else if($r->_GET('idLevelTraining')==2){
			echo "Tecnico";	
			}

			?></td>
			<td><?php echo $r->_GET('insTypeId');?></td>	




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