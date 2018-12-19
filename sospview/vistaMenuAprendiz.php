<!--
||||||||||||||||||||||||||||||||||||||

Diseñado por keyquotes
web: www.keyquotes.es
desarrollador: Álvaro Castillo
año: 2014

||||||||||||||||||||||||||||||||||||||
-->


<!doctype html>
<?php
include ('seguridadAprendiz.php')
?>
<html lang="en" class="html">
<head>
	<meta charset="UTF-8">
	<title>menu</title>
	<link rel="stylesheet" href="css/master.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<meta charset= "UTF-8"/>
        <meta name="description" content="Ejemplo de HTML5" />
        <meta name="keywords" content="HTML5, CSS3, JavaScript" />
        <title>index</title>
        <link rel="stylesheet" href="css/aprendices.css">
        <link  rel="stylesheet" href="css/menu.css">
<body class="body">




	<div class="div_menuIsquierdo col-md-2">	
	<center><div id="imagen"> <img src="images/logo.png" width="185" height="200" alt="Imagen Logo del Aplicativo" title="Imagen Logo del Aplicativo"> </div></center>
	
	<a class="a" href="../usuario2/usuariovista.php" target ="cf"><div class="bton"> <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Usuario</div></a>

	

    <a class="a" href="../customer/documento.php" target ="cf"><div class="bton"> <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Cliente</div></a>

    <a class="a" href="../VALORACION/vista.php" target ="cf"><div class="bton"> <span class="glyphicon glyphicon-book" aria-hidden="true"></span> valoracion</div></a>




	<a class="a" href="../TipoDocumento/documentTypeDocumento.php" target ="cf"><div class="bton"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Tipo de Documento</div></a>

	<a class="a" href="habilitado.php" target =""><div class="bton"><span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span>Volver a Mis Roles</div></a>


	<a class="a" href="salir.php" ><div class="bton"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar sesion</div></a>
	</div>



	<div class="div_perfil col-md-10">

<?php

include ('../conexion.php');
//logica

$db = database::conectar();
$documento =$_SESSION['documento'];
//echo $documento;
?>
<div class="div_fotoperfil col-md-3" id="estiloLetra">
	<label>FOTO</label>
	<?php
	foreach($db-> query('SELECT * FROM users WHERE documentNumber='.$_SESSION['documento'].'')as $row){
	
    echo "<td><img src='../img/$row[photo]' width=150px height=170px></td></tr>";
    
    
   

	}
	//echo $row['documentNumber'];

	?>
 </div> 
 <div id="estiloLetra">

   <?php
 echo $row['documentName'];
echo "-";
 echo $row['documentNumber'];

 ?>
<p><p>

   <?php

 echo $row['mail'];
 ?>
<p><p>
 <?php
	foreach($db-> query('SELECT * FROM customer WHERE documentNumber='.$_SESSION['documento'].'')as $row){
	
    echo $row['firstName'];
    echo "-";

    echo $row['secondName'];
    echo "-";

    echo $row['firstLastName'];
    echo "-";

    echo $row['secondLastName'];

	}
	//echo $row['documentNumber'];

	?>
	<p>

	<?php 
	if (isset($_SESSION["aprendiz"]) ){
	  	echo "Aprendiz";
	  
	  }
	  ?>
	  <p>

	  <?php

		foreach($db-> query('SELECT statusCustomerRole,roleId FROM  customer_has_role WHERE documentNumber='.$_SESSION['documento'].' AND roleId=1')as $row){

		$row['statusCustomerRole'];
		$row['roleId'];

		  }if($row['statusCustomerRole']==1 and $row['roleId']==1 ){

          echo "Activo";
          
         } else if($row['statusCustomerRole']==0 and $row['roleId']==1){
         	echo "Inactivo";
         }
	  ?>

<div class="divcerrar">

	  
<a class="divcerrar" href="habilitado.php" target =""><div class="divcerrar"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>Volver a Mis Roles</div></a>

<br>

	  <a class="divcerrar" href="salir.php"><div class="divcerrar" title="Cierra la sesion por Completo."><span class="glyphicon glyphicon-off" aria-hidden="true"></span>-Cerrar sesion</div></a>
	</div>

</div>
</div>




	<div class="div_iframe col-md-10">
	<iframe  name="cf" class="iframe_class" scrolling="auto" src=""></iframe>
    </div> 

    <!--<footer id="cierre"> Derechos Reservados SOSP 2017 </footer>-->

	
</body>
</html>