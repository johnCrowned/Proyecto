<?php
require_once 'valorationController.php';
require_once 'valorationModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new valoration();
$model = new valorationModel();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('valueV',                   $_REQUEST['valueV']);
		$usu -> _SET('statusV',                   $_REQUEST['statusV']);
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('valueV',                   $_REQUEST['valueV']);
		$usu -> _SET('statusV',                   $_REQUEST['statusV']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['valueV']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['valueV']);
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
<h2></h2>

  <div class="container">
		
	<div class="panel panel-info">
      <div class="panel-heading" align="center">VALORACION</div>
            <div class="panel-body"><br><br>

<form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">Valoracion:</label><br>
      <input type="text" name="valueV" value="<?php echo $usu->_GET('valueV')?>" class="form-control" placeholder="VALOR VALORACION" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>

    <div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('statusV')?>" >Estado de la Valoracion</label>

	<select name="statusV" class="form-control" id="select">
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
		<h2>CONSULTAR TIPOS DE INSTRUCTOR </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Valo Valoracion</th>
					<th>Eestado de Formacion</th>
			

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
			<td><?php echo $r->_GET('valueV');?></td>
			<td><?php if($r->_GET('statusV')=="1"){ echo "Activo";

			}else if($r->_GET('statusV')=="0"){

				echo "Inactivo";
			}

			?></td>
			<td>
				<a href="?action=editar&valueV=<?php echo $r->_GET('valueV'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&valueV=<?php echo $r->_GET('valueV'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>


