a<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new ficha();
$model = new fichaClas();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('statusf',                   $_REQUEST['statusf']);
		$usu -> _SET('programCode_version',          $_REQUEST['programCode_version']);
		$usu -> _SET('workingDayName',          $_REQUEST['workingDayName']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('statusf',                   $_REQUEST['statusf']);
		$usu -> _SET('programCode_version',          $_REQUEST['programCode_version']);
		$usu -> _SET('workingDayName',          $_REQUEST['workingDayName']);

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['fichaNumber']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['fichaNumber']);
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
	<div class="panel-heading">FORMULARIO NUEVO FICHA</div>
	<div class="panel-body">

<form action ="" method="post">



	<div class="form-group">
		<label>Numero de la Ficha:</label>
		<input type="number" name="fichaNumber" value="<?php echo $usu->_GET('fichaNumber')?>" class="form-control" placeholder="Inserte  fich id" required>
	</div>





	<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusf')?>" >Estado de la Valoracion</label>

	<select name="statusf" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
      </div>


	

	<div class="form-group">
	<label>Programa:</label>
	<select class="form-control" name="programCode_version">
	<?php
	foreach($db-> query('SELECT * FROM program')as $row){
	echo '<option value="'.$row['programCode_version'].'">'.$row['programName'].'</option>';

	}
	?>

	</select>
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
					<th>Ficha</th>
					<th>Estado</th>
					<th>Programa</th>
					<th>Jornada</th>
					
				

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
			$r->_GET('programCode_version');
			 $numero=$r->_GET('programCode_version');
			

			?>

			<tr>
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php if( $r->_GET('statusf')=="0"){ echo "Inactivo";
			}else if($r->_GET('statusf')=="1"){echo "Activo";}

			?></td>



		<td><?php if (isset($numero)) {
			


	
	foreach($db-> query('SELECT ficha.programCode_version,program.programName,program.programCode_version FROM ficha,program
		where ficha.programCode_version=program.programCode_version

	 ')as $row){

	
	echo '<option value="'.$row['programCode_version'].'">'.$row['programName'].'</option>';

	}
	



				
			} ?></td>




			<td><?php echo $r->_GET('workingDayName');?></td>
			
				




			<td>
				<a href="?action=editar&fichaNumber=<?php echo $r->_GET('fichaNumber'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&fichaNumber=<?php echo $r->_GET('fichaNumber'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>


</html>