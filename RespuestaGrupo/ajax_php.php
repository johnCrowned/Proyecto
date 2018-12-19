<?php
require_once 'valorationController.php';
require_once 'valorationModel.php';
require_once '../Conexion.php';


//logica
$r = array();
$usu = new RespuestraGrupo();
$model = new RespuestraClass();
$db = database::conectar();


if($_POST['op'] == 1){



?>
<select class="form-control" name="groupCode[<?php echo $_POST['idcontrol']; ?>]">
	<option value=""  >Seleccione grupo</option>
	<?php
	foreach($db-> query('SELECT * FROM projectgroup where fichaNumber ='.$_POST['fichanumber'])as $row){
	echo '<option value="'.$row['groupCode'].'">'.$row['groupCode'].'</option>';
	}
?>	
</select>

<?php
}





?>