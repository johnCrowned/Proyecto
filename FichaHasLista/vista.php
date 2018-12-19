<?php
require_once 'valorationController.php';
require_once 'valorationModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new FichaList();
$model = new FichaListClass();
$db = database::conectar();
$camposDesabilitados = '';

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('fichaNumber',                   $_REQUEST['fichaNumber']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);


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
		$camposDesabilitados = 'disabled';
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
      <div class="panel-heading" align="center">FICHA LISTA CHEQUEO</div>
            <div class="panel-body"><br><br>

<form action="SOSConexion.php" method="post"> 

  <div class="form-group">
	<label>Numeros Ficha:</label>
	<select class="form-control" name="fichaNumber">
	<?php
	foreach($db-> query('SELECT * FROM ficha')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'</option>';

	}
	?>


	</select>
	</div>
      <br>
	
	<div class="form-group">
	<label>ID de la lista de chequeo:</label>
	<select class="form-control" name="listId">
	<?php
	foreach($db-> query('SELECT * FROM checklist')as $row){
	echo '<option value="'.$row['listId'].'">'.$row['listId'].'</option>';

	}
	?>


	</select>
	</div>

    <br>
	

	

    
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
		<h2>CONSULTAR TIPOS DE INSTRUCTOR </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Numero ficha</th>
					<th>ID de la lista de chequeo</th>
			

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
			<td><?php echo $r->_GET('listId');?></td>
			

			<td>
				<a href="?action=editar&fichaNumber=<?php echo $r->_GET('fichaNumber'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&fichaNumber=<?php echo $r->_GET('fichaNumber'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>


