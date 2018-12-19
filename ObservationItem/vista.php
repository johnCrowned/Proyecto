<?php
require_once 'valorationController.php';
require_once 'valorationModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new ObservationItem();
$model = new ObservationClass();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('observationId',                 $_REQUEST['observationId']);
		$usu -> _SET('observation',                   $_REQUEST['observation']);
		$usu -> _SET('jury',                   $_REQUEST['jury']);
		$usu -> _SET('dateOI',                   $_REQUEST['dateOI']);
		$usu -> _SET('userOI',                   $_REQUEST['userOI']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('groupCode',                   $_REQUEST['groupCode']);
		$usu -> _SET('itemId',                   $_REQUEST['itemId']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('observationId',                 $_REQUEST['observationId']);
		$usu -> _SET('observation',                   $_REQUEST['observation']);
		$usu -> _SET('jury',                   $_REQUEST['jury']);
		$usu -> _SET('dateOI',                   $_REQUEST['dateOI']);
		$usu -> _SET('userOI',                   $_REQUEST['userOI']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('groupCode',                   $_REQUEST['groupCode']);
		$usu -> _SET('itemId',                   $_REQUEST['itemId']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['observationId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['observationId']);
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
	
</head>
<body>
<center>


  <div class="container">
		<h2></h2>
	<div class="panel panel-info">
      <div class="panel-heading" align="center">Respuesta Grupo</div>
            <div class="panel-body"><br><br>

<form action="SOSConexion.php" method="post"> 

 <div class="form-group">
		<label>ID Observacion:</label>
		<input type="number" name="observationId" value="<?php echo $usu->_GET('observationId')?>" class="form-control" placeholder="Inserte ID de la observacion" required>
	</div>


	

 	<div class="form-group">
		<label>Observacion:</label>
		<input type="text" name="observation" value="<?php echo $usu->_GET('observation')?>" class="form-control" placeholder="Inserte  la observacion" required>
	</div>


<div class="form-group">
		<label>Jurado:</label>
		<input type="text" name="jury" value="<?php echo $usu->_GET('jury')?>" class="form-control" placeholder="Jurado" required>
	</div>


<div class="form-group">
		<label>Fecha:</label>
		<input type="Fecha" name="dateOI" value="<?php echo $usu->_GET('dateOI')?>" class="form-control" placeholder="Fecha" required>
	</div>



	<div class="form-group">
		<label>Usuario:</label>
		<input type="Fecha" name="userOI" value="<?php echo $usu->_GET('userOI')?>" class="form-control" placeholder="Usuario" required>
	</div>



  <div class="form-group">
	<label>Numeros Ficha:</label>
	<select class="form-control" name="fichaNumber">
	<?php
	foreach($db-> query('SELECT * FROM groupanswer')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'</option>';

	}
	?>


	</select>
	</div>
      <br>



    <div class="form-group">
	<label>Numero Grupo:</label>
	<select class="form-control" name="groupCode">
	<?php
	foreach($db-> query('SELECT * FROM groupanswer')as $row){
	echo '<option value="'.$row['groupCode'].'">'.$row['groupCode'].'</option>';

	}
	?>


	</select>
	</div>
     <br>


     <div class="form-group">
	<label>ID Items:</label>
	<select class="form-control" name="itemId">
	<?php
	foreach($db-> query('SELECT * FROM groupanswer')as $row){
	echo '<option value="'.$row['itemId'].'">'.$row['itemId'].'</option>';

	}
	?>


	</select>
	</div>
     <br>


     <div class="form-group">
	<label>Numeros Ficha:</label>
	<select class="form-control" name="listId">
	<?php
	foreach($db-> query('SELECT * FROM groupanswer')as $row){
	echo '<option value="'.$row['listId'].'">'.$row['listId'].'</option>';

	}
	?>


	</select>
	</div>
     <br>
	
	
	
	

	

    
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action='?action=registrar';"/>
		<input type="submit" class="btn btn-success" value="Actualizar" onclick="this.form.action='?action=Actualizar';"/>
	</div>

	</form>
	</div>
	</div>
	</div>
	<div class="container">
		<h2>CONSULTAR TIPOS DE INSTRUCTOR </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>ID de la Observacion</th>
					<th>Observacion</th>
					<th>Jurado</th>
					<th>Fecha</th>
					<th>Usuario</th>
					<th>Numero Ficha</th>
					<th>Numero Grupo</th>
					<th>ID Items</th>
					<th>ID listId</th>
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
			<td><?php echo $r->_GET('observationId');?></td>
			<td><?php echo $r->_GET('observation');?></td>
			<td><?php echo $r->_GET('jury');?></td>
			<td><?php echo $r->_GET('dateOI');?></td>
			<td><?php echo $r->_GET('userOI');?></td>
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php echo $r->_GET('groupCode');?></td>
			<td><?php echo $r->_GET('itemId');?></td>
			<td><?php echo $r->_GET('listId');?></td>
			

			<td>
				<a href="?action=editar&observationId=<?php echo $r->_GET('observationId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&observationId=<?php echo $r->_GET('observationId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>


