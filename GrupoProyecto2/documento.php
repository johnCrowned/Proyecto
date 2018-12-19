<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new grupo();
$model = new grupoClas();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('groupCode',       $_REQUEST['groupCode']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('proyectName',                   $_REQUEST['proyectName']);
		$usu -> _SET('statusP',                   $_REQUEST['statusP']);
		
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('groupCode',       $_REQUEST['groupCode']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('proyectName',                   $_REQUEST['proyectName']);
		$usu -> _SET('statusP',                   $_REQUEST['statusP']);
		



		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['groupCode']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['groupCode']);
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
	<div class="panel-heading">GRUPOS PROYECTO</div>
	<div class="panel-body">

<form action ="" method="post">



	<div class="form-group">
		<label>grupo id:</label>
		<input type="number" name="groupCode" value="<?php echo $usu->_GET('groupCode')?>" class="form-control" placeholder="grupo  id" required>
	</div>



<div class="form-group">
	<label>Numero de Ficha:</label>
	<select class="form-control" name="fichaNumber">
	<?php
	foreach($db-> query('SELECT * FROM ficha')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'</option>';

	}
	?>

	</select>
	</div>


	

	<div class="form-group">
		<label>Nombre del proyecto:</label>
		<input type="text" name="proyectName" value="<?php echo $usu->_GET('proyectName')?>" class="form-control" placeholder="proyecto nombre" required>
	</div>



	<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusP')?>" >Estado del Proyecto</label>

	<select name="statusP" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
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
					<th>Codigo dle Grupo</th>
					<th>ficha del proyecto</th>
					<th>nombre del proyecto</th>
					<th>Estado del protecto</th>
					
				

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
			<td><?php echo $r->_GET('groupCode');?></td>
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php echo $r->_GET('proyectName');?></td>
			<td><?php  if($r->_GET('statusP')=="0"){
				echo "Inactivo";
			}else if ($r->_GET('statusP')=="1"){
				echo "Activo";}
				;?></td>
			
			
			
				




			<td>
				<a href="?action=editar&groupCode=<?php echo $r->_GET('groupCode'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&groupCode=<?php echo $r->_GET('groupCode'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>


</html>