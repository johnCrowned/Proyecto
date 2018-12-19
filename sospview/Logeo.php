<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<?php  include ('head.html');?>
<style>
body{
   background:url("images/fondo_index.jpg");
}

</style>
</head>

<body>
<br><div class="col-md-6 col-md-offset-3 text-center">
 <div class="panel panel-primary">
      <div class="panel-heading" style="background-color:#333"><h1 style="color:#ff7f00">Sistema de Ingreso</h1></div>
      <div class="panel-body" style="background-color:#5D6D7E">
      <img src = "images/logo.png" width="500px" height="500px">

<form id="form1" name="form1" method="post" action="evaluar.php" class="opacity">
  
    <label id="letra">Usuario :</label>
    <input name="doc" type="text" id="doc">
    <p></p>
    <label  id="letra">Password: </label>
    <input name="pass" type="Password" id="pass">
    <p></p>
   
    <input type="submit" name="Submit" id="letra" style="background-color:#333;"  value="Ingresar"><br>
    <div class="divcerrar">
    
    <a class="divcerrar2" href="../index.php"><div class="divcerrar2" style="color:#fff" title="Cierra la sesion por Completo."><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>Volver a Inicio.</div></a>
  </div>
</form>
</div>
</div>
</div>
</body>
</html>
