<?php
require_once 'apprenticeController.php';
require_once 'apprenticeModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new aprendiz();
$model = new aprendizClass();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('statusId',                   $_REQUEST['statusId']);
		$usu -> _SET('documentNumber',             $_REQUEST['documentNumber']);
		$usu -> _SET('documentName',               $_REQUEST['documentName']);
		$usu -> _SET('fichaNumber',                $_REQUEST['fichaNumber']);
		$usu -> _SET('groupCode',                  $_REQUEST['groupCode']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('statusId',                   $_REQUEST['statusId']);
		$usu -> _SET('documentNumber',             $_REQUEST['documentNumber']);
		$usu -> _SET('documentName',               $_REQUEST['documentName']);
		$usu -> _SET('fichaNumber',                $_REQUEST['fichaNumber']);
		$usu -> _SET('groupCode',                  $_REQUEST['groupCode']);


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
      <div class="panel-heading" align="center">APRENDIZ</div>
            <div class="panel-body">

<form action="SOSConexion.php" method="post"> 

    

    <div class="form-group">
	<label>Estado:</label>
	<select class="form-control" name="statusId">
	<?php
	foreach($db-> query('SELECT * FROM formationStatus')as $row){
	echo '<option value="'.$row['statusId'].'">'.$row['statusId'].'</option>';

	}
	?>
	</select>
	</div>




    <div class="form-group">
	<label>Numero Documento:</label>
	<select class="form-control" name="documentNumber">
	<?php
	foreach($db-> query('SELECT * FROM customer')as $row){
	echo '<option value="'.$row['documentNumber'].'">'.$row['documentNumber'].'</option>';

	}
	?>
	</select>
	</div>


    

    <div class="form-group">
	<label>Tipo Documento:</label>
	<select class="form-control" name="documentName">
	<?php
	foreach($db-> query('SELECT * FROM documentType')as $row){
	echo '<option value="'.$row['documentName'].'">'.$row['documentName'].'</option>';

	}
	?>
	</select>
	</div>


    

    <div class="form-group">
	<label>Numero Ficha:</label>
	<select class="form-control" name="fichaNumber">
	<?php
	foreach($db-> query('SELECT * FROM ficha')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'</option>';

	}
	
	?>
	</select>
	</div>
	
	

	

	<div class="form-group">
	<label>Codigo Grupo:</label>
	<select class="form-control" name="groupCode">
	<?php
	foreach($db-> query('SELECT * FROM projectGroup')as $row){

	
	echo '<option value="'.$row['groupCode'].'">'.$row['proyectName'].'</option>';

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
		<h2>CONSULTA - REGISTRO </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Estado</th>
					<th>Numero Documento</th>
					<th>Tipo Documento</th>
					<th>Numero Ficha</th>
					<th>Codigo Grupo</th>
					<th>Editar</th>
					<th>Eliminar</th>
					</tr>

			</thead>

		<?php 
		 $row['groupCode'];
		  $numero=$row['groupCode'];
         //sirve para debug
		 count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>

			<tr>
			<td><?php echo $r->_GET('statusId');?></td>
			<td><?php echo $r->_GET('documentNumber');?></td>
			<td><?php echo $r->_GET('documentName');?></td>
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php  if (isset($numero)){
			
			 foreach($db-> query('SELECT proyectName FROM projectgroup where groupCode='.$r->_GET('groupCode').'')as $row){

			 	 echo $row['proyectName'];

}
			}
			?></td>
			





			<td>
				<a href="?action=editar&documentNumber=<?php echo $r->_GET('documentNumber'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&documentNumber=<?php echo $r->_GET('documentNumber'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este aprendiz?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>


