<?php
include ('../sospview/seguridadadmin.php');
include('../conexion.php');
$db = database::conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>


<div class="form-group">
	
    
	
	
	
	<label>Tipos Rol:</label>
	<select class="form-control" name="roleId">
	<?php
	foreach($db-> query('SELECT * FROM ficha')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'</option>'		    ;
	}
	?>


	</select>

	

	</div>
	



</body>
</html>

