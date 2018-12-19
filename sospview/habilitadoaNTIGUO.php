<?php
include('seguridad2.php') 
?>
<!DOCTYPE html>
<html">
<head>
<meta charset="UTF-8"/>
<title>Bienvenida OP</title>
<style>
body{
   background:url("images/fondo_index.jpg");
}

</style>

</head>

<body>

<center><h1>Bienvenido al Observador de Proyectos</h1></center>
<p class="Estilo1"><a href="salir.php">Cerrar Sesión</a></p>
<?php
include ('conexion2.php');

echo "Bienvenido al Observador de Proyectos:". $_SESSION['nombresev']."<br>";


$ddocumentoev=$_SESSION['documento'];
echo $_SESSION['instructor'];
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


session_start();
if ($id_rrol==01)
{

echo"<option value='vistaMenuAdministrador.php'>Administrador</option>";
 $_SESSION["administrador"]="1";
$row2["documentNumber"];
}
if ($id_rrol==02)
{
echo"<option value='vistaMenuInstructor.php'>Instructor</option>";
$_SESSION["instructor"]="1";
}
if ($id_rrol==03)
{
echo"<option value='vistaMenuJurado.php'>Jurado</option>";
$_SESSION["jurado"]="1";
}
if ($id_rrol==04)
{
echo"<option value='vistaMenuAprendiz.php'>Aprenidz</option>";
$_SESSION["aprendiz"]="1";
}

} //fin while
		?>	
			
			

</body>

</html>
