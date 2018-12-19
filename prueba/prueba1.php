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



	<td width="133"><input name="administrador" type="checkbox" id="administrador" value="checkbox" />
            Administrador
            <label></label></td>
        </tr>
        <tr>
          <td><input name="supervisor" type="checkbox" id="supervisor" value="checkbox" />
            Supervisor
            <label></label></td>
        </tr>
        <tr>
          <td height="28"><input name="vendedor" type="checkbox" id="vendedor" value="checkbox" />
            Vendedor
            <label></label></td>
        </tr>
        <tr>
          <td height="28"><input name="VIP" type="checkbox" id="VIP" value="checkbox" />
VIP
  <label></label></td>

   <p>
        <label>
        <input type="submit" name="Submit" value="Asignar Etiqueta" />
        </label>
      </p>





      //-------------

<div class="form-group">
	<label>Numeros Ficha:</label>
	<select class="form-control" name="fichaNumber">
	<?php
	foreach($db-> query('SELECT * FROM groupanswer')as $row){
	echo '<option value="'.$row['fichaNumber'].'">'.$row['fichaNumber'].'</option>';
	echo '<option value="'.$row['dateG'].'">'.$row['dateG'].'</option>';
	echo '<option value="'.$row['groupCode'].'">'.$row['groupCode'].'</option>';
	echo '<option value="'.$row['itemId'].'">'.$row['itemId'].'</option>';
	echo '<option value="'.$row['valueV'].'">'.$row['valueV'].'</option>';




	echo $dateGG= stripslashes($row1["dateG"]);
    echo $fichaNumberr= stripslashes($row1["fichaNumber"]);
	echo $groupCodee= stripslashes($row1["groupCode"]);
	echo $itemIdd= stripslashes($row1["itemId"]);
	echo $listIdd= stripslashes($row1["listId"]);
	echo $valueVv= stripslashes($row1["valueV"]);
	echo"<option value='$fichaNumberr'>$valueVv, $fichaNumberr</option>";

	}

	?>

<?php
echo"<option value='$fichaNumberr'>$valueVv, $fichaNumberr</option>";

?>
	</select>
	</div>

 <form id="form1" name="form1" method="post" action="guardarPermisos.php">



    <input type="checkbox" value="1" name="numero[]" />
    <input type="checkbox" value="2" name="numero[]" />2
    <input type="checkbox" value="3" name="numero[]" />3
 </form> 


</body>
</html>

