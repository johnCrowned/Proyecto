<?php
require_once 'valorationController.php';
require_once 'valorationModel.php';
require_once '../Conexion.php';
include('ajax.js');


//logica
$r = array();
$usu = new RespuestraGrupo();
$model = new RespuestraClass();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('dateG',                   $_REQUEST['dateG']);
		$usu -> _SET('groupCode',                   $_REQUEST['groupCode']);
		$usu -> _SET('itemId',                   $_REQUEST['itemId']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		$usu -> _SET('valueV',                   $_REQUEST['valueV']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		/*$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('dateG',                   $_REQUEST['dateG']);
		$usu -> _SET('groupCode',                   $_REQUEST['groupCode']);
		$usu -> _SET('itemId',                   $_REQUEST['itemId']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		$usu -> _SET('valueV',                   $_REQUEST['valueV']);
		$model->registrar($usu);*/



for ($i=0; $i < count($_REQUEST['fichaNumber']); $i++) { 
 
	

if(isset($_REQUEST['data'][$i])){

$data = explode('***', $_REQUEST['data'][$i]);

//echo '<br>'.$data[0]." ".$data[1]." ".$data[2]." ".$_REQUEST['fichaNumber'][$i]."--".$_REQUEST['groupCode'][$i]."--".$_REQUEST['valueV'][$i]." ".$_REQUEST['fecha'][$i]." ".$_REQUEST['listId'][$i]." ".$_REQUEST['itemId'][$i];



		$usu -> _SET('fichaNumber',               $_REQUEST['fichaNumber'][$i]);
		$usu -> _SET('dateG',                     $_REQUEST['fecha'][$i]);
		$usu -> _SET('groupCode',                $_REQUEST['groupCode'][$i]);
		$usu -> _SET('itemId',                   $_REQUEST['itemId'][$i]);
		$usu -> _SET('listId',                   $_REQUEST['listId'][$i]);
		$usu -> _SET('valueV',                   $_REQUEST['valueV'][$i]);
		$usu -> _SET('observation',             $_REQUEST['observation'][$i]);
		$usu -> _SET('jury',                   	$_REQUEST['jury'][$i]);
		$model->registrar($usu);



}
}





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
	

	</title>
	<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
	
</head>
<body>









<form action ="" method="post">
<h2>Seleccione los items para a lista de chequeo.</h2>
<table border="4" class="table table-striped">
<tr>
	<td></td>
	<td><h3>Lista Chequeo</h3></td>
	<td><h3>Numero de la Ficha</h3></td>
	<td><h3>Numero del Item</h3></td>
	<td><h3>Numero Grupo</h3></td>
	<td><h3>Valoracion</h3></td>
	<td><h3>Descripcion</h3></td>
	<td><h3>Jurado</h3></td>
	<td><h3>Fecha</h3></td>
	
	
</tr>
<?php 
$i = 0;
foreach($db-> query('SELECT * FROM listitem')as $row){ ?>
<tr>
	<td><input name="data[<?php echo $i; ?>]" type="checkbox" id="d" value="<?php echo $row['codeC'].'***'.$row['codeL'].'***'.$row['programCode_version']; ?>"></td>
	

	<td>
	<?php echo $row['listId']; ?>
	<input type="hidden" name="listId[<?php echo $i; ?>]" value="<?php echo $row['listId']; ?>">
	</td>


<td>

	<select class="form-control" name="fichaNumber[<?php echo $i; ?>]" onchange="Ajax_js(this.value, <?php echo $i; ?>, 1)">
	<option value=""  >Seleccione ficha</option>
	<?php
	foreach($db-> query('SELECT fichaNumber FROM projectgroup group by fichaNumber')as $row_projet){
	echo '<option value="'.$row_projet['fichaNumber'].'"  >'.$row_projet['fichaNumber'].'</option>';

	}
	?>
	</select>
</td>


<td>
	<?php echo $row['itemId']; ?>
	<input type="hidden" name="itemId[<?php echo $i; ?>]" value="<?php echo $row['itemId']; ?>">
</td>


<td id="groupCodetd<?php echo $i; ?>">

</td>

<td>

	<select class="form-control" name="valueV[<?php echo $i; ?>]">
	<?php
	foreach($db-> query('SELECT * FROM valoration')as $row){
	echo '<option value="'.$row['valueV'].'">'.$row['valueV'].'</option>';

	}
	?>
	</select>
</td>
<td>
	<input type="text" name="observation[<?php echo $i; ?>]">
</td>
<td>
	<input type="text" name="jury[<?php echo $i; ?>]">
</td>


	
	<td><input type="date" name="fecha[<?php echo $i; ?>]" value=<?php echo date('d-m-y'); ?>></td>
</tr>
<?php $i++; } ?>
</table>

<input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action='?action=registrar';"/>
</form>

<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Numero ficha</th>
					<th>Fecha Regristro</th>
					<th>Numero Grupo</th>
					<th>Id del Item</th>
					<th>Id de la lista de chequeo</th>
					<th>Valoracion.</th>
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
			<td><?php echo $r->_GET('fichaNumber');?></td>
			<td><?php echo $r->_GET('dateG');?></td>
			<td><?php echo $r->_GET('groupCode');?></td>
			<td><?php echo $r->_GET('itemId');?></td>
			<td><?php echo $r->_GET('listId');?></td>
			<td><?php echo $r->_GET('valueV');?></td>
			

			<td>
				<a href="?action=editar&fichaNumber=<?php echo $r->_GET('fichaNumber'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&fichaNumber=<?php echo $r->_GET('fichaNumber'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>






</body>

</html>


