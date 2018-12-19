<?php
require_once 'competenceController.php';
require_once 'competenceModel.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new competence();
$model = new competenceModel();
$db = database::conectar();
$camposDesabilitados = '';
if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('codeC',                   $_REQUEST['codeC']);
		$usu -> _SET('denomination',                   $_REQUEST['denomination']);

		$usu -> _SET('programCode_version',                   $_REQUEST['programCode_version']);
		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrar':
		$usu -> _SET('codeC',                   $_REQUEST['codeC']);
		$usu -> _SET('denomination',                   $_REQUEST['denomination']);

		$usu -> _SET('programCode_version',                   $_REQUEST['programCode_version']);
		


		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['codeC']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['codeC']);
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
      <div class="panel-heading" align="center">COMPETENCIA</div>
            <div class="panel-body"><br><br>

<form action="SOSConexion.php" method="post"> 

  <div class="form-group">
      <label class="control-label col-sm-2" for="Tipo Instructor">Competencia:</label><br>
      <input type="text" name="codeC" value="<?php echo $usu->_GET('codeC')?>" class="form-control" placeholder="codigo" required>
      <div class="col-sm-10">
        

      </div>
      </div>
      <br>
	
<div class="form-group">
      <label class="control-label col-sm-2" for="ID">Denominacion:</label><br>
      <input type="text" name="denomination" value="<?php echo $usu->_GET('denomination')?>" class="form-control" placeholder="denominacion" required>
      <div class="col-sm-10">
        
      </div>
    </div>
    <br>

   
      <div class="form-group">
	<label trol-label col-sm-2" for="ID">Version del Programa:</label>
	<select class="form-control" name="programCode_version">
	<?php
	foreach($db-> query('SELECT * FROM program')as $row){
	echo '<option value="'.$row['programCode_version'].'">'.$row['programCode_version'].'</option>';

	}
	?>

	</select>
	</div>
      </div>
	

	

    
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
		<h2>CONSULTAR COMPETENCIA </h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>Codigo</th>
					<th>Denominacion</th>
					<th>Version codigo del programa</th>
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
			<td><?php echo $r->_GET('codeC');?></td>
			<td><?php echo $r->_GET('denomination');?></td>
			<td><?php echo $r->_GET('programCode_version');?></td>

			<td>
				<a href="?action=editar&codeC=<?php echo $r->_GET('codeC'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&codeC=<?php echo $r->_GET('codeC'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar el estado de formacion?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>

</body>

</html>
