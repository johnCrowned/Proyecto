<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new listachequeo();
$model = new listachequeoclas();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		$usu -> _SET('statusCL',                   $_REQUEST['statusCL']);
		$usu -> _SET('programCode_version',           $_REQUEST['programCode_version']);
		
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		$usu -> _SET('statusCL',                   $_REQUEST['statusCL']);
		$usu -> _SET('programCode_version',           $_REQUEST['programCode_version']);

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['listId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['listId']);
		break;
	}

}

?>

<!DOCTYPE html>	
<html lang="es">
<head>
	
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
	<div class="panel-heading">FORMULARIO NUEVA LISTA DE CHEQUEO</div>
	<div class="panel-body">

<form action ="" method="post">



	<div class="form-group">
		<label>id lista de chequeo:</label>
		<input type="number" name="listId" value="<?php echo $usu->_GET('listId')?>" class="form-control" placeholder="identificacion de lista" required>
	</div>




	
	<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusCL')?>" >Estado del Documento</label>

	<select name="statusCL" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
    </div>


	

	<div class="form-group">
	<label>programa:</label>
	<select class="form-control" name="programCode_version">
	<?php
	foreach($db-> query('SELECT * FROM program')as $row){
	echo '<option value="'.$row['programCode_version'].'">'.$row['programName'].'</option>';

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
					<th>id lista de chequeo</th>
					<th>estado lista de chequeo</th>
					<th>programa</th>
					
					
				

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
			<td><?php echo $r->_GET('listId');?></td>
			<td><?php if($r->_GET('statusCL')=="0"){
				echo "Inactivo";
			}else if ($r->_GET('statusCL')=="1"){
				echo "Activo";
			}
				?></td>
				}
			<td><?php echo $r->_GET('programCode_version');?></td>
			
			
				




			<td>
				<a href="?action=editar&listId=<?php echo $r->_GET('listId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&listId=<?php echo $r->_GET('listId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar esta lista de chequeo?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>


</html>