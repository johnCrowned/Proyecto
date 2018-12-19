<?php
require_once 'generalobservationController.php';
require_once 'generalobservationModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new GeneralObservation();
$model = new ObservationClass();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('observationId',                 $_REQUEST['observationId']);
		$usu -> _SET('observation',                   $_REQUEST['observation']);
		$usu -> _SET('jury',                   $_REQUEST['jury']);
		$usu -> _SET('dateGO',                   $_REQUEST['dateGO']);
		$usu -> _SET('userGO',                   $_REQUEST['userGO']);
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('groupCode',                   $_REQUEST['groupCode']);

		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':

for ($i=0; $i < count($_REQUEST['observation']); $i++) { 	

if(isset($_REQUEST['data'][$i])){

$data = explode('***', $_REQUEST['data'][$i]);

//echo '<br>'.$data[0]." ".$data[1]." ".$_REQUEST['observation'][$i]." ".$_REQUEST['jury'][$i]." ".$_REQUEST['dateGO'][$i];
		
		$usu -> _SET('observation',                   $_REQUEST['observation'][$i]);
		$usu -> _SET('jury',                   		  $_REQUEST['jury'][$i]);
		$usu -> _SET('dateGO',                   	  $_REQUEST['dateGO'][$i]);
		$usu -> _SET('fichaNumber',                   $data[1]);
		$usu -> _SET('groupCode',                     $data[0]);
		
		$model->registrar($usu);

}
}
		
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


  

<form action="SOSConexion.php" method="post"> 

 

	</form>
	</div>
	</div>
	</div>
	<div class="container">
		<h2>CONSULTAR TIPOS DE INSTRUCTOR </h2>
		<div class="table-responsive">
			
			</div>
			</div>

</center>


<form action="" method="post"> 

<table border="4" class="table table-striped" >
	<tr> 
	<td>chek</td>
	<td>Numero de ficha</td>
	<td>Numero de grupo</td>
	<td>Descripcion</td>
	<td>Jurado</td>
	<td>Fecha</td>

	</tr>

	<?php 
	$i = 0;
	foreach($db-> query('SELECT * FROM groupanswer')as $row){ ?>
	<tr> 
	<td><input name="data[<?php echo $i; ?>]" type="checkbox" id="d" value="<?php echo $row['groupCode'].'***'.$row['fichaNumber']; ?>"></td>
	<td>
		<?php echo $row['fichaNumber']; ?>
	</td>
	<td>
		<?php echo $row['groupCode']; ?>
	</td>
	<td><input type="text" name="observation[<?php echo $i; ?>]"></td>		
	<td><input type="text" name="jury[<?php echo $i; ?>]"></td>		
	<td><input type="date" name="dateGO[<?php echo $i; ?>]"></td>		
	</tr>
	<?php $i++; } ?>
</table>


<input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action='?action=registrar';"/>
</form>


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
					<th>Editar</th>
					<th>Eliminar</th>
					</tr>

			</thead>

		<?php 
         //sirve para debug
		// count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>

			<tr>
			<td><?php echo $r->_GET('observationId');?></td>
			<td><?php echo $r->_GET('observation');?></td>
			<td><?php echo $r->_GET('jury');?></td>
			<td><?php echo $r->_GET('dateGO');?></td>
			<td><?php echo $r->_GET('userGO');?></td>
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php echo $r->_GET('groupCode');?></td>
			
			

			<td>
				<a href="?action=editar&observationId=<?php echo $r->_GET('observationId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&observationId=<?php echo $r->_GET('observationId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>

	

	



</body>

</html>


