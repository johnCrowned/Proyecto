<?php
include('seguridad2.php') 
?>
<!DOCTYPE html>
<html">
<head>
<meta charset="UTF-8">
  <title>menu</title>
  <link rel="stylesheet"  href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.2.1.min.min.js"></script>




  <link rel="stylesheet" href="css/master.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="UTF-8"/>
<title>Bienvenida SOSP</title>
<style>
body{
   background:url("images/fondo_index.jpg");
}

</style>

</head>

<body>

<center>
<table width="1200" border="0">
  <tr>
    <td><h1 align="center">Bienvenido al Observador de Proyectos</h1></td>
  </tr>
  <tr>
    <td class="divcerrar3" align="center" ><a  class="divcerrar3" href="salir.php" ><h1>Cerrar Sesión</h1></a></td>
  </tr>
</table>
<h1>&nbsp;</h1>
</center>
<p class="Estilo1"><a href="salir.php"></a></p>
<p class="Estilo1"></p>
<p class="Estilo1" align="center"><img src="images/logo.png" width="769" height="640"></p>
<center><h3>
<?php
include ('conexion2.php');

echo "Bienvenido al Observador de Proyectos:". $_SESSION['nombresev']."<br>";


$ddocumentoev=$_SESSION['documento'];

?>
 
 Seleccione: <select name="select" onchange="window.location.href=this.value">
        <option>ROL</option>
              
			  <?php
            
			$sql3="SELECT roleId FROM customer_has_role WHERE documentNumber='$ddocumentoev'";

if(!$result3 = $db->query($sql3)){
  die('Hay un error corriendo en la consulta o datos no encontrados!!! [' . $db->error . ']');
}
while($row3 = $result3->fetch_assoc())
{
$id_rrol=stripslashes($row3["roleId"]); 



if ($id_rrol==01)
{

echo"<option value='vistaMenuAprendiz.php?roleId=".$id_rrol."'>Aprendiz</option>";
$_SESSION["aprendiz"]="1";
}
if ($id_rrol==02)
{
echo"<option value='vistaMenuInstructor.php?roleId=".$id_rrol."'>Instructor</option>";
$_SESSION["instructor"]="1";
}
if ($id_rrol==03)
{
echo"<option value='vistaMenuAdministrador.php?roleId=".$id_rrol."'>Administrador</option>";
$_SESSION["administrador"]="1";
}


} //fin while
		?>	
			
			</select></h3></center>

</body>

</html>
