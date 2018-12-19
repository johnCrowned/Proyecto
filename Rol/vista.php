<?php
require_once 'rolController.php';
require_once 'rolModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new role();
$model = new rolModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('description',                   $_REQUEST['description']);
		$usu -> _SET('statusRole',                   $_REQUEST['statusRole']);

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('roleId',                   $_REQUEST['roleId']);
		$usu -> _SET('description',                   $_REQUEST['description']);
		$usu -> _SET('statusRole',                   $_REQUEST['statusRole']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['roleId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['roleId']);
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
      <div class="panel-heading" align="center">TIPO DE ROL</div>
            <div class="panel-body"><br><br>


            <form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">ID del Rol</RP>:</label><br>
      <input type="text" name="roleId" value="<?php echo $usu->_GET('roleId')?>" class="form-control" placeholder="ID ROL" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>
	
<div class="form-group">
      <label class="control-label col-sm-2" for="ID">Descripcion del Rol:</label><br>
      <input type="text" name="description" value="<?php echo $usu->_GET('description')?>" class="form-control" placeholder="DESCRIPCION ROL" required>
      <div class="col-sm-10">
        
      </div>
    </div>
    <br>
	

      
      <div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusRole')?>" >Estado del Rol</label>

	<select name="statusRole" class="form-control" id="select">
	<option value="1">Activo</option>
	<option value="0">Inactivo</option>
	</select></div>
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
		<h2>CONSULTAR REGISTROS </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>ID rol: </th>
					<th>Descripcion </th>
			        <th>Estado </th>

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
			
			<td><?php echo $r->_GET('roleId');?></td>
			<td><?php echo $r->_GET('description');?></td>
			<td><?php if($r->_GET('statusRole')=="1"){ echo "Activo";

			}else if($r->_GET('statusRole')=="0"){

				echo "Inactivo";
			}

			?></td>

			<td>
				<a href="?action=editar&roleId=<?php echo $r->_GET('roleId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&roleId=<?php echo $r->_GET('roleId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>