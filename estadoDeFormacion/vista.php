<?php
require_once 'estadoController.php';
require_once 'estadoModel.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new estado();
$model = new estadoInfo();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('statusId',                   $_REQUEST['statusId']);
		$usu -> _SET('statusF',                   $_REQUEST['statusF']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('statusId',                   $_REQUEST['statusId']);
		$usu -> _SET('statusF',                   $_REQUEST['statusF']);
		

		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['statusId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['statusId']);
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
		
	<div class="panel panel-info">
      <div class="panel-heading" align="center">ESTADO DE FORMACION</div>
            <div class="panel-body"><br><br>


            <form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">ID del Estado de formacion</RP>:</label><br>
      <input type="text" name="statusId" value="<?php echo $usu->_GET('statusId')?>" class="form-control" placeholder="ID ROL" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>
	
<div class="form-group">
      <label class="control-label col-sm-2" for="ID">Descripcion formacion:</label><br>
      <input type="text" name="statusF" value="<?php echo $usu->_GET('statusF')?>" class="form-control" placeholder="DESCRIPCION ROL" required>
      <div class="col-sm-10">
        
      </div>
    </div>
    <br>
	

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
		<h2>CONSULTAR REGISTROS </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>ID formacion: </th>
					<th>Descripcion formacion</th>
			       

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
			<td><?php echo $r->_GET('statusId');?></td>
			<td><?php echo $r->_GET('statusF');?></td>
		

			<td>
				<a href="?action=editar&statusId=<?php echo $r->_GET('statusId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&statusId=<?php echo $r->_GET('statusId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>