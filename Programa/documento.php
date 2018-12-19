<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new programa();
$model = new programaClas();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('programCode_version',       $_REQUEST['programCode_version']);
		$usu -> _SET('programName',                   $_REQUEST['programName']);
		$usu -> _SET('programStatusID',                   $_REQUEST['programStatusID']);
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('programCode_version',       $_REQUEST['programCode_version']);
		$usu -> _SET('programName',                   $_REQUEST['programName']);
		$usu -> _SET('programStatusID',                   $_REQUEST['programStatusID']);
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		



		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['programCode_version']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['programCode_version']);
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
	<div class="panel-heading">FORMULARIO NUEVO PROGRAMA</div>
	<div class="panel-body">

<form action ="" method="post">



	<div class="form-group">
		<label>Programa id:</label>
		<input type="number" name="programCode_version" value="<?php echo $usu->_GET('programCode_version')?>" class="form-control" placeholder="Inserte id" required>
	</div>




	

	<div class="form-group">
		<label>Programa nombre:</label>
		<input type="text" name="programName" value="<?php echo $usu->_GET('programName')?>" class="form-control" placeholder="Inserte nombre" required>
	</div>




	<div class="form-group">
	<label>Estados del Programa:</label>
	<select class="form-control" name="programStatusID">
	<?php
	foreach($db-> query('SELECT * FROM programStatus')as $row){
	echo '<option value="'.$row['programStatusID'].'">'.$row['programStatusID'].'</option>';

	}
	?>

	</select>
	</div>

	

	<div class="form-group">
	<label>Nivel de Formacion:</label>
	<select class="form-control" name="idLevelTraining">
	<?php
	foreach($db-> query('SELECT * FROM LevelTraining')as $row){
	echo '<option value="'.$row['idLevelTraining'].'">'.$row['descripcion'].'</option>';

	}
	?>

	</select>
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
		<h2>Consulta-Registros</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Codigo version</th>
					<th>Nombre del Programa</th>
					<th>Estado del Programa</th>
					<th>Nivel de formacion</th>
					
				

					<th>Editar</th>
					<th>Eliminar</th>
					</tr>

			</thead>

		<?php 

		 count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>
			<?php
			$r->_GET('idLevelTraining');
		$numero=$r->_GET('idLevelTraining');
			?>

			<tr>
			<td><?php echo $r->_GET('programCode_version');?></td>
			<td><?php echo $r->_GET('programName');?></td>
			<td><?php echo $r->_GET('programStatusID');?></td>
			<td><?php if (isset($numero)) {
			


		foreach($db-> query('SELECT descripcion FROM LevelTraining where idLevelTraining='.$r->_GET('idLevelTraining').'')as $row){

      // echo $r->_GET('programCode_version');
      
       echo $row['descripcion'];
	//echo '<option value="'.$row['programCode_version'].'">'.$row['programName'].'</option>';

	}
}

	// $r->_GET('idLevelTraining');?></td>
			
			
				




			<td>
				<a href="?action=editar&programCode_version=<?php echo $r->_GET('programCode_version'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&programCode_version=<?php echo $r->_GET('programCode_version'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>


</html>