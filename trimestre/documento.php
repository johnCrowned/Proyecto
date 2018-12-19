<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new trimestre();
$model = new trimestreclas();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('trimesterId',                   $_REQUEST['trimesterId']);
		$usu -> _SET('workingDayName',                   $_REQUEST['workingDayName']);
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('trimesterId',                   $_REQUEST['trimesterId']);
		$usu -> _SET('workingDayName',                   $_REQUEST['workingDayName']);
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['trimesterId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['trimesterId']);
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
	<div class="panel-heading">FORMULARIO NUEVO TRIMESTRE</div>
	<div class="panel-body">

<form action ="" method="post">



	<div class="form-group">
		<label>Numero del Trimestre :</label>
		<input type="number" name="trimesterId" value="<?php echo $usu->_GET('trimesterId')?>" class="form-control" placeholder="Inserte id" required>
	</div>




	

	<div class="form-group">
	<label>Jornada:</label>
	<select class="form-control" name="workingDayName">
	<?php
	foreach($db-> query('SELECT * FROM workingDay')as $row){
	echo '<option value="'.$row['workingDayName'].'">'.$row['workingDayName'].'</option>';

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
					<th>Trimestre</th>
					<th>Jornada</th>
					<th>Nivel de formacion</th>
					
					
				

					<th>Editar</th>
					<th>Eliminar</th>
					</tr>

			</thead>

		<?php 
         //sirve para debug
		 count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>

			<?php
			$r->_GET('idLevelTraining');
			 $numero=$r->_GET('idLevelTraining');
			

			?>

			<tr>
			<td><?php echo $r->_GET('trimesterId');?></td>
			<td><?php echo $r->_GET('workingDayName');?></td>
			
			
			<td><?php if (isset($numero)) {
			


		foreach($db-> query('SELECT descripcion FROM leveltraining where idLevelTraining='.$r->_GET('idLevelTraining').'')as $row){

      // echo $r->_GET('programCode_version');
      
       echo $row['descripcion'];
	//echo '<option value="'.$row['programCode_version'].'">'.$row['programName'].'</option>';

	}
}  ?></td>
				




			<td>
				<a href="?action=editar&trimesterId=<?php echo $r->_GET('trimesterId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&trimesterId=<?php echo $r->_GET('trimesterId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>


</html>