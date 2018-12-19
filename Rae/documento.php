<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new RAE();
$model = new RAECLASS();
$db = database::conectar();
$camposDesabilitados = '';

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('codeL',                   $_REQUEST['codeL']);
		$usu -> _SET('denomination',                   $_REQUEST['denomination']);
		$usu -> _SET('codeC',          $_REQUEST['codeC']);
		$usu -> _SET('programCode_version',          $_REQUEST['programCode_version']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('codeL',                   $_REQUEST['codeL']);
		$usu -> _SET('denomination',                   $_REQUEST['denomination']);
		$usu -> _SET('codeC',          $_REQUEST['codeC']);
		$usu -> _SET('programCode_version',          $_REQUEST['programCode_version']);

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['codeL']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['codeL']);
		$camposDesabilitados = 'disabled';
		break;
	}

}

?>

<!DOCTYPE html>	
<html lang="es">
<head>
	<title>
	Ejemplo-juan

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
	<div class="panel-heading">FORMULARIO  RAE</div>
	<div class="panel-body">

<form action ="" method="post">



	<div class="form-group">
		<label>ID del RAE:</label>
		<input type="number" name="codeL" value="<?php echo $usu->_GET('codeL')?>" class="form-control" placeholder="Id RAE" required>
	</div>




	<div class="form-group">
		<label>Descripcion del RAE:</label>
		<input type="text" name="denomination" value="<?php echo $usu->_GET('denomination')?>" class="form-control" placeholder="descripcion" required>
	</div>

	


	

	<div class="form-group">
	<label>Competencia:</label>
	<select class="form-control" name="codeC">
	<?php
	foreach($db-> query('SELECT * FROM competence')as $row){
	echo '<option value="'.$row['codeC'].'">'.$row['codeC'].'</option>';

	}
	?>

	</select>
	</div>


<div class="form-group">
	<label>Programa version:</label>
	<select class="form-control" name="programCode_version">
	<?php
	foreach($db-> query('SELECT * FROM competence')as $row){
	echo '<option value="'.$row['programCode_version'].'">'.$row['programCode_version'].'</option>';

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
					<th>Codigo Rae</th>
					<th>Descripcion</th>
					<th>Codigo Competencia</th>
					<th>version del programa</th>
					
				

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
			<td><?php echo $r->_GET('codeL');?></td>
			<td><?php echo $r->_GET('denomination');?></td>
			<td><?php echo $r->_GET('codeC');?></td>
			<td><?php echo $r->_GET('programCode_version');?></td>
			
				




			<td>
				<a href="?action=editar&codeL=<?php echo $r->_GET('codeL'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&codeL=<?php echo $r->_GET('codeL'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>










</body>


</html>