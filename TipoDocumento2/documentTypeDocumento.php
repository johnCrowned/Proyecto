<?php
require_once 'documentTypeController.php';
require_once 'documentTypeModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new documentType();
$model = new documentTypeModel();
$db = database::conectar();
$camposDesabilitados = '';
if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('description',                   $_REQUEST['description']);
		$usu -> _SET('statusDocType',                   $_REQUEST['statusDocType']);

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		if($_REQUEST['desabilitados'] == 'disabled'){

		$usu -> _SET('documentName',                   $_REQUEST['documentName_Actualizar']);
		
		}else{
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		
		}
		$usu -> _SET('documentName',                   $_REQUEST['documentName']);
		$usu -> _SET('description',                   $_REQUEST['description']);
		$usu -> _SET('statusDocType',                   $_REQUEST['statusDocType']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['documentName']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['documentName']);
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
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>
	<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
</head>
<body>
<center>
<div class="container">
	<h2></h2>
	<div class="panel panel-info">
	<div class="panel-heading">FORMULARIO TIPOS DE DOCUMENTO</div>
	<div class="panel-body">

<form action ="" method="post">


	<div class="form-group" >
		<label   >Nombre del Documento</label>
		<input type="text" name="documentName" value="<?php echo $usu->_GET('documentName')?>" class="form-control" placeholder="Inserte Nombre Del Documento" required>
		<input type="hidden" name="documentName_Actualizar" value="<?php echo $usu->_GET('documentName'); ?>">
	</div>

	<div class="form-group">
		<label>Descripción del Documento</label>
		<input type="text" name="description" value="<?php echo $usu->_GET('description')?>" class="form-control" placeholder="Inserte la descripción del Documento." required>
	</div>

	

    <div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusDocType')?>" >Estado del Documento</label>

	<select name="statusDocType" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
    </div>

    
	<div class="form-group">
		
		<input type="submit" class="btn btn-success" value="Actualizar" onclick="this.form.action='?action=Actualizar';"/>
		<input type="hidden" name="desabilitados" value="<?php echo $camposDesabilitados; ?>">
	</div>

	</form>
	</div>
	</div>
	</div>
	<div class="container">
		<h2>Consulta-Registros-Niveles de formación</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Nombre del Documento</th>
					<th>Descripción del Documento</th>
					<th>Estado del Documento</th>

					<th>Editar</th>
					
					</tr>

			</thead>

		<?php 
         //sirve para debug
		 count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>

			<tr>
			<td><?php echo $r->_GET('documentName');?></td>
			<td><?php echo $r->_GET('description');?></td>
			<td><?php if( $r->_GET('statusDocType')=="0")
			{echo "Inactivo";
			 }else if ($r->_GET('statusDocType')=="1"){
			 	echo "Activo";
			 }
			?></td>

			<td>
				<a href="?action=editar&documentName=<?php echo $r->_GET('documentName'); ?>" class="btn btn-warning">Editar</a>
			</td>
			
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>