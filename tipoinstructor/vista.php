<?php
require_once 'instructorTypeController.php';
require_once 'instructorTypeModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new instructorType();
$model = new instructorTypeModel();
$db = database::conectar();
$camposDesabilitados = '';
if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('insTypeId',                   $_REQUEST['insTypeId']);
		$usu -> _SET('statusI',                   $_REQUEST['statusI']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('insTypeId',                   $_REQUEST['insTypeId']);
		$usu -> _SET('statusI',                   $_REQUEST['statusI']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['insTypeId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['insTypeId']);
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
<h2></h2>
<center>


  <div class="container">
	<div class="panel panel-info">
      <div class="panel-heading" align="center">TIPO DE INSTRUCTOR</div>
            <div class="panel-body"><br><br>


            <form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">Tipo Instructor:</label><br>
      <input type="text" name="insTypeId" value="<?php echo $usu->_GET('insTypeId')?>" class="form-control" placeholder="Modalidad" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>
	
 <div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusI')?>" >Estado de la Valoracion</label>

	<select name="statusI" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
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
					<th>Tipo Instructor: </th>
					<th>Estado Instructor</th>
			

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
			<td><?php echo $r->_GET('insTypeId');?></td>
			<td><?php if($r->_GET('statusI')=="1"){ echo "Activo";

			}else if($r->_GET('statusI')=="0"){

				echo "Inactivo";
			}

			?></td>
			

			<td>
				<a href="?action=editar&insTypeId=<?php echo $r->_GET('insTypeId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&insTypeId=<?php echo $r->_GET('insTypeId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>