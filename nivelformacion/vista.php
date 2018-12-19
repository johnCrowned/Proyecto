<?php
require_once 'LevelTrainingController.php';
require_once 'LevelTrainingModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new LevelTraining();
$model = new LevelTrainingModel();
$db = database::conectar();
$camposDesabilitados = '';
if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		$usu -> _SET('descripcion',                   $_REQUEST['descripcion']);
		$usu -> _SET('state',                   $_REQUEST['state']);

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('idLevelTraining',                   $_REQUEST['idLevelTraining']);
		$usu -> _SET('descripcion',                   $_REQUEST['descripcion']);
		$usu -> _SET('state',                   $_REQUEST['state']);


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['idLevelTraining']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['idLevelTraining']);
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
      <div class="panel-heading" align="center">NIVEL DE FORMACION</div>
            <div class="panel-body"><br><br>


            <form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">Formacion:</label><br>
      <input type="text" name="idLevelTraining" value="<?php echo $usu->_GET('idLevelTraining')?>" class="form-control" placeholder="FORMACION" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>
	
<div class="form-group">
      <label class="control-label col-sm-2" for="ID">Descripcion:</label><br>
      <input type="text" name="descripcion" value="<?php echo $usu->_GET('descripcion')?>" class="form-control" placeholder="DESCRIPCION FORMACION" required>
      <div class="col-sm-10">
        
      </div>
    </div>
    <br>
	
<div class="form-group">
    	<label for="select" value="<?php echo $usu->_GET('state')?>" >Estado de la Valoracion</label>

	<select name="state" class="form-control" id="select">
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
		<h2>CONSULTAR REGISTROS </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Formacion: </th>
					<th>Descripcion</th>
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
			<td><?php echo $r->_GET('idLevelTraining');?></td>
			<td><?php echo $r->_GET('descripcion');?></td>
			<td><?php if($r->_GET('state')=="0"){echo "Inactivo";
			}else if($r->_GET('state')=="1"){echo "Activo"; }
			 ?></td>
			
			

			<td>
				<a href="?action=editar&idLevelTraining=<?php echo $r->_GET('idLevelTraining'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&idLevelTraining=<?php echo $r->_GET('idLevelTraining'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>