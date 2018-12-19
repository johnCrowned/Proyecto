<?php
require_once 'Controller.php';
require_once 'model.php';
require_once '../conexion.php';


//logica
$r = array();
$usu = new ListaCheck();
$model = new ItemsCheck();
$db = database::conectar();

if(isset($_REQUEST['action'])){

	switch($_REQUEST['action']){

		case 'Actualizar':
		$usu -> _SET('itemId',                   $_REQUEST['itemId']);
		$usu -> _SET('itemQuestion',                   $_REQUEST['itemQuestion']);
		$usu -> _SET('codeL',                   $_REQUEST['codeL']);
		$usu -> _SET('codeC',                   $_REQUEST['codeC']);
		$usu -> _SET('programCode_version',      $_REQUEST['programCode_version']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);

		
		

		$model->Actualizar($usu);
		//header('location: usuario.vista.php');
		break;

		case 'registrarr':
		$usu -> _SET('itemId',                   $_REQUEST['itemId']);
		$usu -> _SET('itemQuestion',                   $_REQUEST['itemQuestion']);
		$usu -> _SET('codeL',                   $_REQUEST['codeL']);
		$usu -> _SET('codeC',                   $_REQUEST['codeC']);
		$usu -> _SET('programCode_version',                   $_REQUEST['programCode_version']);
		$usu -> _SET('listId',                   $_REQUEST['listId']);
		$model->registrar($usu);
		//header('location: usuario.vista.php');
		break;
//instancia la clase eliminar que se encuentra al final de cada registro
		case 'eliminar':
		$model->eliminar($_REQUEST['itemId']);
		//header('location: usuario.vista.php');
		break;
//instancia la clase editar que se encuentra el final de cada registro//
		case 'editar':
		$usu=$model->obtener($_REQUEST['itemId']);
		break;


case 'registrar':

//print_r($_REQUEST['data']);
//print_r($_REQUEST['preguntaRae']);
//echo $_REQUEST['iditem'];

for ($i=0; $i < count($_REQUEST['preguntaRae']); $i++) { 
 
	

if(isset($_REQUEST['data'][$i])){

$data = explode('***', $_REQUEST['data'][$i]);

echo '<br>'.$data[0]." ".$data[1]." ".$data[2]." ".$_REQUEST['listId'][$i]."--".$_REQUEST['iditem'][$i]."--".$_REQUEST['preguntaRae'][$i];

		$usu -> _SET('itemId',                 $_REQUEST['iditem'][$i]);
		$usu -> _SET('itemQuestion',                 $_REQUEST['preguntaRae'][$i]);

		//$usu -> _SET('itemQuestion',                  $_REQUEST['preguntaRae'][$i]);
		$usu -> _SET('codeL',                   $data[1]);
		$usu -> _SET('codeC',                   $data[0]);
		$usu -> _SET('programCode_version',     $data[2]);
		$usu -> _SET('listId',                  $_REQUEST['listId'][$i]);
		

$model->registrar($usu);
}
}

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
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>
</head>
<body>





<form action ="" method="post">

<table border="4" class="table table-striped">
<tr>
	<td></td>
	<td>Codigo Competencia</td>
	<td>Denominacion de competencia</td>
	<td>Codigo de Rae</td>
	<td>Denominacion de rae</td>
	<td>Vercion de programa</td>
	<td>lista de chequeo</td>
	<td>pregunta</td>
	<td>Numero Del item</td>
</tr>
<?php 
$i = 0;
foreach($db-> query('SELECT competence.denomination as denominationC, competence.codeC, learningresult.denomination as denominationL, learningresult.codeL, competence.programCode_version FROM competence, learningresult WHERE competence.codeC = learningresult.codeC')as $row){ ?>
<tr>
	<td><input name="data[<?php echo $i; ?>]" type="checkbox" id="d" value="<?php echo $row['codeC'].'***'.$row['codeL'].'***'.$row['programCode_version']; ?>"></td>
	<td><?php echo $row['codeC']; ?></td>
	<td><?php echo $row['denominationC']; ?></td>
	<td><?php echo $row['codeL']; ?></td>
	<td><?php echo $row['denominationL']; ?></td>
	<td><?php echo $row['programCode_version']; ?></td>
	<td>

	<select class="form-control" name="listId[<?php echo $i; ?>]">
	<?php
	foreach($db-> query('SELECT * FROM checklist')as $row){
	echo '<option value="'.$row['listId'].'">'.$row['listId'].'</option>';

	}
	?>
	</select>

	</td>
	<td><input type="text" name="preguntaRae[<?php echo $i; ?>]" </td>
	<td><input type="text" name="iditem[<?php echo $i; ?>]" value=<?php echo $i;?>></td>
</tr>	

<?php $i++; } ?>
</table>

<input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action='?action=registrar';"/>
</form>




<center>
	<h1></h1>

	<div class="container">
		<h2>Consulta-Registros</h2>
		<div class="table-responsive">
			<table border="4" class="table table-striped">
			<thead>
				<tr class="info">
					<th>ID del ITem</th>
					<th>Pregunta</th>
					<th>Codigo de la Competencia</th>
					<th>Competencia</th>
					<th>Programa</th>
					<th>ID Lista Chequeo</th>
					
					
				

					<th>Editar</th>
					<th>Eliminar</th>
					</tr>

			</thead>

		<?php 
         //sirve para debug
		$numero=0;
		 count($model->Listar());

		foreach ($model->Listar() as $r){ 


			?>

			<tr>
			<td><?php echo $r->_GET('itemId');?></td>
			<td><?php echo $r->_GET('itemQuestion');?></td>
			<td><?php  if(isset($numero)){
				foreach($db-> query('SELECT denomination FROM learningresult where codeL='.$r->_GET('codeL').'')as $row){
			 
        		echo $row['denomination'];

        	}
        	}
			 ?></td>





			<td><?php if(isset($numero)){
				foreach($db-> query('SELECT denomination FROM competence where codeC='.$r->_GET('codeC').'')as $row){

     		 echo $row['denomination'];
	

	}

			}

			 ?></td>
			<td><?php echo $r->_GET('programCode_version');?></td>
			<td><?php echo $r->_GET('listId');?></td>
			




			<td>
				<a href="?action=editar&itemId=<?php echo $r->_GET('itemId'); ?>" class="btn btn-warning">Editar</a>
			</td>
			<td>
				<a href="?action=eliminar&itemId=<?php echo $r->_GET('itemId'); ?>" class="btn btn-danger" onclick ="return confirm('¿Esta seguro de eliminar este Usuario?')">Eliminar</a>

			</td>
			</tr>
		<?php } ?>
			</table>
			</div>
			</div>

</center>







</body>


</html>