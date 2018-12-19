<?php
require_once 'programStatusController.php';
require_once 'programStatusModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new programStatus();
$model = new programStatusModel();
$db = database::conectar();
$camposDesabilitados = '';

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('programStatusID',                   $_REQUEST['programStatusID']);
		$usu -> _SET('idStatus',                   $_REQUEST['idStatus']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('programStatusID',                   $_REQUEST['programStatusID']);
		$usu -> _SET('idStatus',                   $_REQUEST['idStatus']);
		


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['programStatusID']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['programStatusID']);
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
      <div class="panel-heading" align="center">ESTADO DE FORMACION DEL PROGRAMA</div>
            <div class="panel-body"><br><br>


            <form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">ID del Estado</RP>:</label><br>
      <input type="text" name="programStatusID" value="<?php echo $usu->_GET('programStatusID')?>" class="form-control" placeholder="ID del Estado" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>
	
<div class="form-group">
      <label class="control-label col-sm-2" for="ID">Estado Formacion:</label><br>
      <input type="text" name="idStatus" value="<?php echo $usu->_GET('idStatus')?>" class="form-control" placeholder="Estado Formacion" required>
      <div class="col-sm-10">
        
      </div>
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
		<h2>CONSULTAR REGISTROS </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>ID del Estado: </th>
					<th>Estado: </th>
			       

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
			<td><?php echo $r->_GET('programStatusID');?></td>
			<td><?php echo $r->_GET('idStatus');?></td>
			

			<td>
				<a href="?action=editar&programStatusID=<?php echo $r->_GET('programStatusID'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&programStatusID=<?php echo $r->_GET('programStatusID'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>