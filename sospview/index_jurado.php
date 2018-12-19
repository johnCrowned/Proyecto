<?php
include('seguridad2.php') 
?>
<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Index Instructor</title>

</head>

<body>

<center><h1>Modulo Jurados</h1></center>
<p class="Estilo1"><a href="salir.php">Cerrar Sesión</a></p>
<?php
include ('conexion2.php');


echo "Bienvenido Jurado: ". $_SESSION['nombresev']."<br>";


$ddocumentoev=$_SESSION['documento'];

?>
 
 Seleccione: <select name="select" onchange="window.location.href=this.value">
        <option>ROL</option>
              
			  <?php
            
			
			$sql3="SELECT * FROM intermedia WHERE fk_doc='$ddocumentoev'";
if(!$result3 = $db->query($sql3)){
  die('Hay un error corriendo en la consulta o datos no encontrados!!! [' . $db->error . ']');
}
while($row3 = $result3->fetch_assoc())
{
$id_rrol=stripslashes($row3["fk_rol"]); 



if ($id_rrol==1)
{

echo"<option value='index_instructor.php'>Instructor</option>";

}
if ($id_rrol==2)
{
echo"<option value='index_jurado.php'>Jurado</option>";

}

} //fin while
		?>	
			
			</select>

</body>

</html>
